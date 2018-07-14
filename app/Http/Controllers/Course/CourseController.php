<?php
/**
 * Created by PhpStorm.
 * User: desikee
 * Date: 2018/7/12
 * Time: 23:29
 */
namespace app\Http\Controllers\Course;
use App\Facades\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\Train\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Train\CourseRepository;
class CourseController extends Controller
{
    public function __construct(TaskRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function index()
    {
        return view('course.index');
    }

    public function getList()
    {
        $rules = [
            'datatable.pagination.page' => 'required',
            'datatable.pagination.perpage' => 'required',
        ];
        $validator = Validator::make($this->params, $rules);
        if ($validator->errors()) {
            $this->responseWithJsonFail($validator->errors()->messages());
        }

        $query = $this->params['datatable']['query'] ?? [];
        $queryColumn = ['student_id'];
        foreach ($query as $key => $value) {
            // 过滤掉非允许查询字段以及空查询字段
            if (!in_array($key, $queryColumn) || empty($value)){
                unset($query[$key]);
            }
        }

        return $this->repository->getStudentTaskList(
            $query,
            $this->params['datatable']['pagination']['perpage'],
            $this->params['datatable']['pagination']['page']
        );
    }
}
?>