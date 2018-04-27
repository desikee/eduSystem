<?php

namespace App\Http\Middleware;

use App\Facades\Admin;
use App\Model\Admin\OperationLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * 操作日志记录中间件
 * Class LogOperation
 * @package App\Http\Middleware
 */
class LogOperation
{
	/**
	 * 不记录的路由
	 * @var array
	 */
	protected $dontLog = [

	];

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 *
	 * @throws \Illuminate\Auth\AuthenticationException
	 */
	public function handle($request, Closure $next)
	{
		if ($this->shouldLogOperation($request)) {
			$log = [
				'user_id' => Admin::user()->id,
				'path'    => $request->path(),
				'method'  => $request->method(),
				'ip'      => $request->getClientIp(),
				'input'   => json_encode($request->input()),
			];

			OperationLog::create($log);
		}

		return $next($request);
	}

	protected function shouldLogOperation(Request $request)
	{
		return config('admin.operation_log.enable')
		&& !$this->inExceptArray($request)
		&& Admin::user();
	}

	/**
	 * 过滤掉从配置列表中读取的路由，不记录日志
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return bool
	 */
	protected function inExceptArray($request)
	{
		foreach (config('admin.operation_log.except') as $except) {
			if ($except !== '/') {
				$except = trim($except, '/');
			}

			$methods = [];

			if (Str::contains($except, ':')) {
				list($methods, $except) = explode(':', $except);
				$methods = explode(',', $methods);
			}

			$methods = array_map('strtoupper', $methods);

			if ($request->is($except) &&
				(empty($method) || in_array($request->method(), $methods)))
			{
				return true;
			}
		}

		return false;
	}
}
