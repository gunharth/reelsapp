<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Clip extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = [
        'title'
    ];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
        'on_update'     => true,
    ];

    
}
