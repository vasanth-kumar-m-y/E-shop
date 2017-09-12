<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable as UserAuth;


class Product extends Controller
{
    protected $pageLimit = 10;

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['store', 'update', 'destroy']]);
    }

    public function index(UserAuth $user = null)
    {
    	$query = \App\Models\Product::query()
    		->select(['id', 'seller_id', 'title', 'subtitle', 'price', 'stock_available', 'starts', 'ends', 'is_active'])
    		->with([
    			'seller' => function($q) {$q->select('id', 'username');},
    			'categories'
    		])
            ->where('is_active', '=', '1');

        if($search = request('search'))
        	$query->where('title', 'like', '%' . $search . '%')
        		  ->orWhere('subtitle', 'like', '%' . $search . '%');

        $count = $query->count();

        $items = $query->orderBy(request('sort_by', 'title'), request('sort_order', 'asc'))
            ->forPage(request('page', 1), request('limit', $this->pageLimit))
            ->get();

        if($user) \App\Models\Product::setCart($items, $user);

        return [
            "count" => $count,
            "limit" => $this->pageLimit,
            "page" => request()->input('page', 1),
            "items" => $items
        ];
    }

    public function store(UserAuth $user)
    {
        $this->validateJson(request()->all(), $rules = [
            'title' => 'required|title|min:4|max:60',
            'subtitle' => 'title|min:4|max:120',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock_initial' => 'integer',
            'stock_available' => 'integer',
            'starts' => 'required|date_format:d/m/Y',
            'ends' => 'required|date_format:d/m/Y',
            'is_active' => 'required|boolean',
        ]);

		$data = reqOnlyIfExists(array_keys($rules));

        $data['seller_id'] = $user->id;
		$data['starts'] = \DateTime::createFromFormat('d/m/Y', $data['starts']);
		$data['ends'] = \DateTime::createFromFormat('d/m/Y', $data['ends']);


        // price:

        if($data['price'] < 0)
        	$this->errorValidateJson(['price' => 'price must be positive']);

        // stock:

        if(isset($data['stock_available']) && !isset($data['stock_initial']))
        	$data['stock_initial'] = $data['stock_available'];

        if(isset($data['stock_initial']) && !isset($data['stock_available']))
        	$data['stock_available'] = $data['stock_initial'];
        
        if(isset($data['stock_initial']) && $data['stock_initial'] < 0)
        	$this->errorValidateJson(['stock_initial' => 'quantity must be zero or positive integer']);

        if (isset($data['stock_initial']) && $data['stock_initial'] < $data['stock_available']) 
        	$this->errorValidateJson(['stock_initial' => 'stock initial must be greater than stock available']);

        // start / end:

        if($data['starts'] >= $data['ends'])
        	$this->errorValidateJson(['starts' => 'start date must be before end date']);

        $starts2 = clone $data['starts'];
        if($starts2->sub(new \DateInterval('PT1H')) < new \DateTime())
        	$this->errorValidateJson(['starts' => 'start date must start from present']);


        return \App\Models\Product::create($data);
    }


    public function show($id)
    {
    	$product = \App\Models\Product::query()
    		->with([
    			'seller' => function($q) {$q->select('id', 'username');}, 
    			'categories'
    		])
            ->find($id);

        if($userAuth = \Auth::user()) 
            \App\Models\Product::setCart(collect([$product]), $userAuth);

        return $product ?: $this->notFoundJson();
    }


    public function update(UserAuth $user, $id)
    {
		$product = \App\Models\Product::find($id) ?: $this->notFoundJson();

        $this->validateJson(request()->all(), $rules = [
            'title' => 'sometimes|required|title|min:4|max:60',
            'subtitle' => 'title|min:4|max:120',
            'description' => 'sometimes|required',
            'price' => 'sometimes|required|numeric',
            'stock_initial' => 'integer',
            'stock_available' => 'integer',
            'starts' => 'sometimes|required|date_format:d/m/Y',
            'ends' => 'sometimes|required|date_format:d/m/Y',
            'is_active' => 'sometimes|required|boolean',
        ]);

		$data = reqOnlyIfExists(array_keys($rules));
		
		if(isset($data['starts']))  
			$data['starts'] = \DateTime::createFromFormat('d/m/Y', $data['starts']);
		if(isset($data['ends']))  
			$data['ends'] = \DateTime::createFromFormat('d/m/Y', $data['ends']);		

		$dataAll = array_merge($product->toArray(), $data);

		if(is_string($dataAll['starts']))  
            $dataAll['starts'] = \DateTime::createFromFormat('d/m/Y', $dataAll['starts']);

		if(is_string($dataAll['ends']))  
            $dataAll['ends'] = \DateTime::createFromFormat('d/m/Y', $dataAll['ends']);	

        // price:

        if(isset($data['price']) && $data['price'] < 0)
        	$this->errorValidateJson(['price' => 'price must be positive']);

        // stock:

		if(isset($data['stock_initial']) && ($data['stock_initial'] < $dataAll['stock_available']))
			$this->errorValidateJson(['stock_initial' => 'stock initial must be greater or equal than stock available']);				
		

		if(isset($data['stock_available']) && ($data['stock_available'] > $dataAll['stock_initial']))
			$this->errorValidateJson(['stock_available' => 'stock available must be lower or equal than stock initial']);				
		
        // start / end dates:

		if(isset($data['starts']) && ($data['starts'] >= $dataAll['ends']))
			$this->errorValidateJson(['starts' => 'start date must be before ends date']);

		if(isset($data['ends']) && ($data['ends'] < $dataAll['starts']))
			$this->errorValidateJson(['ends' => 'end date must be after start date']);


		$product->update($data);

		return $product;
    }


    public function destroy($pid)
    {
        $product = \App\Models\Product::find($pid) ?: $this->notFoundJson();

        $product->delete();

        return ['status' => 'deleted'];
    }
}
