<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['comment','up','down'];

    protected $appends =['score'];
    /**
 * Get the user's full name.
 *
 * @return string
 */
    public function getScoreAttribute()
    {
        return $this->up-$this->down;
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
