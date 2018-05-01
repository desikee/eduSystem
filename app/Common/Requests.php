<?php

namespace App\Common;

/**
 * HTTP Request 库
 * Class Requests
 * @package App\Common
 */
class Requests
{
	public function __construct()
	{
	}

	public static function request($url, $params, $method = 'GET', $extend_header = array())
	{
		$ci = curl_init();
		curl_setopt($ci, CURLOPT_POST, TRUE);
		curl_setopt($ci, CURLOPT_USERAGENT, 'test');
		curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 3);
		curl_setopt($ci, CURLOPT_TIMEOUT, 5);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ci, CURLOPT_HEADER, false);
		$headers = (array)$extend_header;

		switch ($method) {
			case 'POST' :
				curl_setopt($ci, CURLOPT_POST, TRUE);
				if (!empty($params)) {
					curl_setopt($ci, CURLOPT_POSTFIELDS, http_build_query($params));
				}
				break;
			case 'GET' :
				if (!empty($params)) {
					$url = $url . (strpos($url, '?') ? '&' : '?') . (is_array($params) ? http_build_query($params) : $params);
				}
				break;
		}
		curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE);
		curl_setopt($ci, CURLOPT_URL, $url);
		if ($headers) {
			curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
		}

		$response = curl_exec($ci);
		curl_close($ci);
		return $response;
	}

	/**
	 * 简单的get请求
	 * @param $url
	 * @param $params
	 * @param array $extend_header
	 * @return mixed
	 */
	public static function get($url, $params, $extend_header = array())
	{
		return self::request($url, $params, 'GET', $extend_header);
	}

	/**
	 * 简单的post请求
	 * @param $url
	 * @param $params
	 * @param array $extend_header
	 * @return mixed
	 */
	public static function post($url, $params, $extend_header = array())
	{
		return self::request($url, $params, 'POST', $extend_header);
	}
}
