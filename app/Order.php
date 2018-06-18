<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class Order extends Model
{
	protected $fillable = [
        'shipping', 'total', 'payment', 'proof'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function products()
    {
    	return $this->belongsToMany('App\Product')->withPivot('qty', 'total');;
    }
}