<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {        
        // if ($request->wantsJson()) {   //add Accept: application/json in request
        // return parent::render($request, $exception);
        if (true)
        {
            return $this->handleApiException($request, $exception);
        } else {
            return parent::render($request, $exception);
        }
    }

    private function handleApiException($request, Exception $exception)
    {
        $exception = $this->prepareException($exception);
        if ($exception instanceof \Illuminate\Http\Exception\HttpResponseException) {
            $exception = $exception->getResponse();
        }
        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }
        return $this->customApiResponse($exception);
    }

    private function customApiResponse($exception)
    {
        $response = [];   
        //상태
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        // } else if (method_exists($exception, 'getCode')) {
        //     $statusCode = $exception->getCode();
        } else {
            $statusCode = 500;
        }     
        $response['status'] = $statusCode;

        //기본메세지
        $response['message'] = getMSG($statusCode);
        // |로 분리된 직접전달받은 메세지
        if(!empty($exception->getMessage()))
        {
            $response['message'] = explode('|', $exception->getMessage());
        }
        //상세내역
        if (config('app.debug')) {
            $response['trace'] = $exception->getTrace();
            $response['code'] = $exception->getCode();
        }
        
        return response($response, $statusCode); //오리지날
        // return response($response);
        // return response()->json($response, $statusCode);
    }
}