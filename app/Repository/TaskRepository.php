<?php

namespace App\Repository;

use App\Repository\Repository;

class TaskRepository extends Repository {
	function model_full_name() {
		return "App\Model\Task";
	}
}