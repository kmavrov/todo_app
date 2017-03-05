var addingNewProject = false;
$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#no-projects-selected').show();
    $('#project-info-fields').hide();
    $('#no-projects-selected-alert').hide();
	getTree();
    initSubtasksGrid();
    bindProjectButtons();
    bindDatePickerObjects();
    checkAdmin();
});

function initProjectsTree(data) {
    if (!data.length) {
        $('#no-projects-selected').hide();
        $('#project-info-fields').show();
    }
    $('#projects-tree').treeview({
        data: data,
        onNodeSelected: function(event, data) {
            $('#no-projects-selected').hide();
            $('#project-info-fields').show();
            initSubtasksGrid(data.id);
            fillProjectInfoFields(data);
            $("#tasks-grid").bootgrid('reload');
        }
    });
}

function getTree() {
    $.ajax({
        type: "GET",
        url: APP_URL + '/projects',
        data: {},
        success: function( projects ) {
            initProjectsTree(projects);
        }
    });
}

function bindProjectButtons() {
    $('#add-project-btn').bind('click', function () {
        addingNewProject = true;
        clearAddEditProjectFields();
        setAddProjectTitleToModal();
        $('#add-edit-project-modal').modal();
    });
    $('#edit-project-btn').bind('click', function () {
        var selectedProject = $('#projects-tree').treeview('getSelected');
        if (!selectedProject.length) {
            $('#no-projects-selected-alert').show();
            return false;
        }
        addingNewProject = false;
        clearAddEditProjectFields();
        populateAddEditProjectFields();
        setEditProjectTitleToModal();
        $('#add-edit-project-modal').modal();
    });
    $('#remove-project-btn').bind('click', function () {
        deleteProject();
    });
    $('#save-project-button').bind('click', function () {
        saveProjectChanges();
    });
    $('#mark-all-as-done').bind('click', function () {
        markAllAsDone();
    });
}

function clearAddEditProjectFields() {
    $('#project-name-textfield').val('');
    $('#project-description-textarea').val('');
    $("#project-start-date").val('');
    $("#project-due-date").val('');
}

function populateAddEditProjectFields() {

    var selectedProject = $('#projects-tree').treeview('getSelected');
    $('#project-name-textfield').val(selectedProject[0].name);
    $('#project-description-textarea').val(selectedProject[0].description);
    $("#project-start-date").val(selectedProject[0].start_date);
    $("#project-due-date").val(selectedProject[0].due_date);
}

function deleteProject() {
    var selectedProject = $('#projects-tree').treeview('getSelected');
    if (!selectedProject.length) {
        $('#no-projects-selected-alert').show();
        return false;
    }

    $.ajax({
        type: "DELETE",
        url: APP_URL + '/projects',
        data: {
            id: selectedProject[0].id
        },
        success: function( projects ) {
            getTree();
        }
    });

}

function markAllAsDone() {
    var selectedProject = $('#projects-tree').treeview('getSelected');
    if (!selectedProject.length) {
        $('#no-projects-selected-alert').show();
        return false;
    }

    $.ajax({
        type: "POST",
        url: APP_URL + '/projects/markAsDone',
        data: {
            id: selectedProject[0].id
        },
        success: function( projects ) {
            getTree();
        }
    });
}

function setEditProjectTitleToModal() {
    var element = $('#add-edit-project-modal').find('.modal-title')[0];
    $(element).html('Edit project');
    $('#mark-all-as-done').show();
}
function setAddProjectTitleToModal() {
    var element = $('#add-edit-project-modal').find('.modal-title')[0];
    $(element).html('Add project');
    $('#mark-all-as-done').hide();
}

function fillProjectInfoFields(data) {

    var name = data.name;
    if (data.delete_pending) {
        name = name + ' (Pending delete request)';
    }

    $('#project-name-field').html(name);
    $('#project-description-field').html(data.description);
    $('#project-start-date-field').html(data.start_date);
    $('#project-due-date-field').html(data.due_date);
    $('#project-completion-field').html(data.completed_count + ' / ' + data.all_tasks);
}

function bindDatePickerObjects() {
    $('#add-edit-project-modal .input-daterange').datepicker({
    });
}

function saveProjectChanges() {
    var projectVariables = {
        name: $('#project-name-textfield').val(),
        description: $('#project-description-textarea').val(),
        start_date: $("#project-start-date").val(),
        due_date: $("#project-due-date").val()
    }

    if (!addingNewProject) {
        projectVariables.id = $('#projects-tree').treeview('getSelected')[0].id;

        $.ajax({
            type: "PUT",
            url: APP_URL + '/projects',
            data: {
                projectVariables
            },
            success: function( projects ) {
                getTree();
                $('#add-edit-project-modal').modal('toggle');
            }
        });
    } else {
        $.ajax({
            type: "POST",
            url: APP_URL + '/projects',
            data: {
                projectVariables
            },
            success: function( projects ) {
                getTree();
                $('#add-edit-project-modal').modal('toggle');
            }
        });
    }
}