<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = ['url'];

    /**
     * Get the product record associated with the user.
     */
    public function product()
    {
        return $this->hasOne('App\Product');
    }
}
