<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title','image','description','currency','ammount'];

    public function url()
    {
        return $this->belongsTo('App\Url');
    }
    public function vote()
    {
        return $this->hasMany('App\Vote');
    }
}
