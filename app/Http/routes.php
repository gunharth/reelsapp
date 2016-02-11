<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
  Route::auth();
  Route::get('/home', 'HomeController@index');

  Route::get('/', function () {
    return view('welcome');
});

	Route::resource('reels', 'ReelsController');

  Route::resource('clips', 'ClipsController');
	Route::post('clips/{slug}/addThumb', 'ClipsController@addThumb')->name('addClipThumb');
	Route::post('clips/{slug}/addClip', 'ClipsController@addClip')->name('addClip');
	

  /**
   * Ajax Routes
   */
  Route::get('clip/{slup}', 'ClipsController@addToReel');
  Route::get('reel/addclip/{reel_id}/{clip_id}/{sort_id}', 'ReelsController@addClip');
  Route::get('reel/sortclips', 'ReelsController@sortClips');
    Route::get('reel/removeclip/{pivot_id}', 'ReelsController@removeClip');

	/**
   * Autocompletes
   */
  Route::any('clipAutoComplete', function () {
      $term = strtolower(Request::get('term'));
      $return_array = array();
      $data = DB::table("clips")
          ->distinct()
          ->select('id', 'title')
          ->where('title', 'LIKE', '%'.$term.'%')
          //->whereNull('deleted_at')
          ->groupBy('title')
          ->take(10)
          ->get();
      foreach ($data as $v) {
          $return_array[] = array('id' => $v->id, 'label' => $v->title);
      }
      return Response::json($return_array);
  });

	/**
   * Public Facing Reel
   */
	Route::get('/reel/{slug}', 'PublicController@show');

});
