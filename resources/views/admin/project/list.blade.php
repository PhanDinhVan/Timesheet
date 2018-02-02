@extends('admin.layout.index')
@section('content')

<!-- Page Content --> 
    
<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Project
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
                
                <table class="table table-striped table-bordered table-hover" id="project_list">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Customer Name</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($project as $value)
                        <tr class="odd gradeX">
                          <td>{{$value->id}}</td>
                          <td>{{$value->name}}</td>
                          <td>{{$value->department }}</td>
                          <td>
                            @if($value->status == 1)
                                {{"Active"}}
                            @else
                                {{"Close"}}
                            @endif
                          </td>
                          <td class="start_date">{{$value->start_date }}</td>
                          <td class="end_date">{{$value->end_date}}</td>
                          <td>{{$value->customer->name}}</td>
                          <td><i class="fa fa-trash-o"></i><a href="admin/project/delete/{{$value->id}}"> Delete</a></td>
                          <td><i class="fa fa-pencil-square-o"></i> <a href="admin/project/edit/{{$value->id}}">Edit</a></td>
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
       
<!-- /#page-wrapper --> 

@endsection

@section('script')
  <script type="text/javascript">
    // setting date_time_entries
        var start_date = $('table tbody .start_date');
        start_date.each(function() {
            var a = $(this);
            var date_time = a.text();
            var myDate = new Date(date_time);
            var month =  myDate.getMonth() + 1;

        var full_date = myDate.getFullYear() + "-" + month + "-" + myDate.getDate();
        // alert(full_date);
        a.text(full_date);

        });


        var end_date = $('table tbody .end_date');
        end_date.each(function() {
            var a = $(this);
            var date_time = a.text();
            var myDate = new Date(date_time);
            var month =  myDate.getMonth() + 1;

        var full_date = myDate.getFullYear() + "-" + month + "-" + myDate.getDate();
        // alert(full_date);
        a.text(full_date);

        });

        $(document).ready(function(){

            $('#project_list').dataTable({
                'paging':   true,  // Table pagination
                'ordering': true,  // Column ordering
                'info':     false,  // Bottom left status text
                'responsive': true, // https://datatables.net/extensions/responsive/examples/
                'bLengthChange': false, // hide records per page
                // 'searching': false, // hide Search
                // 'rowsGroup': [0], // gop row of column 
              
        
                oLanguage: {
                    sSearch:      'Search: ',
                    sLengthMenu:  '_MENU_ records per page',
                    zeroRecords:  'Nothing found - sorry',
                    infoEmpty:    'No records available',
                    infoFiltered: '(filtered from MAX total records)'
                 },
                // Datatable Buttons setup
                dom: '<"html5buttons"B>lTfgitp',
             columnDefs: [  
            
                // dinh nghia cho delete edit
                {   "targets": [7],
                    "orderable": false,
                    "type": "string"
                }, 
                {   "targets": [8],
                    "orderable": false,
                    "type": "string"
                }      
            
            ],
              buttons: [
                    {extend: 'copy',  className: 'btn-sm' },
                    {extend: 'csv',   className: 'btn-sm' },
                    {extend: 'excel', className: 'btn-sm', title: 'XLS-File'},
                    {extend: 'pdf',   className: 'btn-sm', title: $('title').text() },
                    {extend: 'print', className: 'btn-sm' }
              ]
       
        });

    })
  </script>
@endsection
