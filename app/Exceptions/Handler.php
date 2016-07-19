<?php

namespace Allison\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Request;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        /*if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        return parent::render($request, $e);*/

        /*
         * modified with code below to return json response in the angular app
         * helpful: https://laraveltips.wordpress.com/category/handling-exceptions-and-custom-exceptions-laravel-5-1/
         */

        switch($e){

            case ($e instanceof ModelNotFoundException):

                return $this->renderException($e);
                break;

            case ($e instanceof FbException):

                return $this->renderException($e, $request);
                break;

           default:

               return parent::render($request, $e);

       }
    }

    protected function renderException($e, $request)
    {
        //dd($request->ajax());

        switch ($e) {

            case ($e instanceof ModelNotFoundException):
                return response()->view('errors.404', [], 404);
                break;

            case ($e instanceof FbException):

                if ($request->ajax() || $request->wantsJson()){
                    return Response::json(['status' => 'error', 'message' => ['error_message' => $e->getMessage()], 'error_code' => $e->getCode(), 'data' => null]);
                }else{
                    return response()->view('errors.fb_errors', compact('e'));
                }

                break;


            default:
                return (new SymfonyDisplayer(config('app.debug')))
                    ->createResponse($e);

        }

    }
}
