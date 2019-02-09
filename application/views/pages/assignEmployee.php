<style>
    input{
        width: 100%;
    }
</style>
<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left w3-col l12">
            <h3>Assign Employee To Project</h3>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <!-- upload document div -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-file"></i> Assign Employee To Project</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div id="response_msg"></div>
                <div class="container x_content">
                    <?php
                    //print_r($employees);
                    ?>
                    <form id="assignEmployeeForm" name="assignEmployeeForm" method="post">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                           
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Projects: <font color ="red"><span id ="pname_star">*</span></font></label>
                                <select class="w3-input w3-text-grey" name="projects" id="projects" required>
                                    <option value="0" class="w3-light-grey" selected>Select Project*</option>
                                    <?php foreach ($projects['status_message'] as $key) { ?>
                                        <option value="<?php echo $key['project_id']; ?>"><?php echo $key['project_name']; ?></option>
                                    <?php } ?>                      
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 w3-margin-bottom">
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Employees: <font color ="red"><span id ="pname_star">*</span></font></label>
                                <select class="w3-input w3-text-grey" name="employees[]" id="employees" required>
                                    <option value="0" class="w3-light-grey" selected>Select Employee*</option>
                                    <?php foreach ($employees['status_message'] as $key) { ?>
                                        <option value="<?php echo $key['user_id']; ?>"><?php echo $key['user_name']; ?></option>
                                    <?php } ?>                      
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Project Participation <span class="w3-tiny">(In %)</span>: </label>
                                <input type="number" name="project_participation[]" id="project_participation" autocomplete="off" step="0.01" min="0" value="" class="w3-input w3-small" placeholder="Enter Employee Participation in %" required>
                            </div> 
                        </div>
                        <div class="" id="addedmore_imageDiv"></div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 w3-margin-bottom">
                            <a id="add_moreimage" title="Add More Employee" class="btn w3-text-red add_moreProduct w3-small w3-right w3-margin-top"><b>Add Employee <i class="fa fa-plus"></i></b>
                            </a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 w3-center w3-margin-top" style=" width: 100%;">
                            <button type="submit" id="assignEmp" class="btn theme_bg w3-hover-text-white">Submit</button>                      
                            <button type="reset" id="clear" class="btn btn-success">Clear</button>                      
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- upload document div ends -->
    </div>
</div>
<script>
    $(document).ready(function () {
        var max_fields = 10;
        var wrapper = $("#addedmore_imageDiv");
        var add_button = $("#add_moreimage");
        var x = 1;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<div>\n\
                <div class="col-md-12">\n\
                <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">\n\
                <label>Employees: <font color ="red"><span id ="pname_star">*</span></font></label>\n\
                <select class="w3-input w3-text-grey" name="employees[]" id="employees" required>\n\
                <option value="0" class="w3-light-grey" selected>Select Employee*</option>\n\
<?php foreach ($employees['status_message'] as $key) { ?><option value="<?php echo $key['user_id']; ?>">\n\
    <?php echo $key['user_name']; ?></option>\n\
<?php } ?></select>\n\
                </div>\n\<div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">\n\
                <label>Project Participation <span class="w3-tiny">(In %)</span>: </label>\n\
                <input type="number" name="project_participation[]" id="project_participation" autocomplete="off" step="0.01" min="0" value="" class="w3-input w3-small" placeholder="Enter Employee Participation In %" required>\n\
                </div>\n\
                <a href="#" class="delete btn w3-text-black w3-right w3-small" title="remove image">remove <i class="fa fa-remove"></i>\n\
                </a>\n\
                </div>\n\
                </div>'); //add input box
            } else {
                $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xxlarge"></i> You Reached the maximum limit of adding ' + max_fields + ' fields</label>');   //alert when added more than 4 input fields
            }
        });
        $(wrapper).on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    });

    function showEmployeeDetailsDiv() {
        $("#employeeDetails").css("display", "block");
        var emp_user_id = $('#employees').val();
        var project_id = $('#projects').val();
        $.ajax({
            type: "POST",
            url: BASE_URL + "assignemployee/getEmployeeDetails",
            data: {
                emp_user_id: emp_user_id,
                project_id: project_id
            },
            return: false,
            success: function (response) {
                // alert(response);
                console.log(response);

                $('#salary').val();

            }
        });
    }

    // fun for create project
    $("#assignEmployeeForm").on('submit', function (e) {
        e.preventDefault();
        dataString = $("#assignEmployeeForm").serialize();
        $.ajax({
            url: BASE_URL + "assignemployee/assignEmployeeToProject", // point to server-side PHP script
            data: new FormData(this),
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                $('#assignEmp').prop('disabled', true);
                $('#assignEmp').html('<i class="fa fa-circle-o-notch fa-spin"></i> Assign Employee');
            },
            success: function (response) {
                $('#assignEmp').prop('disabled', false);
                $('#assignEmp').html('<i class="fa fa-user"></i> Assign Employee');
                console.log(response);
                var data = JSON.parse(response);
                console.log(data.status);

                // response message
                switch (data.status) {
                    case 'success':
                        $('#response_msg').html(data.message);
                        setTimeout(function () {
                            $('#assignEmployeeForm').trigger("reset");
                            $('.alert').fadeOut('fast');
                            //window.location.reload();
                        }, 5000); // <-- time in milliseconds 
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
                $('#assignEmp').prop('disabled', false);
                $('#response_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
                $('#assignEmp').html('<i class="fa fa-user"></i> Assign Employee');
                window.setTimeout(function () {
                    $(".alert").fadeTo(500, 0).slideUp(500, function () {
                        $(this).remove();
                    });
                }, 5000);
            }
        });
        return false;  //stop the actual form post !important!
    });


    function savecomment(query_id) {
        //alert(query_id);
        if (query_id == '') {
            $('.comment_msg').html('<p class="w3-red w3-padding-small w3-small">Warning! Invalid query! Reload the page to resolve the issue.</p>');
            return false;
        }
        var comment_posted = $('#comment_posted_' + query_id).val();
        if (comment_posted == '') {
            $('.comment_msg').html('<p class="w3-red w3-padding-small w3-small">Warning! Please Add Comment first..</p>');
            return false;
        }
        $.ajax({
            type: "POST",
            url: BASE_URL + "modules/raisequery_rfi/addComment",
            data: {
                query_id: query_id,
                comment_posted: comment_posted
            },
            return: false,
            beforeSend: function () {
                $('.comment_msg').html('');
                // $('#commentBtn').prop('disabled', true);
            },
            success: function (response) {
                //alert(response);
                $('#comment_posted_' + query_id).val('');
                var data = JSON.parse(response);
                $('#commentBtn').prop('disabled', false);
                // response message
                switch (data.status) {
                    case 'success':
                        $('.comment_msg').html(data.message);
                        getComments(query_id);
                        // $('#comment_list').load(location.href + " #comment_list>*", "");
                        break;
                    case 'error':
                        $('.comment_msg').html(data.message);
                        break;
                    case 'validation':
                        $('.comment_msg').html(data.message);
                        break;
                    default:
                        $('.comment_msg').html('<p class="w3-red w3-padding-small w3-small"><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></p>');
                        break;
                }
            },
            error: function (response) {
                // Re_Enabling the Elements
                $('#commentBtn').prop('disabled', false);
                $('.comment_msg').html('<p class="w3-red w3-padding-small w3-small"><strong><b>Error:</b> Something went wrong! Try refreshing page and Save again.</strong></p>');
                setTimeout(function () {
                    $('.comment_msg').fadeOut('fast');
                }, 4000); // <-- time in milliseconds  
            }
        });
    }

</script>
