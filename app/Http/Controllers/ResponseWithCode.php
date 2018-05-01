<?php

namespace App\Http\Controllers;


class ResponseWithCode {

	CONST SUCCESS = 0; // 成功
	CONST FAIL = 10000; // 失败
	CONST PARAM_INVALID = 10001;  // 参数校验无效
	CONST DATABASE_CONNECTION_FAIL = 10002;
	CONST DATABASE_QUERY_FAIL = 10003;
	CONST UNAUTHENTICATED = 10004;

	public static function success($data = []) {
		return response()->json([
			'code' => self::SUCCESS,
			'message' => 'success',
			'data' => $data,
		]);
	}

	public static function fail($message = 'fail', $code = self::FAIL, $data = []) {
		return response()->json([
			'code' => $code,
			'message' => is_string($message) ? $message : json_encode($message, JSON_UNESCAPED_UNICODE),
			'data' => $data,
		]);
	}

	public static function expired() {
		$message = '登录过期';
		$code = self::UNAUTHENTICATED;
		return self::fail($message, $code);
	}

}