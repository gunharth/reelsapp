<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReelsController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reels = Reel::all();
        return view('reels.index', compact('reels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $reel = Reel::create($request->all());

        session()->flash('flash_message', 'Saved');

        return redirect()->route('reels.edit', [$reel->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $reel = Reel::findBySlugOrFail($slug);
        //$clips = '';//$clips = $reel->clips;
        //dd($reel->clips);
        //$reel->image = Storage::get('1453469703phpBQmNa5.PNG');
        //dd($reel);
        return view('reels.show', compact('reel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $reel = Reel::findBySlugOrFail($slug);
       // dd($reel->clips);
        return view('reels.edit', compact('reel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reel = Reel::findOrFail($id);

        $this->validate($request, [
            'title' => 'required'
        ]);

        /*$filename = "";
        if ($request->file('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getFilename().'.'.$extension;
           //Storage::disk('local')->put($filename ,  File::get($fileresized));
            Image::make($request->file('file'))->fit(300, 401)->save(
                base_path() . '/public/uploads/'.$filename
            );
            $request->merge(array('cover' => $filename));
        }*/

        $input = $request->all();

        $reel->fill($input)->save();

        \Session::flash('flash_message', trans('messages.create_success'));

        return redirect()->route('reels.show', [$reel->slug]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addThumb($id, Request $request)
    {
        $reel = Reel::findOrFail($id);

        $file = $request->file('thumb');
        $extension = $file->getClientOriginalExtension();
        //$original_filename = $file->getClientOriginalName();
        $image = time().'_'.$file->getClientOriginalName();

        $reel->image = $image;

        $resource = file_get_contents($file->getRealPath());
        Storage::put($image, $resource);

        $reel->save();
    }
    public function addReel($id, Request $request)
    {
        $reel = Reel::findOrFail($id);

        $file = $request->file('Reel');
        $extension = $file->getClientOriginalExtension();
        //$original_filename = $file->getClientOriginalName();
        $video = time().'_'.$file->getClientOriginalName();

        $reel->video = $video;

        $resource = file_get_contents($file->getRealPath());
        Storage::put($video, $resource);

        $reel->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reel = Reel::findOrFail($id);
        $reel->delete();
        \Session::flash('flash_message', trans('Reel deleted successfully'));
        return redirect()->route('reels.index');
    }

    public function addClip($reel_id, $clip_id, $sort_id)
    {
        $reel = Reel::find($reel_id);
        $reel->clips()->attach(array($clip_id => ['sort' => $sort_id]));
        $pivot_id = $reel->latestClipAdded()->first()->pivot->id;
        return $pivot_id;
    }


    public function sortClips(Request $request)
    {
        // Get the input from the jquery post
        $order = $request->sortItem;
        $i = 1;

        foreach ($order as $item) {
            \DB::table('clip_reel')->where('id', '=', $item)->update(array('sort' => $i));
            $i++;
        }
        return 'ok';
    }

    public function removeClip($pivotID)
    {
        // Get the input from the jquery post
            \DB::table('clip_reel')->where('id', '=', $pivotID)->delete();

        return 'ok';
    }
}
