<link href="css/datepicker/bootstrap-datepicker.css" rel="stylesheet">
<script src="js/jquery/jquery.js"></script>
<script src="js/datepicker/bootstrap-datepicker.js"></script>
<script src="js/datepicker/moment.min.js"></script>
<link href="css/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="js/datetimepicker/bootstrap-datetimepicker.min.js"></script>


<style type="text/css">
  .admin{
    width: 40%; 
    float: left;
  }
  .projectname_admin{
    width: 40%; 
    float: left; 
    margin-left: 20%;
  }

  .projectname{
    width: 40%; 
    float: left;
  }
  .taskname{
    width: 40%; 
    float: left; 
    margin-left: 20%;
  }
  #date_add{
    text-align: center;
  }
</style>

<div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{"Add time entries"}}</h4>
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
          <form action="user/timesheet" method="POST" id="frm-add">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <input type="hidden" name="position_add" id="position_add" value="{{ Auth::user()->position }}">
              
              @if(Auth::user()->position == 1)
                <div class="form-group admin">
                    <!-- projectname -->
                    <label>User Name</label>
                    <select class="form-control" name="user_id" id="user_id">
                        @foreach($users as $value)
                        <option 
                            @if($value->id == Auth::user()->id) {{"selected"}} @endif 
                            value="{{$value->id}}">{{$value->firstname}} {{$value->lastname}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group projectname_admin">
                  <!-- taskname -->
                    <label>Project Name</label>
                    <select class="form-control" name="project_id" id="project">
                        <!-- @foreach($task as $value)
                        <option value="{{$value->project_id}}">{{$value->project->name}}</option>
                        @endforeach -->
                        @foreach($project as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" style="width: 20%; float: left;">
                    <label>Date</label>
                    <input class="date_add form-control" type="text" id="date_add" name="date_time_entries">
                </div>
                <!-- datepicker -->
                <script type="text/javascript">
                  $("#date_add").datepicker({format: 'yyyy-mm-dd', autoclose: true}).datepicker("setDate", new Date());
                </script>

                <div class="form-group admin" style="width: 17%; float: left; margin-left: 3%; margin-right: 20%;">
                    <label>Working Time</label>
                      <input class="timepicker form-control" type="text" id="working_time_admin" style="text-align: center;"> 
                      <input class="timepicker form-control" type="hidden" id="working_time_admin2" name="working_time_admin"> 
                </div>

                <script type="text/javascript">
                    $('.timepicker').datetimepicker({
                        format: 'HH:mm'
                    }); 

                    // show working_time
                    $('.timepicker').on("dp.change",function(e){

                        function parseTime(s) {
                           var c = s.split(':');
                           return parseInt(c[0]) * 60 + parseInt(c[1]);
                        }

                        var working_time_admin = document.getElementById('working_time_admin').value;
                        var minutes = parseTime(working_time_admin);
                        document.getElementById("working_time_admin2").value = minutes;
                    });
                </script>
               
                <div class="form-group" style="width: 40%; float: left;">
                  <!-- admin -->
                    <label>Task Name</label>
                    <select class="form-control" name="task_id" id="task">
                        @foreach($task as $value)
                            <option value="{{$value->id}}">{{$value->taskname}}</option>
                        @endforeach
                    </select>
                </div>
              @else
                <div class="form-group projectname">
                  <label>Project Name</label>
                  <select class="form-control" name="project_id" id="project">
                      @foreach($project as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group taskname">
                    <label>Task Name</label>
                    <select class="form-control" name="task_id" id="task">
                        @foreach($task as $value)
                          <option value="{{$value->id}}">{{$value->taskname}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="width: 17%; float: left;">
                  <label>Date</label>
                  <input class="date_add form-control" type="text" id="date_add" name="date_time_entries">
                </div>
                <!-- datepicker -->
                <script type="text/javascript">
                  $("#date_add").datepicker({format: 'yyyy-mm-dd'}).datepicker("setDate", new Date());
                </script>
                <div class="form-group users" style="width: 17%; float: left; margin-left: 43%; margin-right: 18%;">
                  <label>Working Time</label>
                  <input class="timepicker form-control" type="text" id="working_time_users" style="text-align: center;">
                  <input class="timepicker form-control" type="hidden" id="working_time_users2" name="working_time_users"> 
                </div>
                <script type="text/javascript">
                    $('.timepicker').datetimepicker({
                        format: 'HH:mm'
                    }); 

                    // show working_time
                    $('.timepicker').on("dp.change",function(e){

                        function parseTime(s) {
                           var c = s.split(':');
                           return parseInt(c[0]) * 60 + parseInt(c[1]);
                        }
                        
                        var working_time_users = document.getElementById('working_time_users').value;
                        var minutes = parseTime(working_time_users);
                        document.getElementById("working_time_users2").value = minutes;
                        
                    });
                </script>
              @endif

                <div class="form-group">
                    <label>Notes</label>
                    <textarea class="form-control" name="note" cols="50" rows="4"></textarea>
                </div>
             
              <div class="modal-footer" style="margin-top: 7%; padding: 0%; padding-top: 3%; margin-bottom: -2%;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" class="btn btn-success" ><span class="glyphicon glyphicon-save"></span> Save</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {

      $(".admin").hide(); 
      var position = $("#position_add").val(); 
      if(position == 1){
        $(".users").hide();
        $(".admin").show(); 
      }
  })
</script>


