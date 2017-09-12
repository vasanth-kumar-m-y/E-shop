<?php

use Illuminate\Support\Arr;

function make_resource($name, $controller, $options = []){

	resource($name, $controller, $options);

	$uri = '/' . str_replace('.', '/{id}/', $name);


    if(in_array('update', array_get($options, 'only'))){
        post($uri . '/{idz}', ['uses' => $controller. '@update', 'as' =>  env('API').'.'.$name . '.update-post']);
    }	
	if(in_array('update', array_get($options, 'only'))){
		post($uri . '/{idz}/update', ['uses' => $controller. '@update', 'as' =>  env('API').'.'.$name . '.update2-post']);
	}
	if(in_array('destroy', array_get($options, 'only'))){
		post($uri . '/{idz}/destroy', ['uses' => $controller. '@destroy', 'as' => env('API').'.'.$name . '.destroy-post']);
	}
}

function onlyExists()
{

}

function reqOnlyIfExists($keys)
{
    $keys = is_array($keys) ? $keys : func_get_args();

    $results = [];

    $input = request()->all();

    foreach ($keys as $key) {
    	if(request()->exists($key))
        	Arr::set($results, $key, Arr::get($input, $key));
    }

    return $results;
}