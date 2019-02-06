<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left w3-col l12">
            <h3>Create Project </h3>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <!-- upload document div -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-file"></i> Projects</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div id="response_msg"></div>

                <div class="container x_content">
                    <form id="createProject_form" name="createProject_form" method="post">
                        <div class="w3-col l12">
                            <div class="w3-col l12">
                                <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                    <label>Project Name: <font color ="red"><span id ="pname_star">*</span></font></label>
                                    <input type="text" class="w3-input" name="project_title" id="project_title" placeholder="Enter Project title" required>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                    <label>Project Profit Margin: <font color ="red"><span id ="pname_star">*</span></font></label>
                                    <input type="number" step="0.01" class="w3-input" name="project_profit_margin" id="project_profit_margin" placeholder="Enter Project Profit Margin" required>
                                </div>

                            </div>
                        </div>
                        <div class="w3-col l12">
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Project Start Date : <font color ="red"><span id ="pname_star">*</span></font></label>
                                <input type="date" maxlength="10" min="0" class="w3-input" id="start_date" name="start_date" required >
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Project End Date : <font color ="red"><span id ="pname_star">*</span></font></label>
                                <input type="date" maxlength="10" min="0" class="w3-input" id="end_date" name="end_date" required >
                            </div>

                        </div>
                        <div class="w3-col l12">
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Project Cost: <font color ="red"><span id ="pname_star">*</span></font></label>
                                <input type="number" step="0.01" class="w3-input" name="project_cost" id="project_cost" placeholder="Enter Project Cost" required>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                <label>Project Description: <font color ="red"><span id ="pname_star">*</span></font></label>
                                <textarea class="w3-input" name="project_description" id="project_description" rows="5" placeholder="Enter Project Description" style=" resize: none;" required></textarea>
                            </div>

                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 w3-center w3-margin-top w3-margin-bottom">
                            <button type="submit" id="uploadDocBtn" class="btn theme_bg w3-hover-text-white btn-large"><i class="fa fa-briefcase"></i> Create Project</button>
                            <button type="reset" id="clear" class="btn btn-success">Clear</button>                      
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- upload document div ends -->

        <!-- view all document div -->
        <!--            <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2><i class="fa fa-list"></i> All Projects</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
        <?php //print_r($allDocuments); ?>
                            <div class="container x_content">
                                <div id="table_msg"></div>
                                <div class="w3-col l12 w3-padding w3-small" id="allDocumentDiv">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr >
                                                <th class="text-center">Project Title</th>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">Revision No</th>
                                                <th class="text-center">Total Files</th>
                                                <th class="text-center">Uploaded by</th>
                                                <th class="text-center">Uploaded date</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
        
                        </div>
                    </div>-->
        <!-- view all document div ends -->
    </div>
</div>
<script>
    // fun for create project
    $("#createProject_form").on('submit', function (e) {
        e.preventDefault();
        dataString = $("#createProject_form").serialize();
        $.ajax({
            url: BASE_URL + "createproject/create_project", // point to server-side PHP script
            data: new FormData(this),
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            beforeSend: function () {
                $('#updateDocBtn').prop('disabled', true);
                $('#updateDocBtn').html('<i class="fa fa-circle-o-notch fa-spin"></i> Creating Project');
            },
            success: function (response) {
                $('#updateDocBtn').prop('disabled', false);
                $('#updateDocBtn').html('<i class="fa fa-briefcase"></i> Create Project');
                //console.log(response);
                var data = JSON.parse(response);

                //alert(data);
                // response message
                switch (data.status) {
                    case 'success':
                        $('#response_msg').html(data.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1500); // <-- time in milliseconds 

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
                $('#updateDocBtn').prop('disabled', false);
                $('#response_msg').html('<div class="alert alert-warning alert-dismissible fade in alert-fixed w3-round"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Failure!</strong> Something went wrong. Please refresh the page and try once again.</div>');
                $('#updateDocBtn').html('<i class="fa fa-briefcase"></i> Create Project');
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
    $(function () {
        $("#registeruser").submit(function (e) {
            e.preventDefault();
            dataString = $("#registeruser").serialize();
            // alert(dataString);
            $('#uploadDocBtn').html('<span class="w3-card w3-padding-small w3-margin-bottom w3-round"><i class="fa fa-spinner fa-spin w3-large"></i> <b>Submitting...!</b></span>');
            $.ajax({
                type: "POST",
                url: BASE_URL + "registration/register_user",
                data: dataString,
                return: false, //stop the actual form post !important!
                success: function (data)
                {
                    //alert(data);
                    $('#uploadDocBtn').html(data);
                    $('#register').html('<span>Submit</span>');
                }
            });
            return false;  //stop the actual form post !important!
        });
    });
</script>
<!-- /page content-->