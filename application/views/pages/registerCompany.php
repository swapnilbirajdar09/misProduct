<title>Register Company</title>
<div class="right_col" role="main" id="">
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div id="message" class="w3-padding"></div>
                    <div class="x_title">
                        <h2><i class="fa fa-user-cirlce"></i> Create Company</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="registeruser" name="registeruser">
                                    <div class="w3-col l12">
                                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                            <label>Roles: <font color ="red"><span id ="pname_star">*</span></font></label>
                                            <select class="w3-input w3-text-grey" name="role" id="role" required>
                                                <option value="0" class="w3-light-grey" selected>Select Role*</option>
                                                <?php
                                                foreach ($roles['status_message'] as $key) {
                                                    if ($key['role_id'] > 1 && $key['role_id'] < 3) {
                                                        ?>
                                                        <option value="<?php echo $key['role_id'] . '/' . $key['role_name']; ?>"><?php echo $key['role_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>                      
                                            </select>
                                        </div>
                                    </div>
                                    <?php //print_r($package);die();    ?>

                                    <div class="w3-col l12">
                                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                            <label>Email-Id: <font color ="red"><span id ="pname_star">*</span></font></label>
                                            <input type="email" name="eMail" id="eMail" autocomplete="off" value="" class="w3-input w3-small" placeholder="Enter email here" required>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                            <label>Package: <font color ="red"><span id ="pname_star">*</span></font></label>
                                            <select class="w3-input w3-text-grey" name="package" id="package" required>
                                                <option value="0" class="w3-light-grey" selected>Select your Package*</option>
                                                <?php
                                                foreach ($package['status_message'] as $key) {
                                                    ?>
                                                    <option value="<?php echo $key['package_title'] . '|' . $key['package_period'] . '|' . $key['package_validity']; ?>"><?php echo $key['package_title']; ?></option>
                                                <?php } ?>                      
                                            </select>
                                        </div>
                                    </div>

                                    <div class="w3-col l12">
                                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                            <label>Username: <font color ="red"><span id ="pname_star">*</span></font></label>
                                            <input type="text" name="username" autocomplete="off" value="" id="username" class="w3-input w3-small" placeholder="Enter password here" required>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                            <label>Password: <font color ="red"><span id ="pname_star">*</span></font></label>
                                            <input type="text" name="password" autocomplete="off" value="" id="password" class="w3-input w3-small" placeholder="Enter password here" required>
                                        </div>
                                    </div>

                                    <div class="w3-col l12">
                                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                            <label>Company Name: <font color ="red"><span id ="pname_star">*</span></font></label>
                                            <input type="text" name="company_name" autocomplete="off" value="" id="company_name" class="w3-input w3-small" placeholder="Enter password here" required>
                                        </div>                                        
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12 w3-center w3-margin-top">
                                        <!-- <button type="reset" class="btn btn-default">Reset</button> -->
                                        <button type="submit" id="register" class="btn theme_bg w3-hover-text-white">Submit</button>                      
                                        <button type="reset" id="clear" class="btn btn-success">Clear</button>                      
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->
<!-- function for submit hospital form details -->
<script>
    $(function () {
        $("#registeruser").submit(function (e) {
            e.preventDefault();
            dataString = $("#registeruser").serialize();
            // alert(dataString);
            $('#register').html('<span class="w3-card w3-padding-small w3-margin-bottom w3-round"><i class="fa fa-spinner fa-spin w3-large"></i> <b>Submitting...!</b></span>');
            $.ajax({
                type: "POST",
                url: BASE_URL + "register_company/register_company",
                data: dataString,
                return: false, //stop the actual form post !important!
                success: function (data)
                {
                    alert(data);
                    $('#message').html(data);
                    $('#register').html('<span>Submit</span>');
                }
            });
            return false;  //stop the actual form post !important!
        });
    });


</script>