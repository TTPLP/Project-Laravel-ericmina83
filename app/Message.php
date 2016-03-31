<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['title', 'content'];

    public function responses(){
        return $this->hasMany(Response::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
