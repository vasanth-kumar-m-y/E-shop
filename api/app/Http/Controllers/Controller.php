<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function validateJson($data, array $rules, array $messages = [], array $customAttributes = [])
    {
    	$validator = \Validator::make($data, $rules, $messages, $customAttributes);

    	if ($validator->fails()) {
            $this->errorValidateJson($validator->errors()->getMessages());
        }
    }

    protected function errorValidateJson($messages)
    {
        $response = new JsonResponse($messages, 422);
        throw new HttpResponseException($response);
    }


    protected function errorJson($message = '', $code = null, $extra = [], $httpCode = 422)
    {
		$response = new JsonResponse(['code' => $code, 'message' => $message, 'extra' => $extra], $httpCode);
        throw new HttpResponseException($response);
    }

    protected function notFoundJson($msg = 'Not Found', $code = 404, $extra = [])
    {
    	$this->errorJson($msg, $code, $extra, 404);   
    }

    protected function accessDeniedJson($message = 'Access Denied', $code = 403, $extra = [])
    {
        $this->errorJson($msg, $code, $extra, 403);
    }
}
