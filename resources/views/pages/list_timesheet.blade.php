<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>


 <style>
    .agenda {}
    /* Dates */
    
    .agenda .agenda-date {
        width: 170px;
    }
    
    .agenda .agenda-date .dayofmonth {
        width: 40px;
        font-size: 36px;
        line-height: 36px;
        float: left;
        text-align: right;
        margin-right: 10px;
    }
    
    .agenda .agenda-date .shortdate {
        font-size: 0.75em;
    }

</style>



<div class="container">
        <h1 class="thick-heading" style="text-align: center;">Timesheet</h1>
        <!-- First Featurette -->
        <div class="featurette" id="about">
            <div class="container">
                <div class="agenda">
                    <div class="table-responsive">
                    	<div class="form-group">

						    <label>Today</label>
							<input class="date form-control" type="text" id="datepicker" style="width: 9%;">
						</div>
						<!-- datepicker -->
						<script type="text/javascript">
							$("#datepicker").datepicker({format: 'yyyy-mm-dd'}).datepicker("setDate", new Date());
						    $('.date').datepicker({  
						       format: 'yyyy-mm-dd'
						     });  
						</script>

                        <table class="table table-condensed table-bordered" id="tab1">
                            <thead>
                                <tr>
                                    <th id="dayofweek"></th>
                                </tr>
                                <tr style="text-align: center; font-size: 14px;">
                                    <td>Project name</td>
                                    <td>Task name</td>
                                    <td>Working time</td>
                                    <td>Over time</td>
                                    <td>Date</td>
                                    <td>Edit</td>
                                    <td>Delete</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($time_entries as $value)
                                    <tr class="id{{$value->id}}">
                                        <td class="agenda-date">
                                            <div class="shortdate text-muted"><span class="projectname">{{$value->task_id}}</span></div>
                                        </td>
                                        <td class="agenda-date">
                                            <div class="shortdate text-muted"><span class="taskname">{{$value->task_id}}</span></div>
                                        </td>
                                        <td class="agenda-date">
                                             <div class="shortdate text-muted"><span>{{$value->working_time}}</span></div>
                                        </td>
                                        <td class="agenda-date">
                                            <div class="shortdate text-muted"><span>{{$value->overtime}}</span></div>
                                        </td>
                                        <td class="agenda-date">
                                            <div class="shortdate text-muted"><span>{{$value->date_time_entries}}</span></div>
                                        </td>
                                        <td class="agenda-date">
                                            <input class="term" type="hidden" value="{{$value->id}}" />
                                            <button class="shortdate text-muted edit" type="button" data-toggle="modal" >
                                                <a class="btn btn-success btn-xs" id="edit" data-id="{{$value->id}}">Edit</a>
                                            </button>
                                        </td>
                                        <td class="agenda-date">
                                            <button class="btn btn-danger btn-dell" href="{{ url('delete',$value->id)}}" type="button" data-toggle="modal" data-target="#delete">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @include('pages.list_timesheet_changeDate')
                    </div>
                </div>
            </div>
        <!-- /.container -->
</div>



