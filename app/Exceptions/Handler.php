<?php

namespace App\Exceptions;

use App\Http\Controllers\ResponseWithCode;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

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

	protected $customRender = [
		ValidationException::class => [
			'render' => 'renderValidationException',
			'report' => ''
		],
		AuthenticationException::class => [
			'render' => 'renderAuthenticationException'
		]
	];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
	    // 调试模式返回原生异常调用栈
//	    if (!config('app.debug')) {
//		    return parent::render($request, $exception);
//	    }

	    // 如果定义了该异常处理，则自定义异常处理方法
	    $renderMethod = $this->customRender[get_class($exception)]['render'] ?? '';
	    if ($renderMethod && method_exists($this, $renderMethod)) {
		    return $this->$renderMethod($request, $exception);
	    }

	    return parent::render($request, $exception);
    }

	public function renderValidationException($request, ValidationException $exception)
	{
		if ($request->expectsJson()) {
			return ResponseWithCode::fail($exception->errors(), ResponseWithCode::PARAM_INVALID);
		}
//		return response()->view('errors.404',[],404);
		return parent::render($request, $exception);
	}

	public function renderAuthenticationException($request, AuthenticationException $exception)
	{
		return $request->expectsJson()
			? response()->json(['message' => $exception->getMessage()], 401)
			: redirect()->guest(route('login'));
	}
}
