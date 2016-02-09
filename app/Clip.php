<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Clip extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = [
        'title',
        'image'
    ];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
        'on_update'     => true,
    ];

    public function getImageAttribute()
    {
        if(!empty($this->attributes['image']) && file_exists(public_path('uploads/'.$this->attributes['image']))) {
            return asset('uploads/'.$this->attributes['image']);
        } 
        return 'http://placehold.it/640x360?text=no+image';
    }

    public function reels()
    {
        return $this->belongsToMany('App\Reel');
    }
}
