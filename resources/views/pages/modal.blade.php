
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  


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
          <form action="users/timesheet" method="POST">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              
              <div class="form-group" style="width: 40%; float: left;">
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
              <div class="form-group" style="width: 40%; float: left; margin-left: 20%;">
                  <label>Task Name</label>
                  <select class="form-control" name="task_id" id="task">
                      <!-- @foreach($task as $value)
                      <option value="{{$value->id}}">{{$value->taskname}}</option>
                      @endforeach -->
                      @foreach($task as $value)
                      <!-- <option 
                          @if($value->project->id == $value->project_id) {{"selected"}} @endif 
                          value="{{$value->id}}">{{$value->taskname}}</option> -->
                          <option value="{{$value->id}}">{{$value->taskname}}</option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group" style="width: 18%; float: left;">
                  <label>Date</label>
                  <input class="date1 form-control" type="text" name="start_date">
              </div>
              <!-- datepicker -->
              <script type="text/javascript">
                $('.date1').datepicker({  
                   format: 'yyyy-mm-dd'
                 });  
              </script>

              <div class="form-group" style="width: 15%; float: left; margin-left: 15%;">
                  <label>From</label>
                    <input class="timepicker form-control" type="text" id="startTime" style="text-align: center;"> 
              </div>
               <div class="form-group" style="width: 15%; float: left; margin-left: 8%;">
                  <label>To</label>
                     <input class="timepicker2 form-control" type="text" id="endTime" style="text-align: center;">
              </div>
             
              <script type="text/javascript">
                  $('.timepicker').datetimepicker({
                      format: 'HH:mm'
                  }); 
                  $('.timepicker2').datetimepicker({
                      format: 'HH:mm'
                  });

                  // show working_time
                  $('.timepicker2').on("dp.change",function(e){
                    
                      var startTime = document.getElementById('startTime').value;
                      var endTime = document.getElementById('endTime').value;
                      // alert(startTime);
                      // alert(endTime);
                      function parseTime(s) {
                         var c = s.split(':');
                         return parseInt(c[0]) * 60 + parseInt(c[1]);
                      }
                      var minutes = parseTime(endTime) - parseTime(startTime);
                      var hours = Math.floor(minutes/60);
                      var minutes = minutes%60;

                      // var a = moment(startTime, 'HH:mm');
                      // var b = moment(endTime, 'HH:mm');
                      // var minutes2 = b.diff(a, 'hours', true);

                      temp = hours + ':' + minutes

                      document.getElementById("working_time").value = temp;

                  });
              </script>  

              <div class="form-group" style="width: 20%; float: left; margin-left: 5%;">
                  <label>Working Time</label>
                  <input class="working_date form-control" type="text" readonly="" name = "working_time" id="working_time" style="text-align: center;">
              </div>

              <div class="form-group">
                  <label>Note</label>
		              <textarea class="form-control" name="note" cols="50" rows="4"></textarea>
              </div>
          <form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Cancel</button>
        <button type="submit" class="btn btn-success" ><span class="glyphicon"></span>Save</button>
      </div>
    </div>
  </div>
</div>


