@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 
	
<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Permisson Users Projects
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
                
                <table class="table table-striped table-bordered table-hover" id="permisson_users_projects">
                    <thead>
                     
                        <tr align="center">
                            <!-- <th>No</th> -->
                            <th>Username</th>
                            <th>Project Name</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                     
                    </thead>
                    <tbody>
                       @foreach($permisson as $key => $value)
                        <tr class="odd gradeX">
                          <!-- <td>{{++$key}}</td> -->
                          <td class="username">{{$value->user->firstname}} {{$value->user->lastname}}</td>
                          <td>{{$value->project->name}}</td>
                          <td class="center acb"><i class="fa fa-trash-o acb"></i><a href="admin/permisson/delete/{{$value->id}}"> Delete</a></td>
                          <td class="center"><i class="fa fa-pencil-square-o"></i> <a href="admin/permisson/edit/{{$value->id}}">Edit</a></td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
                <div style="float: right;">{{ $permisson->links() }}</div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
       
<!-- /#page-wrapper -->	

@endsection


@section('script')
<!--  <script>
 	$(document).on('click','.acb',function(e){
        var result = confirm("Do you want to delete?");
        if (result) {
            
        }
        else{
        	window.location.href = " {{ URL::to('admin/permisson/list') }}";
        }
    })
 </script> -->

<script type="text/javascript">
  $(document).ready(function(){

    var span = 1;
    var prevTD = "";
    var prevTDVal = "";

    // gom dong cua cot username
    $("#permisson_users_projects tbody tr td.username").each(function() { //for each first td in every tr
        var $this = $(this);
        if ($this.text() == prevTDVal) { // check value of previous td text
          span++;
          if (prevTD != "") {
              prevTD.attr("rowspan", span); // add attribute to previous td
              $this.remove(); // remove current td
          }
        } else {
          prevTD     = $this; // store current td 
          prevTDVal  = $this.text();
          span       = 1;
        }
    });

  })
  
</script>

@endsection