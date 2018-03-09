@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 
   
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h2 class="m-t-0 m-b-20 header-titles"><b>Project List</b></h2>

            <div class="table-responsive">
                <div class="col-lg-7">
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}    
                        </div>
                    @endif
                </div>

                <table class="table table-striped add-edit-table" id="project_list">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Customer Name</th>
                            <th>Department</th>
                            <th class="center">Start Date</th>
                            <th class="center">End Date</th>
                            <th>Status</th>
                            <th class="center">Actions</th>
                        
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($project as $value)
                            <tr class="id{{$value->id}} gradeX">
                                <td>{{$value->id}}</td>
                                <td>{{$value->name}}</td>
                                <td>{{$value->customer->name}}</td>
                                <td>{{$value->department }}</td>
                                <td>
                                    @if($value->start_date)
                                        {{date('Y-m-d', strtotime($value->start_date))}}
                                    @else
                                        {{ " " }}
                                    @endif
                                </td>
                                <td>
                                    @if($value->start_date)
                                        {{date('Y-m-d', strtotime($value->end_date))}}
                                    @else
                                        {{ " " }}
                                    @endif
                                </td>
                                <td>
                                    @if($value->status == 1)
                                        {{"Active"}}
                                    @else
                                        {{"Close"}}
                                    @endif
                                </td>
                                <td class="actions center">
                                    <a href="<?=Request::root()?>/admin/project/edit/{{$value->id}}" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="Edit" data-original-title="Edit"><i class="fa fa-pencil"></i></a>

                                    <a href="{{ $value->id }}" class="on-default remove-row delete-project" data-toggle="modal" data-target="#delete_project" data-placement="top" title="Delete" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
       
<!-- /#page-wrapper --> 

@endsection