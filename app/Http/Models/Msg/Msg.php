<?php

namespace App\Http\Models\Msg;

use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    protected $table = "msg";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];

    
}
