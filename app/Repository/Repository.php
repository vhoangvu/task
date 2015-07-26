<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use App\Repository\IRepository;

abstract class Repository implements IRepository {
	protected $model;
	public function __construct() {
		$this->create_model ();
	}
	abstract function model_full_name();
	public function create_model() {
		$model_full_name = $this->model_full_name ();
		$model = new $model_full_name ();
		
		$this->model = $model;
	}
	public function read_list() {
		return $this->model->all ();
	}
	public function read_list_by($column, $value, $operator = '=', $return_columns = array('*')) {
		return $this->model->where ( $column, $operator, $value )->get ( $return_columns );
	}
	public function insert(array $data) {
		return $this->model->create ( $data );
	}
	public function delete($id) {
		return $this->model->destroy ( $id );
	}
}