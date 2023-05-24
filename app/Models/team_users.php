<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class team_users extends Model
{
    use HasApiTokens,
        Notifiable;
    protected $fillable = [
        'team_id',
        'user_id',
    ];
}
