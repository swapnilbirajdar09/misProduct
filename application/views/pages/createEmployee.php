<?php
$role = $this->session->userdata('role');
$Arr = explode('/', $role);
$role_id = $Arr[0];
$role_name = $Arr[1];
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/build/css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="<?php ?>assets/js/bootstrap-multiselect.js"></script>
<style>
    input{
        width: 100%;
    }
</style>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left w3-col l12">
            <h3>Create Employee </h3>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <!-- upload document div -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-file"></i> Employee</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div id="response_msg"></div>

                <div class="container x_content">
                    <form id="createEmployee_form" name="createEmployee_form" method="post">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" width: 100%;">
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Roles: <font color ="red"><span id ="pname_star">*</span></font></label>
                                <select class="w3-input w3-text-grey" name="role" id="role" required>
                                    <option value="0" class="w3-light-grey" selected>Select Role*</option>
                                    <?php
                                    foreach ($roles['status_message'] as $key) {
                                        if ($key['role_id'] > 2) {
                                            ?>
                                            <option value="<?php echo $key['role_id'] . '/' . $key['role_name']; ?>"><?php echo $key['role_name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>                      
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" width: 100%;">
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Email-Id: </label>
                                <input type="email" name="eMail" id="eMail" autocomplete="off" value="" class="w3-input w3-small" placeholder="Enter email here" required >
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Add Employee Skills: <font color ="red"><span id ="pname_star">*</span></font></label><br>
                                <select id="demo" name="skills[]" class=" form-control" multiple="multiple">
                                    <?php foreach ($skills['status_message'] as $key) { ?>
                                        <option value="<?php echo $key['skill_id']; ?>"><?php echo $key['skill_name']; ?></option> 
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" width: 100%;">
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Username: </label>
                                <input type="text" name="username" autocomplete="off" value="" id="username" class="w3-input w3-small" placeholder="Enter password here" required>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Password: </label>
                                <input type="text" name="password" autocomplete="off" value="" id="password" class="w3-input w3-small" placeholder="Enter password here" required>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 w3-margin-bottom" style=" width: 100%;">
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Company Name: </label>
                                <input type="text" name="company_name" readonly id="company_name" autocomplete="off" value="<?php echo $company_name; ?>" class="w3-input w3-small" placeholder="Enter Number here" required>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Salary: </label>
                                <input type="number" name="salary" id="salary" autocomplete="off" step="0.01" min="0" value="" class="w3-input w3-small" placeholder="Enter Number here" required>
                            </div>                            
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 w3-center w3-margin-top" style=" width: 100%;">
                            <button type="submit" id="register" class="btn theme_bg w3-hover-text-white">Submit</button>                      
                            <button type="reset" id="clear" class="btn btn-success">Clear</button>                      
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- upload document div ends -->

    </div>


    <!-- view all document div -->
    <div class="row" ng-app="employeeApp" ng-controller="employeeController">
        <div ng-bind-html="message"></div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-users"></i> All Employee</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <?php //print_r($allDocuments);  ?>
                <div class="container x_content">

                    <div class=" col-md-12 col-sm-12 col-xs-12 w3-margin-top ">   
                        {{profiles}}
                        <div ng-if="profiles != 500" class="col-md-4 col-sm-4 col-xs-12 w3-padding-tiny" ng-repeat="p in profiles">
                            <!--                                    <div class="w3-col l12 ">-->
                            <div class="col-md-12 col-sm-12 col-xs-12 w3-round w3-white w3-card-2" style="">
                                <a class="btn pull-left w3-text-red" title="Delete User" ng-click="deleteUser(p.user_id);"><i class="fa fa-close"></i></a>
                                <h4 class="brief w3-small pull-right"><i>{{p.role}}</i></h4>
                                <div class="left col-xs-12">
                                    <h2>{{p.company_name}}</h2>
                                    <ul class="list-unstyled">
                                        <li><i class="fa fa-user"></i> {{p.username}} </li>
                                        <li><i class="fa fa-at"></i> {{p.email}} </li>
                                        <li><i class="fa fa-phone"></i> {{p.phone_no}} </li>
                                        <li><i class="fa fa-inr"></i> {{p.salary}} </li>
                                    </ul>
                                </div>                                
                            </div>                           
                            <!--                                    </div>-->
                        </div>

                        <div ng-if="profiles == 500" class="col-md-12 col-sm-12 col-xs-12 w3-center">
                            <span class="w3-center"><h3> No Users Are Available</h3></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--         view all employee div ends -->
</div>
<script>
    $(document).ready(function () {
        $('#demo').multiselect();
    });
    // fun for create employee
    $("#createEmployee_form").on('submit', function (e) {
        e.preventDefault();
        dataString = $("#createEmployee_form").serialize();
        $.ajax({
            url: BASE_URL + "employee/create_employee", // point to server-side PHP script
            data: new FormData(this),
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                $('#register').prop('disabled', true);
                $('#register').html('<i class="fa fa-circle-o-notch fa-spin"></i> Saving Details');
            },
            success: function (response) {
                console.log(response);
                $('#register').prop('disabled', false);
                $('#register').html('<i class="fa fa-user"></i> Create Employee');
                //console.log(response);
                var data = JSON.parse(response);
                // response message
                switch (data.status) {
                    case 'success':
                        $('#response_msg').html(data.message);
                        setTimeout(function () {
                            $('#createEmployee_form').trigger("reset");
                            $('.alert').fadeOut('fast');
                            window.location.reload();
                        }, 8000); // <-- time in milliseconds 
                        break;

                    case 'error':
                        $('#response_msg').html(data.message);
                        setTimeout(function () {
                            $('.alert').fadeOut('fast');
                        }, 10000); // <-- time in milliseconds
                        break;

                    case 'validation':
                        $('#response_msg').html(data.message);
                        setTimeout(function () {
                            $('.alert').fadeOut('fast');
                        }, 8000); // <-- time in milliseconds
                        break;

                    default:
                        $('#response_msg').html('<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Fatal Error-</strong> Something went wrong. Please Logout your account and Try Logging in again.</div>');
                        setTimeout(function () {
                            $('.alert').fadeOut('fast');
                        }, 8000); // <-- time in milliseconds
                        break;
                }
            },
            error: function (data) {
                $('#register').prop('disabled', false);
                $('#response_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
                $('#register').html('<i class="fa fa-user"></i> Create Employee');
                window.setTimeout(function () {
                    $(".alert").fadeTo(500, 0).slideUp(500, function () {
                        $(this).remove();
                    });
                }, 5000);
            }
        });
        return false;  //stop the actual form post !important!
    });
</script>
<script>
    var app = angular.module("employeeApp", ['ngSanitize']);
    app.controller("employeeController", function ($scope, $http, $window) {
//------------------------------------------------------------------------------------------------------//
        $scope.message = '';
        $scope.profiles = [];
        $http.get(BASE_URL + "employee/getAllEmployee").then(function (response) {
            console.log(response);
            var data = response.data['status_message'];
            //console.log(JSON.parse(data));
            //alert(data);
            console.log(data);
            $scope.profiles = [];
            var i, j, user_photos, phone, education, alreadyfollowed, followers, firstname, user_location, alreadySent, receivedReq, birthday, today, user_fullname, user_designation, user_mother_tongue, user_marital_status, age, newAge, totage;
            if (data['status'] == 200) {
                //alert(data['status_message'].length);
                for (i = 0; i < data.length; i++) {
                    //alert(data['skill'][i]);
                    if (data[i].phone == '') {
                        phone = 'N/A';
                    } else {
                        phone = data[i].phone;
                    }

                    $scope.profiles.push({'company_name': data[i].name,
                        'user_id': data[i].user_id,
                        'role': data[i].role_name,
                        'username': data[i].user_name,
                        'email': data[i].user_email,
                        'phone_no': phone,
                        'salary': data[i].salary
                    });
                    console.log($scope.profiles);
                }
            } else {
                $scope.profiles = 500;
            }

        });

        $scope.reload = function () {
            $http.get(BASE_URL + "employee/getAllEmployee").then(function (response) {
                var data = response.data;
                $scope.profiles = [];
                var i, j, user_photos, phone, education, alreadyfollowed, followers, firstname, user_location, alreadySent, receivedReq, birthday, today, user_fullname, user_designation, user_mother_tongue, user_marital_status, age, newAge, totage;
                if (data['status'] == 200) {
                    //alert(data['status_message'].length);
                    for (i = 0; i < data['status_message'].length; i++) {
                        if (data['status_message'][i].phone == '') {
                            phone = 'N/A';
                        } else {
                            phone = data['status_message'][i].phone;
                        }

                        $scope.profiles.push({'company_name': data['status_message'][i].name,
                            'user_id': data['status_message'][i].user_id,
                            'role': data['status_message'][i].role_name,
                            'username': data['status_message'][i].user_name,
                            'email': data['status_message'][i].user_email,
                            'phone_no': phone,
                            'salary': data['status_message'][i].salary
                        });
                        //console.log($scope.profiles);
                    }
                } else {
                    $scope.profiles = 500;
                }
            });
        };


        $scope.deleteUser = function (user_id) {
            $.confirm({
                title: '<h4 class="w3-text-red">Please confirm the action!</h4><span class="w3-medium">Do you really want to Delete This User?</span>',
                content: '',
                type: 'red',
                buttons: {
                    confirm: function () {
                        $http({
                            method: 'get',
                            url: BASE_URL + "employee/deleteUser?user_id=" + user_id
                        }).then(function successCallback(data) {
                            alert(data);
                            console.log(data.status);
                            switch (data.status) {
                                case 200:
                                    //alert('check1');
                                    $scope.message = '<div class="alert alert-success alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Employee Removed successfully.</div>';
                                    setTimeout(function () {
                                        $('.alert_message').fadeOut('fast');
                                        window.location.reload();
                                    }, 8000); // <-- time in milliseconds                                    break;
                                case 500:
                                    //alert('check2');
                                    $scope.message = '<div class="alert alert-danger alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Employee Not Removed Successfully.</div>';
                                    setTimeout(function () {
                                        $('.alert_message').fadeOut('fast');
                                    }, 8000);
                                    break;
                                default:
                                    $('#message').html('<div class="alert alert-danger alert-dismissible" style="margin-bottom:5px"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.!</strong></div>');
                                    setTimeout(function () {
                                        $('.alert_message').fadeOut('fast');
                                    }, 8000); // <-- time in milliseconds
                                    break;
                            }
                            $scope.reload();
                        });
                    },
                    cancel: function () {
                    }
                }
            });
        };
    });
</script>
<script src="<?php echo base_url(); ?>assets/js/module/user/createUser.js"></script>
<!-- /page content-->