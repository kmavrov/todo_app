var addingNewTask = false,
    selectedTaskID = 0,
    loadedTasksData = [];
$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    bindTasksButtons();

});

function initSubtasksGrid(project_id) {
    if (!project_id) {
        return false;
    }

    $("#tasks-grid").bootgrid({
        ajax: true,
        ajaxSettings: {
            method: "GET",
            cache: false
        },
        url: function() {
            var selectedProject = $('#projects-tree').treeview('getSelected');
            return 'tasks/' + selectedProject[0].id;
        },
        get: function ()
        {
            return {
            };
        },
        selection: true,
        multiSelect: false,
        rowSelect: true,
        navigation: 2,
        formatters: {
            "completed": function(column, row)
            {
                loadedTasksData.push(row);
                return row.completed ? '<span class="label label-success"><span class=\"glyphicon glyphicon-ok\"></span> Finished</span>' : '<span class="label label-warning"><span class=\"glyphicon glyphicon-remove\"></span> In progress</span>';
            },
            "actions": function(column, row) {
                if(row.completed) {
                    return row.updated_at;
                }
                return "<button type=\"button\" class=\"btn btn-xs btn-success\" data-row-id=\"" + row.id + "\" onClick=\"markTaskAsFinished("+row.id+");return false;\"><span class=\"glyphicon glyphicon-ok\"></span> Finish</button> ";
            }
        },
        labels: {
            noResults: "No tasks for the current project",
            infos: "Showing {{ctx.start}} to {{ctx.end}} of {{ctx.total}} tasks",
            loading: "Loading tasks for the selected project"
        }
    })
    .on("load.rs.jquery.bootgrid", function (e)
    {
        selectedTaskID = 0;
        loadedTasksData = [];
    })
    .on("selected.rs.jquery.bootgrid", function (e, selectedRows)
    {
        selectedTaskID = selectedRows[0].id;
    });
}

function markTaskAsFinished(task_id) {
    $.ajax({
        type: "PUT",
        url: APP_URL + '/tasks',
        data: {
            task_id: task_id,
            completed: 1
        },
        success: function( projects ) {
            $("#tasks-grid").bootgrid('reload');
        }
    });
}

function bindTasksButtons() {
    $('#add-task-btn').bind('click', function () {
        addingNewTask = true;
        setAddTaskTitleToModal();
        clearAddEditTaskFields();
        $('#add-edit-task-modal').modal('toggle');
    });
    $('#edit-task-btn').bind('click', function () {
        addingNewTask = false;

        if (selectedTaskID == 0) {
            return false;
        }
        setEditTaskTitleToModal();
        clearAddEditTaskFields();
        populateAddEditTaskFields();
        $('#add-edit-task-modal').modal('toggle');
    });
    $('#remove-task-btn').bind('click', function () {
        addingNewTask = true;
        removeTask();
    });
    $('#export-task-btn').bind('click', function () {
        addingNewTask = false;
        exportTasks();
        $('#add-edit-task-modal').modal('toggle');
    });
    $('#mark-task-undone').bind('click', function () {
        markTaskAsUndone();
    });
    $('#save-task-button').bind('click', function () {
        saveTaskChanges();
    });
}

function clearAddEditTaskFields() {
    $('#task-name-textfield').val('');
    $('#task-description-textarea').val('');
}

function setEditTaskTitleToModal() {
    var element = $('#add-edit-task-modal').find('.modal-title')[0];
    $(element).html('Edit task');
    $('#mark-task-undone').show();
}
function setAddTaskTitleToModal() {
    var element = $('#add-edit-task-modal').find('.modal-title')[0];
    $(element).html('Add task');
    $('#mark-task-undone').hide();
}

function populateAddEditTaskFields() {
    var task = getTaskFromTaskArray(selectedTaskID);
    
    $('#task-name-textfield').val(task.name);
    $('#task-description-textarea').val(task.description);
}

function getTaskFromTaskArray(selectedRow) {
    var tmpTask;
    loadedTasksData.forEach(function (row) {
        if (row.id == selectedRow) {
            tmpTask = row;
        }
    });

    return tmpTask;
}

function markTaskAsUndone() {
    $.ajax({
        type: "PUT",
        url: APP_URL + '/tasks',
        data: {
            task_id: selectedTaskID,
            completed: 0
        },
        success: function( projects ) {
            $("#tasks-grid").bootgrid('reload');
        }
    });
}

function removeTask() {
    $.ajax({
        type: "DELETE",
        url: APP_URL + '/tasks',
        data: {
            task_id: selectedTaskID
        },
        success: function( projects ) {
            $("#tasks-grid").bootgrid('reload');
        }
    });
}

function saveTaskChanges() {
    var taskVariables = {
        name: $('#task-name-textfield').val(),
        description: $('#task-description-textarea').val(),
        project_id: $('#projects-tree').treeview('getSelected')[0].id
    }

    if (!addingNewTask) {
        taskVariables.task_id = selectedTaskID;
        $.ajax({
            type: "PUT",
            url: APP_URL + '/tasks',
            data: {
                task_id: taskVariables.task_id,
                name: taskVariables.name,
                description: taskVariables.description,
                project_id: taskVariables.project_id
            },
            success: function( projects ) {
                getTree();
                $('#add-edit-task-modal').modal('toggle');
                $("#tasks-grid").bootgrid('reload');
            }
        });
    } else {
        $.ajax({
            type: "POST",
            url: APP_URL + '/tasks',
            data: {
                taskVariables
            },
            success: function( projects ) {
                getTree();
                $('#add-edit-task-modal').modal('toggle');
                $("#tasks-grid").bootgrid('reload');
            }
        });
    }
}