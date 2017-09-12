<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable as UserAuth;

class Cart extends Controller
{
	protected $pageLimit = 10;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(UserAuth $user, $uid)
    {
        $query = $user->cart()
        	->select(['cart.created_at as added_cart', 'product_id as id', 'title', 'subtitle', 'seller_id', 'price', 'stock_available', 'starts', 'ends', 'is_active'])
            ->with(['seller' => function($q) {$q->select(['username', 'id']);}]);

        $count = $query->count();

        $items = $query->forPage(request('page', 1), request('limit', $this->pageLimit))->get();

        foreach($items as $item){
            $item->cart = $item->added_cart;
        }

        return [
            "count" => $count,
            "limit" => request('limit', $this->pageLimit),
            "page" => request()->input('page', 1),
            "items" => $items,
        ];            
    }

    public function store(UserAuth $user, $uid)
    {
        $this->validateJson(request()->all(), $rules = [
            'pid' => 'required|integer|exists:products,id,deleted_at,NULL',
        ]);

        if(!$user->cart()->find($pid = request('pid'), ['product_id']))
        	$user->cart()->attach($pid, ['created_at' => new \DateTime()]);

        return ['status' => 'added'];    	
    }

    public function destroy(UserAuth $user, $uid, $pid)
    {
        $this->validateJson(['pid' => $pid], $rules = [
            'pid' => 'required|integer|exists:cart,product_id,user_id,'.$uid,
        ]);

        $user->cart()->detach($pid);

        return ['status' => 'dettached'];          
    }
}