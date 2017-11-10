@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 
    
<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 style="margin: 0px;" class="page-header">Report
                        <small>List</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7">
                  @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}    
                    </div>
                  @endif
                </div>
            </div>
            <!-- /.row -->
            <div class="panel panel-default">
            	<div class="panel-heading">
            		<table>
            			<tr>
            				<td>
            					<b><i class="fa fa-apple"> Starft</i></b>
            				</td>
            				<td>
            					<input type="text" name="from" id="from" class="form-control" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}">
            				</td>
            				<td>
            					<input type="text" name="to" id="to" class="form-control" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}">
            				</td>
            			</tr>
            		</table>
            	</div>
            	<div class="panel-body" style="padding-bottom: 4px;">
            		<p style="text-align: center;font-size: 20px;font-weight: bold;">Starft Report</p>
            	</div>
            	<div class="show-report-info">
            		
            	</div>
            	
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
       
<!-- /#page-wrapper --> 

@endsection

@section('script')
	<script  type="text/javascript">

		// ============= from ================
		$('#from').datepicker({
			changeMonth:true,
			changeYear:true,
			format:'yyyy-mm-dd'
		});

		$('#from').change(function () {
    		var from = $('#from').val();
    		var to = $('#to').val();
    		showTime(from,to)
		});

		// =============== to ===============
		$('#to').datepicker({
			changeMonth:true,
			changeYear:true,
			format:'yyyy-mm-dd'
		});

		$('#to').change(function () {
    		var to = $('#to').val();
    		var from = $('#from').val();
    		showTime(from,to)
		});

		function showTime(from,to){
			$.get("admin/report/showReport",{from:from,to:to}, function(data){
                
                // console.log(data)
                $('.show-report-info').html(data)
            });
		}

	</script>
@endsection
