<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stadium extends Model
{
    use SoftDeletes;

    public $timestamps = false;
    public $table = 'stadiums';

    protected $fillable = [
        'name',
        'location',
        'image_path',
    ];
}
