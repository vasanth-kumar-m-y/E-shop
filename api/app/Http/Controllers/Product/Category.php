<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Category extends Controller
{
    protected $pageLimit = 10;

    public function __construct()
    {
        $this->middleware('auth', ['only' => 'store', 'destroy']);
    }

    public function index($pid)
    {
    	$product = \App\Models\Product::find($pid) ?: $this->notFoundJson();

    	$query = $product->categories();

        $count = $query->count();

        $query->forPage(request('page', 1), request('limit', $this->pageLimit));

        return [
            "count" => $count,
            "limit" => request('limit', $this->pageLimit),
            "page" => request()->input('page', 1),
            "items" => $query->get()
        ];   
    }

    public function store(Request $request)
    {
        //to-do
    }

    public function destroy($pid, $cid)
    {
        //to-do
    }
}