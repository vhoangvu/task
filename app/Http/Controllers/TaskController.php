<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Task;
use App\Repository\TaskRepository;

use Validator;

class TaskController extends Controller {
	/**
	 * Show list of task.
	 *
	 * @return Response
	 */
	public function index(Request $request, TaskRepository $repository) {
		return view ( "task.index" );
	}
	public function ajax_list(TaskRepository $repository) {
		$tasks = $repository->read_list_by ( 'completed', false );
		return $tasks->toJson ();
	}
	public function ajax_save(Request $request, TaskRepository $repository) {
		$this->validate($request, [
				"task.name" => "required|max:500",
				"task.due_date" => "required",
				]);
		
		$task = $repository->insert ( $request->input ( "task" ) );
		return $task->toJson ();
	}
	public function ajax_check_duedate(Request $request, TaskRepository $repository) {
		$return_columns = array ();
		$return_columns [] = "id";
		$tasks = $repository->read_list_by ( "due_date", $request->input ( "due_date" ), "<=", $return_columns );
		return $tasks->toJson ();
	}
	public function ajax_completed(Request $request, TaskRepository $repository, $id) {
		$task = $repository->update ( ['completed'=>true], $id );
		return $id;
	}
}