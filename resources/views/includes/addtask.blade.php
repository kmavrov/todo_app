<div class="modal fade" tabindex="-1" role="dialog" id="add-edit-task-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Task</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="task-name-textfield">Task name</label>
                        <input type="email" class="form-control" id="task-name-textfield" aria-describedby="emailHelp" placeholder="Enter task name">
                    </div>
                    <div class="form-group">
                        <label for="task-description-textarea">Task description</label>
                        <textarea class="form-control" id="task-description-textarea" rows="3" placeholder="Enter task description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="mark-task-undone"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Mark undone</button>
                <button type="button" class="btn btn-primary" id="save-task-button"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->