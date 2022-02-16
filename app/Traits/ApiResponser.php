<?php

namespace App\Traits;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


/** 
* 
*/
trait ApiResponser
{
    

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'   => 422,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status'=> $code, 
            'message' => $message, 
            'data' => $data
        ], $code);
    }
    
    protected function errorResponse($message = null, $code)
    {
        return response()->json([
            'status'=> $code,
            'message' => $message,
        ], $code);
    }
    
    protected function successResponseMessage($message = null, $code)
    {
        return response()->json([
            'status'=>'Success',
            'message' => $message,
        ], $code);
    }
    
    function apiPluck($array, $keyLabel = 'key', $valueLabel = 'value')
    {
        if ($array instanceof \Illuminate\Support\Collection) {
            $array = $array->toArray();
        } elseif (!is_array($array)) {
            return [];
        }
        
        $result = [];
        
        foreach ($array as $key => $value) {
            $result[] = [$keyLabel => $key, $valueLabel => $value];
        }
        
        return $result;
    }


    function apiResponse($data, $message = '', $status = 'success', $HttpStatus = 200, $headers = [], $options = 0)
    {
        return response()->json([
            'status' => $HttpStatus,
            'message' => strip_tags($message),
            'data' => $data,
        ], $HttpStatus, $headers, $options);
    }


  
    function apiExceptionResponse($exception, $data = [])
    {
        logger(array_slice(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2), -1));
        
        report($exception);
        
        if ($exception instanceof ValidationException) {
            return $this->apiResponse(['errors' => $exception->validator->getMessageBag()],
            trans('validation.message'), 'error', 422);
        }
        
        return $this->apiResponse(array_merge(['exception_code' => $exception->getCode()], $data),
        strip_tags($exception->getMessage()), 'error', 400);
    }

}
    
   
     
