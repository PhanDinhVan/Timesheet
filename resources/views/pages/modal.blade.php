<div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{"Add entry"}}</h4>
      </div>
      <div class="modal-body">
       <form action="admin/user/add" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            
                            <div class="form-group">
                                <label>Project Name</label>
                                <select class="form-control" name="project_id">
                                    @foreach($task as $value)
                                    <option value="{{$value->project_id}}">{{$value->project->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Task Name</label>
                                <select class="form-control" name="taskname">
                                    <!-- @foreach($task as $value)
                                    <option value="{{$value->id}}">{{$value->taskname}}</option>
                                    @endforeach -->
                                    @foreach($task as $value)
                                    <option 
                                        @if($value->project->id == $value->project_id) {{"selected"}} @endif 
                                        value="{{$value->id}}">{{$value->taskname}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <select class="form-control" name="username">
                                    @if(Auth::check())
                                    	<option value="{{Auth::user()->username}}">{{Auth::user()->lastname}}</option>
                                   	@endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Working Time</label>
   								<input class="date form-control" type="text" name="working_time">
                            </div>
                            <div class="form-group">
                                <label>Note</label>
   								<textarea class="date form-control" name="note" cols="50" rows="4"></textarea>
                            </div>
                        <form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>