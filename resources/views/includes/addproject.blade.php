<div class="modal fade" tabindex="-1" role="dialog" id="add-edit-project-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Project</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="project-name-textfield">Project name</label>
                        <input type="email" class="form-control" id="project-name-textfield" aria-describedby="emailHelp" placeholder="Enter project name">
                    </div>
                    <div class="form-group">
                        <label for="project-description-textarea">Project description</label>
                        <textarea class="form-control" id="project-description-textarea" rows="3" placeholder="Add project description"></textarea>
                    </div>
                    <div class="input-daterange input-group" id="datepicker">
                        <span class="input-group-addon">From </span>
                        <input type="text" class="input-sm form-control" name="start" id="project-start-date"/>
                        <span class="input-group-addon"> to </span>
                        <input type="text" class="input-sm form-control" name="end" id="project-due-date"/>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="mark-all-as-done" data-dismiss="modal">Mark all as done</button>
                <button type="button" class="btn btn-primary" id="save-project-button"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->