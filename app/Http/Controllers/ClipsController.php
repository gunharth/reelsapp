<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use App\Clip;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClipsController extends Controller
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
        $clips = Clip::all();
        return view('clips.index', compact('clips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clips.create');
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

        $clip = Clip::create($request->all());

        session()->flash('flash_message', 'Saved');

        return redirect()->route('clips.edit', [$clip->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $clip = Clip::findBySlugOrFail($slug);
        //$clip->image = Storage::get('1453469703phpBQmNa5.PNG');
        //dd($clip);
        return view('clips.show', compact('clip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $clip = Clip::findBySlugOrFail($slug);
        return view('clips.edit', compact('clip'));
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
        $clip = Clip::findOrFail($id);

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

        $clip->fill($input)->save();

        \Session::flash('flash_message', trans('messages.create_success'));

        return redirect()->route('clips.show', [$clip->slug]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addThumb($id, Request $request)
    {

        $clip = Clip::findOrFail($id);

        $file = $request->file('thumb');
        $extension = $file->getClientOriginalExtension();
        //$original_filename = $file->getClientOriginalName();
        $image = time().'_'.$file->getClientOriginalName();

        $clip->image = $image;

        $resource = file_get_contents($file->getRealPath());
        Storage::put($image, $resource);

        $clip->save();
    }
    public function addClip($id, Request $request)
    {
        $clip = Clip::findOrFail($id);

        $file = $request->file('clip');
        $extension = $file->getClientOriginalExtension();
        //$original_filename = $file->getClientOriginalName();
        $video = time().'_'.$file->getClientOriginalName();

        $clip->video = $video;

        $resource = file_get_contents($file->getRealPath());
        Storage::put($video, $resource);

        $clip->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clip = Clip::findOrFail($id);
        /* image delete - BUT as we do a softdelete not needed for now 
        $image = $medium->cover;
        if(File::isFile(public_path().'/uploads/'.$image)) {
            File::delete(public_path().'/uploads/'.$image);
        }*/
        
        if(!empty($clip->image) && Storage::exists($clip->image)) {
            Storage::delete($clip->image);
        }
        if(!empty($clip->video) && Storage::exists($clip->video)) {
            Storage::delete($clip->video);
        }
        $clip->delete();
        \Session::flash('flash_message', trans('Clip deleted successfully'));
        return redirect()->route('clips.index');
    }

    public function addToReel($id)
    {
        $clip = Clip::findOrFail($id);
        return view('clips.partials.details', compact('clip'));
    }
}
