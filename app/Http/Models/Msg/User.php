<?php

namespace App\Http\Models\Msg;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    public $timestamps = false;
    protected $guarded = [];
}
