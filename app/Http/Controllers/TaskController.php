<?php

  namespace App\Http\Controllers;
  
  use Illuminate\Http\Request;
  use App\Http\Controllers\Controller;
  
  use App\Model\Task;
  use App\Repository\TaskRepository;
  
  class TaskController extends Controller
  {
    /**
    * Show list of task.
    *
    * @return Response
    */
    public function index(Request $request, TaskRepository $repository) {
      return view("task.index");
    }
    
    public function ajax_list(TaskRepository $repository) {
      $tasks = $repository->read_list();
      return $tasks->toJson();
    }
    
    public function ajax_save(Request $request, TaskRepository $repository) {
      $tasks = $repository->insert($request->input("task"));
      return $tasks->toJson();
    }
    
    public function ajax_check_duedate(Request $request, TaskRepository $repository) {
      $return_columns = array();
      $return_columns[] = "id";
      $tasks = $repository->read_list_by("due_date", $request->input("due_date"), "<=", $return_columns);
      return $tasks->toJson();
    }
    
    public function ajax_completed(Request $request, TaskRepository $repository, $id) {
      $tasks = $repository->delete($id);    
      return $id;
    }
  }