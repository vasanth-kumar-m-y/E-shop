<?php

namespace App\Models;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name'];


    public function products()
    {
    	return $this->belongsToMany('App\Models\Product', 'product_categories');
    }    
}
