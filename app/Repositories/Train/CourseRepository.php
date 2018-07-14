<?php
/**
 * Created by PhpStorm.
 * User: desikee
 * Date: 2018/7/12
 * Time: 16:22
 */

namespace App\Repositories\Train;

use App\Facades\Admin;
use App\Model\Admin\LinkBackend;
use App\Model\Admin\User;
use App\Model\Admin\UserGame;
use App\Model\MagicInstall\Config;
use App\Model\MagicInstall\Link;
use App\Model\Train\Course;
use App\Model\Train\Task;
use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Support\Facades\Auth;

class CourseRepository extends AbstractRepository
{
    protected $model;

    public function __construct(Course $model = null)
    {
        $model || $model = new Course();
        $this->model = $model;
    }


    public function getCompleteStudent()
    {
        $student_ids = $this->model->where(['teacher_id' => Admin::user()->id,'status'=> Course::STATUS_DETAIL['complete']])
            ->get()->pluck('student_id');
        return User::whereIn('id', $student_ids)->get();
    }


    /**
     * 获取结项学员列表
     * @param array $query
     * @param $perpage
     * @param $page
     * @return mixed
     */
    public function getCompleteStudentList($query = [], $perpage, $page)
    {
        $query['status'] = Course::STATUS_DETAIL['complete'];
        $query['teacher_id'] = Admin::user()->id;
        $results = $this->model->where($query)->orderBy('id', 'desc')->get();
        return $this->paginate(
            $results,
            $perpage, $page
        );
    }

    public function addSubject($params, $rules = []){
        return parent::add($params, $rules);
    }
    public function getIDByUsername($username){
        return User::where(['username'=>$username])->first()->id;
    }

    public function getStudent(){
        $student_ids = $this->model->get()->pluck('student_id');
        return User::whereIn('id', $student_ids)->get();
    }

    public function getTeacher(){
        $teacher_ids = $this->model->get()->pluck('teacher_id');
        return User::whereIn('id', $teacher_ids)->get();
    }

    public function getCourse($id){
        return $this->model->where(['id'=>$id])->first();
    }

}
?>