function checkAdmin() {
    $.ajax({
        type: "GET",
        url: APP_URL + '/admin',
        data: {
        },
        success: function( forDeletion ) {
            if (forDeletion.forDeletion > 0) {
                $('#pending-deletions').show();
                $('#no-projects-selected').hide();
                $('#project-info-fields').show();
                initProjectsForDeletionGrid();
            } else {
                $('#pending-deletions').hide();
                $('#no-projects-selected').show();
                $('#project-info-fields').hide();
            }
        }
    });
}

function initProjectsForDeletionGrid() {

    $("#deletion-grid").bootgrid({
        ajax: true,
        ajaxSettings: {
            method: "GET",
            cache: false
        },
        url: function() {
            return 'admin/getProjectsForDeletion';
        },
        get: function ()
        {
            return {
            };
        },
        selection: false,
        multiSelect: false,
        rowSelect: true,
        navigation: 0,
        formatters: {
            "accept": function(column, row)
            {
                return "<button type=\"button\" class=\"btn btn-xs btn-success\" data-row-id=\"" + row.id + "\" onClick=\"acceptProjectDeletion("+row.id+");return false;\"><span class=\"glyphicon glyphicon-ok\"></span> Accept</button> ";
            },
            "reject": function(column, row) {
                return "<button type=\"button\" class=\"btn btn-xs btn-danger\" data-row-id=\"" + row.id + "\" onClick=\"rejectProjectDeletion("+row.id+");return false;\"><span class=\"glyphicon glyphicon-remove\"></span> Reject</button> ";
            }
        }
    });
}

function acceptProjectDeletion(project_id) {
    $.ajax({
        type: "POST",
        url: APP_URL + '/admin/acceptDeletion',
        data: {
            project_id: project_id
        },
        success: function( projects ) {
            $("#deletion-grid").bootgrid('reload');
        }
    });
}

function rejectProjectDeletion(project_id) {
    $.ajax({
        type: "POST",
        url: APP_URL + '/admin/rejectDeletion',
        data: {
            project_id: project_id
        },
        success: function( projects ) {
            $("#deletion-grid").bootgrid('reload');
        }
    });
}