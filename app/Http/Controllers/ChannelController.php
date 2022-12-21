<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $channels = Channel::all()->sortByDesc("id");
        return view('/channels/index', compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function import()
    {
        return view('/channels/import');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'import_file' => 'required|mimes:m3u,txt',
        ]);
        $file = $request->file('import_file');
        $upload = Storage::disk('public')->put('tempfile', $file);
        $result = File::get($file);

        $current_channels = Channel::all();

        $result = str_replace('group-title', 'tvgroup', $result);
        $result = str_replace("tvg-", "tv", $result);

        $re = '/#EXTINF:(.+?)[,]\s?(.+?)[\r\n]+?((?:https?|rtmp):\/\/(?:\S*?\.\S*?)(?:[\s)\[\]{};"\'<]|\.\s|$))/';
        $attributes = '/([a-zA-Z0-9\-]+?)="([^"]*)"/';

        preg_match_all($re, $result, $matches);


        $i = 1;

        $items = array();

        foreach($matches[0] as $list) {
            preg_match($re, $list, $matchList);
            $mediaURL = preg_replace("/[\n\r]/","",$matchList[3]);
            $mediaURL = preg_replace('/\s+/', '', $mediaURL);
            $newdata =  array (
                'id' => $i++,
                'tvtitle' => $matchList[2],
                'tvmedia' => $mediaURL
            );
            preg_match_all($attributes, $list, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $newdata[$match[1]] = $match[2];
            }
            if($current_channels->where('tvtitle', $newdata['tvtitle'])->count() > 0){
                $newdata['exists'] = true;
            }else{
                $newdata['exists'] = false;
            }

            $items[] = $newdata;
        }
        return redirect()->route('batch')->with([ 'data' => $items ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeBatch(Request $request)
    {
        if($request->has('tvdata')) {
            $data = $request->get('tvdata');
            Channel::insert($data);
            $request->session()->flash('success', 'Storing was successful!');
        }else{
            $request->session()->flash('error', 'No data imported.');
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Channel $channel)
    {
        return view('/channels/show', compact('channel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Channel $channel)
    {
        return view('/channels/edit', compact('channel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Channel $channel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Channel $channel)
    {
        $request->validate([
            'tvtitle' => 'max:255',
            'tvmedia' => 'max:255',
            'tvid' => 'max:255',
            'tvname' => 'max:255',
            'tvlogo' => 'max:255',
            'tvgroup' => 'max:255',
        ]);
        $channel->updateOrFail($request->all());
        session()->flash('success', 'Update was successful!');
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Channel  $channel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Channel $channel)
    {
        $channel->deleteOrFail();
        session()->flash('success', 'Delete was successful!');
        return redirect('/');
    }
}
