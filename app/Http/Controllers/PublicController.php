<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reel;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PublicController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $reel = Reel::findBySlugOrFail($slug);

        //dd($reel->clips);
        //$reel->image = Storage::get('1453469703phpBQmNa5.PNG');
        //dd($reel);
        return view('public.show', compact('reel'));
    }
}
