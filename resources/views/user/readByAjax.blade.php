
<!-- DataTables -->
<link href="../admin_asset/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    .center {
        text-align: center;
    }
    #position {
        display: none;
    }
</style>


<div class="row">

    <div class="col-sm-12">

        <div class="card-box">
            <div class="row">
                <div class="col-sm-6">
                    <div class="m-b-30">
                        <button id="add" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#yourModal">Add Time <i class="mdi mdi-plus-circle-outline"></i></button>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped add-edit-table" id="datatable-editable">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Project name</th>
                            <th>Task name</th>
                            <th class="username">User name</th>
                            <th class="center">Working time</th>
                            <th class="center">Over time</th>
                            <th class="center">Date</th>
                            <th class="center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <input type="text" name="position" id="position" value="{{ Auth::user()->position }}">
                        @foreach($timesheet as $key => $value)
                            <tr class="id{{$value->id}} gradeX">
                                <td>{{$value->id}}</td>
                                <td>{{$value->projectname}}</td>
                                <td>{{$value->taskname}}</td>
                                <td class="username">{{$value->firstname}} {{$value->lastname}}</td>
                                <td class="working_time center">{{$value->working_time}}</td>
                                <td class="overtime center">{{$value->overtime}}</td>
                                <td class="center">{{date('Y-m-d', strtotime($value->date_time_entries))}} </td>
                                <td class="actions center">
                                    <a href="{{ $value->id }}" class="on-default edit-row" data-toggle="modal" data-target="#popup-update" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a>

                                    <a href="{{ $value->id }}" class="on-default delete-row" data-toggle="modal" data-target="#delete" data-placement="top" title="Delete" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <!-- end: col -->

</div> <!-- end row -->

@include('user.delete_timesheet')


<!-- Required datatable js -->
<script src="../admin_asset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../admin_asset/plugins/datatables/dataTables.bootstrap4.min.js"></script>


<!-- Responsive examples -->
<script src="../admin_asset/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="../admin_asset/plugins/datatables/responsive.bootstrap4.min.js"></script>

<script src="../js/datatable/datatables.js"></script>
<script src="../js/validate/total_validate.js"></script>