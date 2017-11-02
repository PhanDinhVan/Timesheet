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

<div class="modal fade" id="popup-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{"Edit entry"}}</h4>
      </div>
      <div class="modal-body">

          @if(session('thongbao1'))
              <div class="alert alert-success">
                  {{session('thongbao1')}}
              </div>
          @endif
          
          <form action="updateByAjax" method="POST" id="frm-update">
              <input type="hidden" name="_token" value="{{csrf_token()}}">

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

              <div class="form-group" style="width: 17%; float: left;">
                  <label>Date</label>
                  <input class="date form-control" type="text" name="date_time_entries" id="date_time_entries">
              </div>
              <!-- datepicker -->
              <script type="text/javascript">
                $('.date').datepicker({  
                   format: 'yyyy-mm-dd'
                 });  
              </script>

              <div class="form-group" style="width: 17%; float: left; margin-left: 43%; margin-right: 10%;">
                  <label>Working Time</label>
                    <input class="timepicker form-control" type="text" name="working_time" id="working_time" style="text-align: center;"> 
              </div>
             
              <script type="text/javascript">
                  $('.timepicker').datetimepicker({
                      format: 'HH:mm'
                  }); 
                  
              </script>  
              <div class="form-group" style="width: 11%; float: left;">
                  <label>Overtime</label>
                    <input class="form-control" type="text" name="overtime" id="overtime" style="text-align: center;"> 
              </div>
              <div class="form-group">
                  <label>Note</label>
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