<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Task;
use App\Repository\TaskRepository;

use Validator;

class TaskController extends Controller {
	private $request;
	private $repository;
	
	public function __construct(Request $request, TaskRepository $repository) {
		$this->request = $request;
		$this->repository = $repository;
	}
	public function index() {
		return view ( "task.index" );
	}
	public function ajax_list() {
		$tasks = $this->repository->read_list_by ( 'completed', false );
		return $tasks->toJson ();
	}
	public function ajax_save() {
		$this->validate($this->request, [
				"task.name" => "required|max:500",
				"task.due_date" => "required",
				]);
		
		$task = $this->repository->insert ( $this->request->input ( "task" ) );
		return $task->toJson ();
	}
	public function ajax_check_duedate() {
		$return_columns = array ();
		$return_columns [] = "id";
		$tasks = $this->repository->read_list_by ( "due_date", $this->request->input ( "due_date" ), "<=", $return_columns );
		return $tasks->toJson ();
	}
	public function ajax_completed($id) {
		$task = $this->repository->update ( ['completed'=>true], $id );
		return $id;
	}
}