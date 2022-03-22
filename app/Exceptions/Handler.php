<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

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
        /*Redirecciona a la pagina login en caso de haber perdido session*/
        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {

            return redirect('/login');

        }

        # Excepciones de base de datos
        if ($exception instanceof \PDOException) {
            # Manejo de errores con JavaScript
            return redirect()->back()
            ->with('msg','No se pudo establecer conexion con el servidor')
            ->with('title-msg','Error')
            ->with('type','error')
            ->with('icon','error');
        }

        return parent::render($request, $exception);
    }
}
