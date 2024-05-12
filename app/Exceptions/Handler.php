<?php

namespace App\Exceptions;

use App\Hps\eBug;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof HttpException && $e->getStatusCode() == 500) {
            return response()->view('errors.500', [], 500);
        }
        return parent::render($request, $e);
    }

    const DE_BUGS = 0;
    static $__countEx = false;

    public function setMsg($e, $status): string
    {
        $msg = "User:======" ;
        $msg .= "\nAccount Email: ";
        $msg .= "\nAccount Name: ";
        $msg .= "\nAccount: ";
        $msg .= "\nUser:======" ;
        $msg .= "\n\n<b>Message</b>: " . "<i>".$e->getMessage(). "</i>";
        $msg .= "\nStatusCode: " . $status;
        $msg .= "\nFile: " . $e->getFile() . ':' . $e->getLine();
        return $msg;
    }

    public function report(Throwable $e)
    {
        $status = self::DE_BUGS;
        if (!self::$__countEx) {
            self::$__countEx = true;
            $msg = $this->setMsg($e, $status);
           // eBug::getInstance()->debug($msg);
        }
        if ($this->shouldReport($e) && app()->bound('sentry')) {
            app('sentry')->captureException($e);
        }
        parent::report($e);
    }
}

