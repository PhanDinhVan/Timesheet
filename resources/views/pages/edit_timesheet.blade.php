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


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"></span></button>
        <h4 class="modal-title" id="myModalLabel">{{"Edit entry"}}</h4>
      </div>
      <div class="modal-body">
          @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}} <br>
                @endforeach
            </div>
          @endif

          @if(session('thongbao1'))
              <div class="alert alert-success">
                  {{session('thongbao1')}}
              </div>
          @endif
          <form action="users/timesheet_edit" method="POST">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              
              <div class="form-group" style="width: 40%; float: left;">
                  <label>Project Name</label>
                  <select class="form-control" name="project_id_edit" id="project_edit">
                      @foreach($project as $value)
                      <option value="{{$value->id}}">{{$value->name}}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group" style="width: 40%; float: left; margin-left: 20%;">
                  <label>Task Name</label>
                  <select class="form-control" name="task_id_edit" id="task_edit">
                      @foreach($task as $value)
                          <option value="{{$value->id}}">{{$value->taskname}}</option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group" style="width: 18%; float: left;">
                  <label>Date</label>
                  <input class="date2 form-control" type="text" name="start_date_edit">
              </div>
              <!-- datepicker -->
              <script type="text/javascript">
                $('.date2').datepicker({  
                   format: 'yyyy-mm-dd'
                 });  
              </script>

              <div class="form-group" style="width: 15%; float: left; margin-left: 10%;">
                  <label>From</label>
                    <input class="timepicker_edit form-control" type="text" id="startTime_edit" style="text-align: center;"> 
              </div>
               <div class="form-group" style="width: 15%; float: left; margin-left: 3%;">
                  <label>To</label>
                     <input class="timepicker2_edit form-control" type="text" id="endTime_edit" style="text-align: center;">
              </div>
             
              <script type="text/javascript">
                  $('.timepicker_edit').datetimepicker({
                      format: 'HH:mm'
                  }); 
                  $('.timepicker2_edit').datetimepicker({
                      format: 'HH:mm'
                  });

                  // show working_time
                  $('.timepicker2_edit').on("dp.change",function(e){
                    
                      var startTime = document.getElementById('startTime_edit').value;
                      var endTime = document.getElementById('endTime_edit').value;
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

                      document.getElementById("working_time_edit").value = temp;

                  });
              </script>  

              <div class="form-group" style="width: 20%; float: left; margin-left: 5%;">
                  <label>Working Time</label>
                  <input class="working_date form-control" type="text" readonly="" name = "working_time_edit" id="working_time_edit" style="text-align: center;">
              </div>
              <div class="form-group" style="width: 11%; float: left; margin-left: 3%;">
                  <label>Overtime</label>
                    <input class="form-control" type="text" name="overtime" style="text-align: center;"> 
              </div>
              <div class="form-group">
                  <label style="width: 100%;">Note</label>
			      <textarea class="form-control" name="note1" cols="50" rows="4"></textarea>
              </div>
          <form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>Cancel</button>
        <button type="submit" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="edit1" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        <input class="form-control " type="text" placeholder="Mohsin">
        </div>
        <div class="form-group">
        
        <input class="form-control " type="text" placeholder="Irshad">
        </div>
        <div class="form-group">
        <textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>
    
        
        </div>
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>





 <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>