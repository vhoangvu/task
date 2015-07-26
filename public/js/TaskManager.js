// Create Task Manager object
var TaskManager = function() {
	var self = this;
	//Set Date Time Picker
	$('#due_date_datepicker').datetimepicker({
		language : 'vi-VN'
	});

	//Init Vue object
	this.vue = new Vue({
		el : '#task_list',
		data : {
			items : {}
		},
		methods : {
			complete : self.complete
		}
	});

	//Request Task List    
	$.ajax({
		url : "ajax/list",
		type : "GET",
		dataType : "JSON",
		success : function(result) {
			for (var i = 0; i < result.length; i++) {
				self.vue.$data.items.$add("obj_" + result[i].id, result[i]);
			}
			self.checkDueDateTimeout(self);
		}
	});

	//Bind click event to add button
	$("#add_task").click(
			function() {
				//Simple Validate Data
				var valid = true;
				if ($("#task_name").val() == "") {
					valid = false;
					$("#task_name").parent().addClass("has-error");
				} else {
					$("#task_name").parent().removeClass("has-error").addClass("has-success");
				}

				if ($("#due_date").val() == "") {
					valid = false;
					$("#due_date").parent().addClass("has-error");
				} else if (moment($("#due_date").val()).format("YYYY-MM-DD HH:mm:ss") == "Invalid date") {
					valid = false;
					$("#due_date").parent().addClass("has-error");
				} else {
					$("#due_date").parent().removeClass("has-error").addClass("has-success");
				}

				if (valid) {
					var formData = $("#task_form").serialize();
					$.ajax({
						url : "ajax/save",
						type : "POST",
						dataType : "JSON",
						data : formData,
						success : function(result) {
							if (result.id) {
								self.vue.$data.items.$set("obj_" + result.id, result);
								$("#task_form")[0].reset();
								$("#due_date").parent().removeClass("has-error").removeClass("has-success");
							}
						}
					});
				}
			});
};

TaskManager.prototype.timeOut = 6000;

TaskManager.prototype.checkDueDate = function(currentDate) {
	var self = this;
	$.ajax({
		url : "ajax/check/duedate",
		type : "GET",
		dataType : "JSON",
		data : {
			due_date : currentDate
		},
		success : function(result) {
			var items = self.vue.$data.items;
			for (var i = 0; i < result.length; i++) {
				var dueId = result[i].id;
				var dueObject = eval("items.obj_" + dueId);
				if (dueObject && dueObject.is_due == false) {
					dueObject.$set("is_due", true);
					$("#task_id_" + dueId).notify("Due Task", {autoHide: true, position: right});
				}
			}
		},
		complete : function(result) {
			self.checkDueDateTimeout(self);
		}
	});
}

TaskManager.prototype.checkDueDateTimeout = function(taskManagerInstance) {
	var currentDate = moment().format("YYYY-MM-DD HH:mm:ss");
	//console.log(moment("sfdfsd").format("YYYY-MM-DD HH:mm:ss"));
	setTimeout($.proxy(taskManagerInstance.checkDueDate, taskManagerInstance, currentDate), this.timeOut);
}

TaskManager.prototype.complete = function(e) {
	var targetVM = e.targetVM;
	var due = targetVM.$parent;
	$.ajax({
		url : "ajax/completed/" + e.targetVM.id,
		type : "POST",
		dataType : "JSON",
		data : {
			_token : _token
		},
		success : function(result) {
			due.$data.items.$delete(e.targetVM.$key);
		}
	});
}

var taskManager = new TaskManager();
