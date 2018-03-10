<?php
namespace App\Repositories\Contracts;

class CommonRepository extends AbstractRepository {

    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

	public function changeModel($model) {
		$this->model = $model;
	}
}