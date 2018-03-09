@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
        <h2 class="m-t-0 m-b-20 header-titles"><b>Users Report</b> </h2>
            <div class="row">
                <div class="col-lg-9">

                    <div class="p-20">
                        <form class="form-horizontal">
                            
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label class="col-form-label">From</label>
                                    <input type="text" name="from" id="from" class="form-control" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}" >
                                </div>

                                <div class="col-md-3">
                                    <label class="col-form-label">To</label>
                                    <input type="text" name="to" id="to" class="form-control" placeholder="yyyy-mm-dd" required value="{{ date('Y-m-d') }}" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class=" col-md-3">
                                    <label class="col-form-label">Select users</label>
                                    <select multiple="multiple" class="multi-select" id="framework" name="my_multi_select1[]" data-plugin="multiselect">
                                        @foreach($username as $value)
                                        <option value="{{$value->id}}" name="check">{{$value->firstname}} {{$value->lastname}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                <div class=" col-md-3 offset-md-3">
                                    <button type="button" class="btn btn-info" id="searchCustomer" onclick="search_Username()">
                                        <span class="glyphicon glyphicon-search"></span> Search
                                    </button>
                                </div>
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>

            <div class="table-responsive">
    
            </div>
        </div>
    </div>
</div>
    
@include('error.messages')
       
<!-- /#page-wrapper --> 

@endsection

@section('script')
	<script  type="text/javascript">

		// ============= from ================
		$('#from').datepicker({
			changeMonth:true,
			changeYear:true,
			format:'yyyy-mm-dd',
            autoclose: true
		});

		// $('#from').change(function () {
  //   		var from = $('#from').val();
  //   		var to = $('#to').val();
  //   		showTime(from,to)
		// });

		// =============== to ===============
		$('#to').datepicker({
			changeMonth:true,
			changeYear:true,
			format:'yyyy-mm-dd',
            autoclose: true
		});

		// $('#to').change(function () {
  //   		var to = $('#to').val();
  //   		var from = $('#from').val();
  //   		showTime(from,to)
		// });

		function showTime(from,to){
			$.get("admin/report/showReport",{from:from,to:to}, function(data){
                
                // console.log(data)
                $('.table-responsive').html(data)
            });
		}

		// $(document).ready(function(){
		//  	$('#framework').multiselect({
		//   		nonSelectedText: 'Username',
		//   		enableFiltering: true,
		//   		enableCaseInsensitiveFiltering: true,
		//  	 	buttonWidth:'auto',
		//  	 	// select all users
		//  	 	includeSelectAllOption: true
		//  	});
		// });

        $(document).ready(function(){
            $('#framework').multiSelect();

        });


		function search_Username(from,to,user_id){
			var from = $('#from').val();
    		var to = $('#to').val();
    		var user_id = $('#framework').val();
    		// alert(user_id);
    		if(user_id){
    			$.get("admin/report/showReport",{from:from,to:to,user_id:user_id}, function(data){
	                // console.log(data)
	                $('.table-responsive').html(data)
	            });
    		}else{
    			// alert("Please select username!");
                $('#select_username').modal('show');
    		}
		}

	</script>
@endsection
