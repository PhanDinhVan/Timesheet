@extends('admin.layout.index')
@section('content')


<!-- Page Content --> 
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h2 class="m-t-0 m-b-20 header-titles"><b>Tasks List</b> </h2>

            <div class="table-responsive">
                <div class="col-lg-7">
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}    
                        </div>
                    @endif
                </div>

                <table class="table table-striped add-edit-table" id="tasks_list">

                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Taks Name</th>
                            <th>Comments</th>
                            <th>Availability </th>
                            <th class="center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($task as $value)
                            <tr class="id{{$value->id}} gradeX">
                                <td class="project_Name">{{$value->project->name}}</td>
                                <td>{{$value->taskname}}</td>
                                <td>{{$value->comments}}</td>
                                <td>
                                    @if($value->availability == 1)
                                        {{"Yes"}}
                                    @else
                                        {{"No"}}
                                    @endif
                                </td>

                                <td class="actions center">
                                    <a href="<?=Request::root()?>/admin/task/edit/{{$value->id}}" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit"><i class="fa fa-pencil"></i></a>

                                    <a href="{{ $value->id }}" class="on-default delete-task" data-toggle="modal" data-target="#delete_task" data-placement="top" title="Delete" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.modal.modal_delete')

@endsection