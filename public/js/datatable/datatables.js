
// datatable of list timesheet, in page user/readByAjax
$('#datatable-editable').DataTable({
    'paging':   true,  // Table pagination
    'ordering': true,  // Column ordering
    'info':     false,  // Bottom left status text
    'responsive': true, // https://datatables.net/extensions/responsive/examples/
    'bLengthChange': false, // hide records per page
    'searching': true, // hide Search
      
      // Text translation options
      // Note the required keywords between underscores (e.g MENU)

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
    
        { "width": "auto" },
        // dinh nghia cho delete edit
        {   "targets": [6],
            "orderable": false,
            "type": "string"
        }, 
        {   "targets": [7],
            "orderable": false,
            "type": "string"
        }
    ]
});

// admin/user/list
$('#users_list').DataTable({
    'destroy': true,
    'paging':   true,  // Table pagination
    'ordering': true,  // Column ordering
    'info':     false,  // Bottom left status text
    'responsive': true, // https://datatables.net/extensions/responsive/examples/
    'bLengthChange': false, // hide records per page
    'searching': true, // hide Search
    // 'rowsGroup': [0], // gop row of column 
  
    // Text translation options
    // Note the required keywords between underscores (e.g MENU)

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
        { "targets": [9],
        "orderable": false,
        "type": "string"
        }     
    ]
});

// admin/task/list
$('#tasks_list').dataTable({
    'destroy': true,
    'paging':   true,  // Table pagination
    'ordering': true,  // Column ordering
    'info':     false,  // Bottom left status text
    'responsive': true, // https://datatables.net/extensions/responsive/examples/
    'bLengthChange': false, // hide records per page
    // 'searching': false, // hide Search
    'rowsGroup': [0], // gop row of column 
      
    // Text translation options
    // Note the required keywords between underscores (e.g MENU)

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
        { "targets": [4],
         "orderable": false,
         "type": "string"
        }     

    ]

});

// admin/project/list
$('#project_list').dataTable({
    'destroy': true,
    'paging':   true,  // Table pagination
    'ordering': true,  // Column ordering
    'info':     false,  // Bottom left status text
    'responsive': true, // https://datatables.net/extensions/responsive/examples/
    'bLengthChange': false, // hide records per page

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
        }    
    
    ]

});

// admin/customer/list
$('#customer_list').dataTable({
    'destroy': true,
    'paging':   true,  // Table pagination
    'ordering': true,  // Column ordering
    'info':     false,  // Bottom left status text
    'responsive': true, // https://datatables.net/extensions/responsive/examples/
    'bLengthChange': false, // hide records per page
     

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
        { "targets": [7],
         "orderable": false,
         "type": "string"
        }      
    ]
});


// admin/report/customer_report
$('#report_info').DataTable({
    'destroy': true,
    'paging':   true,  // Table pagination
    'ordering': true,  // Column ordering
    'info':     false,  // Bottom left status text
    'responsive': true, // https://datatables.net/extensions/responsive/examples/
    'bLengthChange': false, // hide records per page
    'searching': true, // hide Search
    'rowsGroup': [0,1,4], // gop row of column 
    // 'rowsGroup': [1], // gop row of column 
  
    // Text translation options
    // Note the required keywords between underscores (e.g MENU)

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
        { "targets": [4],
        "orderable": false,
        "type": "string"
        }     
    ]
});

// admin/report/user_report
$('#report_user').DataTable({
    'destroy': true,
    'paging':   true,  // Table pagination
    'ordering': true,  // Column ordering
    'info':     false,  // Bottom left status text
    'responsive': true, // https://datatables.net/extensions/responsive/examples/
    'bLengthChange': false, // hide records per page
    'searching': true, // hide Search
    'rowsGroup': [0,1,4], // gop row of column 
    // 'rowsGroup': [1], // gop row of column 
  
    // Text translation options
    // Note the required keywords between underscores (e.g MENU)

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
        { "targets": [4],
        "orderable": false,
        "type": "string"
        }     
    ]
});


// admin/employee_type/list
$('#employee_type').dataTable({
    'destroy': true,
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
        { "targets": [2],
         "orderable": false,
         "type": "string"
        }   
    ]

});



