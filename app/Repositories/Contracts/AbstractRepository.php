<?php

namespace App\Repositories\Contracts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * 资源库顶层抽象类，这儿实现一些共有的方法
 */
abstract class AbstractRepository {
    /**
     * The Model instance.
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;
	protected $error_message;

    /**
     * 获取当前模型所对应表的列名结构
     * @return mixed
     */
    public function getColumnList()
    {
        $column_list = Schema::getColumnListing($this->model->getTable());
        if (empty($column_list)) {
            $table = $this->model->getConnection()->getDatabaseName() . '.' . $this->model->getTable();
            $query = 'SHOW COLUMNS FROM '. $table;
            $column_name = 'Field';
            foreach(DB::select($query) as $column)
            {
                $column_list[] = $column->$column_name;
            }
        }
        return $column_list;
    }

	public function setModel($model) {
		$this->model = $model;
	}

	public function getErrorMessage(){
		return $this->error_message;
	}

	/**
	 * 新增一条记录
	 * @param $params
	 * @param array $rules 校验规则，只使用校验过的参数
	 * @return mixed
	 */
    public function add($params, $rules = [])
    {
        $model = new $this->model;
        $column_list = $this->getColumnList();
        foreach ($params as $key => $value)
        {
            if ((empty($rules) || array_key_exists($key, $rules))
	            && in_array($key, $column_list))
            {
                $model->$key = $value;
            }
        }
        return $model->save();
    }

	public function save(array $info) {
		if (is_array($info)) {
			foreach($info as $key => $value) {
				$this->model->$key = $value;
			}
		}
		return $this->model->save();
	}

	/**
	 * 更新表字段
	 * @param $params
	 * @param array $rules 校验规则，只使用校验过的参数
	 * @return bool
	 */
    public function edit($params, $rules = [])
    {
        if (!isset($params['id']))
        {
	        $this->error_message = '没有查到该记录';
            return false;
        }
        $up = $this->find($params['id']);
        $column_list = $this->getColumnList();
	    foreach ($params as $key => $value)
        {
	        if ((empty($rules) || array_key_exists($key, $rules))
		        && in_array($key, $column_list))
            {
                $up->$key = $value;
            }
        }
        return $up->save();
    }

    /**
     * 删除指定模型数据(软删除）需在模型中配置deleted_at 字段， 如果未定义这个字段，则调用强制删除
     * @param  int $id
     * @return boolean
     */
    public function delete($id)
    {
        $column_lists = $this->getColumnList();
        if (isset($column_lists['deleted_at']))
        {
            return $this->getById($id)->destroy();
        }
        return $this->forceDelete($id);
    }

    /**
     * 完全删除该记录
     * @param $id
     */
    public function forceDelete($id)
    {
        return $this->getById($id)->forceDelete();
    }

    /**
     * 获取指定id的数据
     * @param  int  $id
     * @return App\Models\Model
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * 获取指定数据和相关列的数据
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = array('*')) {
        return $this->model->find($id, $columns);
    }

    /**
     * 查询指定列和值的数据
     * @param $attribute
     * @param $value
     * @param string $type
     * @param array $columns
     * @return Collection
     */
    public function findByColumn($attribute, $value, $type = '=', $columns = array('*')) {
        return $this->model->where($attribute, $type, $value)->get($columns);
    }

    /**
     * 多条件组合查询
     * @param array $option 数组形式条件['id' => 1, 'name' => 'test']
     * @param array $columns  获取的列 ['id', 'version']
     * @return mixed
     * @author: rumi.zhao
     */
    public function findByOption($option, $columns = array('*'))
    {
        return $this->model->where($option)->first($columns);
    }

	public function getColumnType($column) {
		return $this->model->where([])->groupBy($column)->get([$column]);
	}

	/**
	 * 获取给定页面大小的数据
	 * @param $record
	 * @param $perpage
	 * @param $page
	 * @return mixed
	 */
    public function paginate($record, $perpage, $page) {
        $record = is_array($record) ? $record : $record->toArray();
        $total = count($record);
	    $offset = ($page - 1) * $perpage;  // 计算其实偏移
//	    $paginator = new LengthAwarePaginator($record, $total, $perpage, $page);// 使用自定义分页
	    $result['meta'] = [
		    'page' => $page,
		    'pages' => ceil($total / $perpage),
		    'perpage' => $perpage,
		    'total' => $total,
		    'sort' => 'asc',
		    'field' => 'id'
	    ];
	    $result['data'] = array_slice($record, $offset, $perpage);
	    return $result;
    }

    public function getList($query = [], $perpage, $page)
    {
        return $this->paginate($this->model->where($query)->orderBy('id', 'desc')->get(),
            $perpage, $page);
    }

    /**
     * 检查指定列是否重复
     * @param $data
     * @param array|string $columns
     * @return bool
     * @author: rumi.zhao
     */
    public function checkColumn($data, $columns)
    {
        $condition = array();
        isset($data['id']) ?: $data['id'] = -1;   // 区分新增和更新的版本检查
        if (is_string($columns))  // 单个参数的情况转化为数组
        {
            $columns = [$columns];
        }
        foreach($columns as $column)
        {
            if (isset($data[$column]))  // 检查data中指定的列
            {
                $condition[$column] = $data[$column];
            }
        }
        $result = $this->model->where($condition)->first();  // 从数据库中根据data自定列查找数据
	    // 如果数据库中能够查到数据，并且这个版本和当前不一样，则说明该字段已经被占用
        if ($result && $result['id'] != $data['id'])
        {
            return true;
        }
        return false;
    }
}