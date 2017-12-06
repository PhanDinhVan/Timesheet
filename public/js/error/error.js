$(document).ready(function() {

    // add customer
    $("#add_customer").validate({
        rules: {
            name: {
            		required: true,
            		minlength: 2
            	},
            email: {
                    required: true,
                    email: true
                },
            city: {
            		required: true,
            		minlength: 2
            	},
            country:{
            		required: true,
            		minlength: 2
            	}
        },
        messages: {
	            name: {
	            		required: "Please enter customer name",
	            		minlength: "Customer name minimum 2 characters"
	            	},
	            email: {
	                    required: "Please enter email",
	                    email: "Please enter a valid email address.",
	                },
	            city: {
	                    required: "Please enter city",
	                    minlength: "City minimum 2 characters.",
	                },
	            country: {
	                    required: "Please enter country",
	                    minlength: "Country minimum 2 characters.",
	                },
            
        }, highlight: function(element) {
            $(element).addClass('error');
        }, unhighlight: function(element) {
            $(element).removeClass('error');
        }
    });


    // edit customer
    $("#edit_customer").validate({
        rules: {
            name: {
            		required: true,
            		minlength: 2
            	},
            city: {
            		required: true,
            		minlength: 2
            	},
            country:{
            		required: true,
            		minlength: 2
            	}
        },
        messages: {
	            name: {
	            		required: "Please enter customer name",
	            		minlength: "Customer name minimum 2 characters"
	            	},
	            city: {
	                    required: "Please enter city",
	                    minlength: "City minimum 2 characters.",
	                },
	            country: {
	                    required: "Please enter country",
	                    minlength: "Country minimum 2 characters.",
	                },
            
        }, highlight: function(element) {
            $(element).addClass('error');
        }, unhighlight: function(element) {
            $(element).removeClass('error');
        }
    });


    // add employee_type
    $("#add_employee_type").validate({
        rules: {
            emp_type: {
            		required: true,
            		minlength: 2
            	},
        },
        messages: {
	            emp_type: {
	            		required: "Please enter employee type",
	            		minlength: "Employee types minimum 2 characters"
	            	},
            
        }, highlight: function(element) {
            $(element).addClass('error');
        }, unhighlight: function(element) {
            $(element).removeClass('error');
        }
    });


    // edit employee_type
    $("#edit_employee_type").validate({
        rules: {
            emp_type: {
            		required: true,
            		minlength: 2
            	},
        },
        messages: {
	            emp_type: {
	            		required: "Please enter employee type",
	            		minlength: "Employee types minimum 2 characters"
	            	},
            
        }, highlight: function(element) {
            $(element).addClass('error');
        }, unhighlight: function(element) {
            $(element).removeClass('error');
        }
    });


    // add permisson
    $("#add_permisson").validate({
        rules: {
            username: "required",
            projectname: "required",
        },
        messages: {
	            username: "Please select username",
	            projectname: "Please select project name"
            
        }, highlight: function(element) {
            $(element).addClass('error');
        }, unhighlight: function(element) {
            $(element).removeClass('error');
        }
    });


    // add project
    $("#add_project").validate({
        rules: {
            name: {
                    required: true,
                    minlength: 2
                },
            department: {
                    required: true,
                },
            start_date: {
                    required: true,
                },
            end_date:{
                    required: true,
                },
            customer_id:{
                    required: true,
                }
        },
        messages: {
                name: {
                        required: "Please enter project name",
                        minlength: "Project name minimum 2 characters"
                    },
                department: {
                        required: "Please select department",
                    },
                start_date: {
                        required: "Please select start date",
                    },
                end_date: {
                        required: "Please select end date",
                    },
                customer_id: {
                        required: "Please select customer name",
                    },
            
        }, highlight: function(element) {
            $(element).addClass('error');
        }, unhighlight: function(element) {
            $(element).removeClass('error');
        }
    });


    // edit project
    $("#edit_project").validate({
        rules: {
            name: {
                    required: true,
                    minlength: 2
                },
            department: {
                    required: true,
                },
            start_date: {
                    required: true,
                },
            end_date:{
                    required: true,
                },
            customer_id:{
                    required: true,
                }
        },
        messages: {
                name: {
                        required: "Please enter project name",
                        minlength: "Project name minimum 2 characters"
                    },
                department: {
                        required: "Please select department",
                    },
                start_date: {
                        required: "Please select start date",
                    },
                end_date: {
                        required: "Please select end date",
                    },
                customer_id: {
                        required: "Please select customer name",
                    },
            
        }, highlight: function(element) {
            $(element).addClass('error');
        }, unhighlight: function(element) {
            $(element).removeClass('error');
        }
    });


    // add task
    $("#add_task").validate({
        rules: {
            taskname: {
                    required: true,
                    minlength: 2
                },
            project_id: {
                    required: true,
                }
        },
        messages: {
                taskname: {
                        required: "Please enter task name",
                        minlength: "Project name minimum 2 characters"
                    },
                project_id: {
                        required: "Please select project name"
                    }
            
        }, highlight: function(element) {
            $(element).addClass('error');
        }, unhighlight: function(element) {
            $(element).removeClass('error');
        }
    });


    // edit task
    $("#edit_task").validate({
        rules: {
            taskname: {
                    required: true,
                    minlength: 2
                }
        },
        messages: {
                taskname: {
                        required: "Please enter task name",
                        minlength: "Project name minimum 2 characters"
                    }
            
        }, highlight: function(element) {
            $(element).addClass('error');
        }, unhighlight: function(element) {
            $(element).removeClass('error');
        }
    });


    // add user
    $("#add_user").validate({
        rules: {
            firstname: {
                    required: true,
                    minlength: 2
                },
            lastname: {
                    required: true,
                    minlength: 2
                },
            email: {
                    required: true,
                    email: true
                },
            start_date: {
                    required: true,
                },
            end_date:{
                    required: true,
                },
            employee_type_id:{
                    required: true,
                },
            password:{
                    required: true,
                    minlength: 3
                },
            passwordAgain:{
                    required: true,
                    equalTo: "#password"
                }
        },
        messages: {
                firstname: {
                        required: "Please enter firstname",
                        minlength: "Firstname minimum 2 characters"
                    },
                lastname: {
                        required: "Please enter lastname",
                        minlength: "Lastname minimum 2 characters"
                    },
                email: {
                        required: "Please enter email",
                        email: "Please enter a valid email address"
                    },
                start_date: {
                        required: "Please select start date",
                    },
                end_date: {
                        required: "Please select end date",
                    },
                employee_type_id: {
                        required: "Please select employee type"
                    },
                password:{
                        required: "Please enter password",
                        minlength: "Password must be at least 3 characters"
                    },
                passwordAgain:{
                        required: "Please confirm password",
                        equalTo: "The password confirmation does not match"
                    }
            
        }, highlight: function(element) {
            $(element).addClass('error');
        }, unhighlight: function(element) {
            $(element).removeClass('error');
        }
    });


     // edit user
    $("#edit_user").validate({
        rules: {
            firstname: {
                    required: true,
                    minlength: 2
                },
            lastname: {
                    required: true,
                    minlength: 2
                },
            email: {
                    required: true,
                    email: true
                },
            start_date: {
                    required: true,
                },
            end_date:{
                    required: true,
                },
            employee_type_id:{
                    required: true,
                },
            password:{
                    required: true,
                    minlength: 3
                },
            passwordAgain:{
                    required: true,
                    equalTo: "#password"
                }
        },
        messages: {
                firstname: {
                        required: "Please enter firstname",
                        minlength: "Firstname minimum 2 characters"
                    },
                lastname: {
                        required: "Please enter lastname",
                        minlength: "Lastname minimum 2 characters"
                    },
                email: {
                        required: "Please enter email",
                        email: "Please enter a valid email address"
                    },
                start_date: {
                        required: "Please select start date",
                    },
                end_date: {
                        required: "Please select end date",
                    },
                employee_type_id: {
                        required: "Please select employee type"
                    },
                password:{
                        required: "Please enter password",
                        minlength: "Password must be at least 3 characters"
                    },
                passwordAgain:{
                        required: "Please confirm password",
                        equalTo: "The password confirmation does not match"
                    }
            
        }, highlight: function(element) {
            $(element).addClass('error');
        }, unhighlight: function(element) {
            $(element).removeClass('error');
        }
    });


       // setting of user not admin
    $("#user_setting").validate({
        rules: {
            firstname: {
                    required: true,
                    minlength: 2
                },
            lastname: {
                    required: true,
                    minlength: 2
                },
            password:{
                    required: true,
                    minlength: 3
                },
            passwordAgain:{
                    required: true,
                    equalTo: "#password"
                }
        },
        messages: {
                firstname: {
                        required: "Please enter firstname",
                        minlength: "Firstname minimum 2 characters"
                    },
                lastname: {
                        required: "Please enter lastname",
                        minlength: "Lastname minimum 2 characters"
                    },
                password:{
                        required: "Please enter password",
                        minlength: "Password must be at least 3 characters"
                    },
                passwordAgain:{
                        required: "Please confirm password",
                        equalTo: "The password confirmation does not match"
                    }
            
        }, highlight: function(element) {
            $(element).addClass('error');
        }, unhighlight: function(element) {
            $(element).removeClass('error');
        }
    });


});





