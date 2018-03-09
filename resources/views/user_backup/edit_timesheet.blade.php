<link href="css/datepicker/bootstrap-datepicker.css" rel="stylesheet">
<script src="js/jquery/jquery.js"></script>
<script src="js/datepicker/bootstrap-datepicker.js"></script>
<script src="js/datepicker/moment.min.js"></script>
<link href="css/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="js/datetimepicker/bootstrap-datetimepicker.min.js"></script> 


<div class="modal fade" id="popup-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{"Edit time entries"}}</h4>
      </div>
      <div class="modal-body">

          @if(session('thongbao1'))
              <div class="alert alert-success">
                  {{session('thongbao1')}}
              </div>
          @endif
          
          <form action="updateByAjax" method="POST" id="frm-update">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <input type="hidden" name="position_edit" id="position_edit" value="{{ Auth::user()->position }}">

              <div class="form-group" style="width: 40%; float: left;">
                  <label>Project Name</label>
                  <input class="form-control" type="hidden" name="id" id="id">
                  <select class="form-control" name="project_id" id="project_id">
                      @foreach($project as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group" style="width: 40%; float: left; margin-left: 20%;">
                  <label>Task Name</label>
                  <select class="form-control" name="task_id" id="task_id">
                      @foreach($task as $value)
                          <option value="{{$value->id}}">{{$value->taskname}}</option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group" style="width: 18%; float: left;">
                  <label>Date</label>
                  <input class="date form-control" type="text" name="date_time_entries" id="date_time_entries">
              </div>
              <!-- datepicker -->
              <script type="text/javascript">
                $('.date').datepicker({  
                   format: 'yyyy-mm-dd',
                   autoclose: true,
                 });  
              </script>

              <div class="form-group admin_edit" style="width: 17%; float: left; margin-left: 8%; margin-right: 7%;">
                  <label>Working Time</label>
                    <input class="timepicker form-control" type="text" name="working_time_admin_edit" id="working_time_admin_edit" style="text-align: center;"> 
              </div>
              <div class="form-group users_edit" style="width: 17%; float: left; margin-left: 43%; margin-right: 10%;">
                  <label>Working Time</label>
                    <input class="timepicker form-control" type="text" name="working_time_users_edit" id="working_time_users_edit" style="text-align: center;"> 
              </div>
             
              <div class="form-group admin_edit" style="width: 11%; float: left; margin-right: 8%">
                  <label>Overtime</label>
                    <input class="timepicker form-control" type="text" name="overtime_admin_edit" id="overtime_admin_edit" style="text-align: center;"> 
              </div>
              <div class="form-group users_edit" style="width: 11%; float: left;">
                  <label>Overtime</label>
                    <input class="timepicker form-control" type="text" name="overtime_users_edit" id="overtime_users_edit" style="text-align: center;"> 
              </div>

              <script type="text/javascript">
                  $('.timepicker').datetimepicker({
                      format: 'HH:mm'
                  }); 
              </script> 

              <div class="form-group admin_edit" style="width: 30%; float: left;">
                  <label>User Name</label>
                  <select class="form-control" name="user_id_edit" id="user_id_edit">
                      @foreach($users as $value)
                      <option value="{{$value->id}}">{{$value->firstname}} {{$value->lastname}}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group">
                  <label>Notes</label>
		              <textarea class="form-control" name="note" id="note" cols="50" rows="4"></textarea>
              </div>

              <div class="modal-footer" style="margin-top: 7%; padding: 0%; padding-top: 3%; margin-bottom: -2%;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
              </div>
              
          </form>
      </div>
      
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {

      $(".admin_edit").hide(); 
      var position = $("#position_edit").val(); 
      if(position == 1){
        $(".users_edit").hide();
        $(".admin_edit").show(); 
      }
  })
</script>

