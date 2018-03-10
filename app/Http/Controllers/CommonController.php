<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommonController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected $repository;
	protected $params;
	protected $request;

	public function __construct(AbstractRepository $repository, Request $request)
	{
		$this->repository = $repository;
		$this->request = $request;
		$this->params = $this->request->all();
	}

	public static function responseWithJsonSuccess($data = []) {
        return response()->json([
            'code' => 0,
            'message' => 'success',
            'data' => $data,
        ]);
    }

    public static function responseWithJsonFail($message = 'fail', $code = 1001, $data = []) {
        return response()->json([
            'code' => $code,
            'message' => is_string($message) ? $message : json_encode($message, JSON_UNESCAPED_UNICODE),
            'data' => $data,
        ]);
    }

	public static function responseWithJsonSimple($code = true) {
		if ($code === true) {
			self::responseWithJsonSuccess();
		} else {
			self::responseWithJsonFail($code);
		}
	}

	public function validate(){
		
	}
}
