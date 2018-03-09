<!-- Delete User -->
<div class="modal fade" id="delete_user" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete User</h4>
            </div>
            <div class="modal-body">
                <p>Do you want delete?</p>
            </div>
            <div class="modal-footer">
                <a href="<?=Request::root()?>/admin/user/delete/{{$value->id}}" id="id_delete_user" class="btn btn-info" role="button">Yes</a>
                <button type="button" class="btn btn-default cancel" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Task -->
<div class="modal fade" id="delete_task" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Task</h4>
            </div>
            <div class="modal-body">
                <p>Do you want delete?</p>
            </div>
            <div class="modal-footer">
                <a href="" id="id_delete_task" class="btn btn-info" role="button">Yes</a>
                <button type="button" class="btn btn-default cancel" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Project -->
<div class="modal fade" id="delete_project" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Project</h4>
            </div>
            <div class="modal-body">
                <p>Do you want delete?</p>
            </div>
            <div class="modal-footer">
                <a href="" id="id_delete_project" class="btn btn-info" role="button">Yes</a>
                <button type="button" class="btn btn-default cancel" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>


<!-- Delete Customer -->
<div class="modal fade" id="delete_customer" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete Customer</h4>
            </div>
            <div class="modal-body">
                <p>Do you want delete?</p>
            </div>
            <div class="modal-footer">
                <a href="" id="id_delete_customer" class="btn btn-info" role="button">Yes</a>
                <button type="button" class="btn btn-default cancel" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

