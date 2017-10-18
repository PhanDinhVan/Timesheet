@extends('layout.index')

@include('layout.header')

@section('content')
<!-- Page Content --> 


<div class="row">
  	<div class="col-md-6">
    	
      	<div class="x_content">
        	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#yourModal">
        		<i class="fa fa-plus pull-left" style="margin-top: 5%;"></i>Add Time
        	</button>
      	</div>
    </div>
    <div class="btn-group" data-toggle="buttons" style="float: right; padding-right: 2%;">
    	<label class="btn btn-default active">
      		<input type="radio" name="options" id="option1"> Day
    	</label>
    	<label class="btn btn-default">
      		<input type="radio" name="options" id="option2"> Week
    	</label>
    	<label class="btn btn-default">
      		<input type="radio" name="options" id="option3"> Month
    	</label>
  	</div>
               
</div>


<!-- Modal trong laravel -->
@include('pages.modal')
@include('pages.calendar')
<!-- /#page-wrapper -->	

@endsection