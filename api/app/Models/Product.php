<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['starts', 'ends', 'deleted_at'];

    protected $casts = [
        'price' => 'float',
        'stock_initial' => 'integer',
        'stock_available' => 'integer',
        'starts' => 'date_only', 
        'ends' => 'date_only',
        'is_active' => 'boolean',
    ];

    protected $appends = ['cart'];

    protected $cart;

    public function seller()
    {
    	return $this->belongsTo('App\Models\User', 'seller_id', 'id');
    }

    public function sells()
    {
    	return $this->hasMany('App\Models\Sale', 'product_id', 'id');
    }

    public function categories()
    {
    	return $this->belongsToMany('App\Models\Category', 'product_categories');
    }

    // mutators

    public function setCartAttribute($value)
    {
        return $this->cart = $value;
    }

    public function getCartAttribute()
    {
        return $this->cart;
    }  

    // methods:

    static function setCart(Collection $products, User $user)
    {
        $cart = $user->cart()
            ->whereIn('product_id' , $products->lists('id'))
            ->withPivot('created_at')
            ->get(['product_id as pid', 'cart.created_at as added_ca']);

        foreach($cart as $key => $ca){
            foreach($products as $item){
                if($item->id == $ca->pid) {
                    $item->cart = $ca->added_ca;
                }
            }
        }
    }
}
