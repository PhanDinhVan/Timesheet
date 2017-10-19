<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


<style type="text/css">
  .start_date{
    float: left;
    margin-top: 1%; 
    margin-right: 3%;
    margin-left: 20%;
  }

  .working_date{
    float: left;
    margin-top: 1%; 
    margin-right: 3%;
  }
</style>


<div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{"Add entry"}}</h4>
      </div>
      <div class="modal-body">
          @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}} <br>
                @endforeach
            </div>
          @endif

          @if(session('thongbao'))
              <div class="alert alert-success">
                  {{session('thongbao')}}
              </div>
          @endif
          <form action="timesheet" method="POST">
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
                  <select class="form-control" name="task_id">
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
                  <select class="form-control" name="user_id">
                      @if(Auth::check())
                      	<option value="{{Auth::user()->id}}">{{Auth::user()->lastname}}</option>
                     	@endif
                  </select>
              </div>
              <div class="form-group">
                  <label class="working_date">Working Time</label>
			              <input class="form-control" type="text" name="working_time" style="width: 8%; float: left;">
              </div>

              <div class="form-group">
                  <label class="start_date">Start Date</label>
                  <input class="date1 form-control" type="text" name="start_date" style="width: 17%;">
              </div>
              <!-- datepicker -->
              <script type="text/javascript">
                $('.date1').datepicker({  
                   format: 'yyyy-mm-dd'
                 });  
              </script>

              <div class="form-group">
                  <label>Note</label>
			              <textarea class="form-control" name="note" cols="50" rows="4"></textarea>
              </div>
          <form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

