<!DOCTYPE html>
<html>
<head>
<title>Task List</title>

<link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet"
	type="text/css">

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" media="screen"
	href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
<script type="text/javascript"
	src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript"
	src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js"></script>

<script
	src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.12.7/vue.min.js"></script>

<script
	src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment-with-locales.min.js"></script>

<link rel="stylesheet" href="lib/flipclock.css">
<script src="lib/flipclock.min.js"></script>

<script src="lib/notify.min.js"></script>

<script src="lib/bootstrap.validator.min.js"></script>

<script>
        var _token = "{{ csrf_token() }}";
      </script>

<style>
.padding-bottom {
	padding-bottom: 10px;
}

.padding-top {
	padding-top: 10px;
}

.due {
	color: red;
}
</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 padding-top">
				<div id="clock"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h1>Task</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12 padding-bottom">
							<form class="form-inline" id="task_form" method="POST">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<label for="task_name">Task Name</label> 
									<input type="text" class="form-control" id="task_name" name="task[name]" placeholder="Task Name">
								</div>
								<div class="form-group has-feedback">
									<label for="due_date">Due Date</label>
									<div class="input-group" id="due_date_datepicker">
										<input type="text" class="form-control" id="due_date" name="task[due_date]" placeholder="Due Date" data-format="yyyy-MM-dd hh:mm:ss"> 
										<span class="input-group-addon add-on"> 
											<i data-time-icon="glyphicon glyphicon-time" data-date-icon="glyphicon glyphicon-calendar"></i>
										</span>
									</div>
								</div>
								<button type="button" class="btn btn-primary" id="add_task">Add</button>
							</form>
						</div>
						<div class="col-md-12">
							<table class="table table-bordered table-hover" id="task_list">
								<tr>
									<th>Id</th>
									<th>Name</th>
									<th>Due Date</th>
									<th>Completed</th>
								</tr>
								<template v-repeat="items" track-by="id">
									<tr class="@{{is_due == true ? 'due' : ''}}">
										<td>@{{id}}</td>
										<td><span id="task_id_@{{id}}">@{{name}}</span></td>
										<td>@{{due_date}}</td>
										<td><input v-on="click : complete" type="checkbox"></td>
									</tr>									
								</template>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/TaskManager.js"></script>
	<script src="js/ClockManager.js"></script>
</body>
</html>
