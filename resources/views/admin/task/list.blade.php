@extends('admin.layout.index')
@section('content')


<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tasks
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
                
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Project Name</th>
                          <th>Taks Name</th>
                          <th>Comments</th>
                          <th>Availability </th>
                          <th>Delete</th>
                          <th>Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                      	@foreach($task as $value)
                        <tr>
                          <td>{{$value->id}}</td>
                          <td>{{$value->project->name}}</td>
                          <td>{{$value->taskname}}</td>
                          <td>{{$value->comments}}</td>
                          <td>
                            @if($value->availability == 1)
                              {{"Yes"}}
                            @else
                              {{"No"}}
                            @endif
                          </td>
                          <td><i class="fa fa-trash-o"></i><a href="admin/task/delete/{{$value->id}}"> Delete</a></td>
                          <td><i class="fa fa-pencil-square-o"></i> <a href="admin/task/edit/{{$value->id}}">Edit</a></td>
                        </tr>
                        @endforeach
                      </tbody>
</table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>
@endsection
