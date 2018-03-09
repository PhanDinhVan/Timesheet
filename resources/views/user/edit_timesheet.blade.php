<link href="../css/datepicker/bootstrap-datepicker.css" rel="stylesheet">
<script src="../js/jquery/jquery.js"></script>
<script src="../js/datepicker/bootstrap-datepicker.js"></script>
<script src="../js/datepicker/moment.min.js"></script>
<link href="../css/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="../js/datetimepicker/bootstrap-datetimepicker.min.js"></script> 

<style type="text/css">
  .admin_edit_username {
    width: 49%; 
    float: left;
  }
  .admin_edit_projectname {
    width: 43%; 
    float: left;  
    margin-left: 8%;
  }
  .admin_date {
    width: 24%; 
    float: left;
  }
  .admin_edit_working {
    width: 22%; 
    float: left; 
    margin-left: 3%; 
    margin-right: 8%;
  }
  .admin_edit_overtime {
    width: 15%;
    float: left; 
    margin-right: 3%
  }
  .admin_taskname {
    width: 25%; 
    float: left;
  }
  .center {
    text-align: center;
  }
  .user_edit_projectname {
    width: 40%; 
    float: left;
  }
  .user_taskname {
    width: 40%; 
    float: left; 
    margin-left: 20%
  }
  .user_date {
    width: 40%; 
    float: left;
  }
  .users_edit_working {
    width: 22%; 
    float: left; 
    margin-left: 20%; 
    margin-right: 3%;
  }
  .users_edit_overtime {
    width: 15%; 
    float: left;
  }
  .modal-footer {
    margin-top: 7%; 
    padding: 0%; 
    padding-top: 3%; 
    margin-bottom: -2%;
  }
</style>

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
          
          <form action="<?=Request::root()?>/updateByAjax" method="POST" id="frm-update">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <input type="hidden" name="position_edit" id="position_edit" value="{{ Auth::user()->position }}">

              @if(Auth::user()->position == 1)
                <div class="form-group admin_edit_username">
                    <label>User Name</label>
                    <select class="form-control" name="user_id_edit" id="user_id_edit">
                        @foreach($users as $value)
                        <option value="{{$value->id}}">{{$value->firstname}} {{$value->lastname}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group admin_edit_projectname">
                    <label>Project Name</label>
                    <input class="form-control" type="hidden" name="id" id="id">
                    <select class="form-control" name="project_id" id="project_id">
                        @foreach($project as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
                

                <div class="form-group admin_date">
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

                <div class="form-group admin_edit_working">
                    <label>Working Time</label>
                      <input class="timepicker form-control center" type="text" name="working_time_admin_edit" id="working_time_admin_edit"> 
                </div>
                <div class="form-group admin_edit_overtime">
                    <label>Overtime</label>
                      <input class="timepicker form-control center" type="text" name="overtime_admin_edit" id="overtime_admin_edit"> 
                </div>
                <script type="text/javascript">
                    $('.timepicker').datetimepicker({
                        format: 'HH:mm'
                    }); 
                </script>
                <div class="form-group admin_taskname">
                    <label>Task Name</label>
                    <select class="form-control" name="task_id" id="task_id">
                        @foreach($task as $value)
                            <option value="{{$value->id}}">{{$value->taskname}}</option>
                        @endforeach
                    </select>
                </div>
              @else
                <div class="form-group user_edit_projectname">
                    <label>Project Name</label>
                    <input class="form-control" type="hidden" name="id" id="id">
                    <select class="form-control" name="project_id" id="project_id">
                        @foreach($project as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group user_taskname">
                    <label>Task Name</label>
                    <select class="form-control" name="task_id" id="task_id">
                        @foreach($task as $value)
                            <option value="{{$value->id}}">{{$value->taskname}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group user_date">
                    <label>Date</label>
                    <input class="date form-control center" type="text" name="date_time_entries" id="date_time_entries">
                </div>
                <!-- datepicker -->
                <script type="text/javascript">
                  $('.date').datepicker({  
                     format: 'yyyy-mm-dd',
                     autoclose: true,
                   });  
                </script>

                <div class="form-group users_edit_working">
                    <label>Working Time</label>
                      <input class="timepicker form-control center" type="text" name="working_time_users_edit" id="working_time_users_edit"> 
                </div>
               
                
                <div class="form-group users_edit_overtime">
                    <label>Overtime</label>
                      <input class="timepicker form-control center" type="text" name="overtime_users_edit" id="overtime_users_edit"> 
                </div>

                <script type="text/javascript">
                    $('.timepicker').datetimepicker({
                        format: 'HH:mm'
                    }); 
                </script> 

                
              @endif

              <div class="form-group">
                  <label>Notes</label>
		              <textarea class="form-control" name="note" id="note" cols="50" rows="4"></textarea>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default cancel" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" class="btn btn-info" ><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
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

