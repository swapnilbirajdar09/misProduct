<title>Register User</title>
<div class="right_col" role="main" id="">
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div id="message" class="w3-padding"></div>

                    <div class="x_title">
                        <h2><i class="fa fa-user-cirlce"></i> Register User</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="registeruser" name="registeruser">
                                    <div class="w3-col l12">
                                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-bottom">
                                            <label>Gender: <font color ="red"><span id ="pname_star">*</span></font></label>
                                            <span class="hidden-xs"> 
                                                <input type="radio" name="gender" value="Male" class="w3-radio w3-small" required> Male</span>
                                            <span class="hidden-xs"> 
                                                <input type="radio" name="gender"  value="Female" class="w3-radio w3-small" required> Female</span>
                                            <div class="w3-col l12 hidden-sm hidden-lg hidden-md">
                                                <span> <input type="radio" name="gender" value="Male" class="w3-radio" required> Male</span>
                                                <span> <input type="radio" name="gender" value="Female" class="w3-radio" style="margin-left: 15px" required> Female</span>
                                            </div>
                                        </div>
                                    </div>

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
                                                // print_r($package);die();
                                                //foreach ($package as $key) {
                                                ?>
                                                <option value="<?php echo 'BASIC' . '|' . 'Monthly' . '|' . '6'; ?>">6 Months</option>
                                                <option value="<?php echo 'GOLD' . '|' . 'Yearly' . '|' . '1'; ?>">1 Year</option>
                                                <?php //} ?>                      
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

                                    <div class="w3-col l12 w3-margin-bottom">
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <label>Company Name: <font color ="red"><span id ="pname_star">*</span></font></label>
                                            <input type="text" name="company_name" id="company_name" autocomplete="off" value="" class="w3-input w3-small" placeholder="Enter Number here" required>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <label>Phone Number: <font color ="red"><span id ="pname_star">*</span></font></label>
                                            <input type="number" name="ph_number" id="ph_number" autocomplete="off" min="0" value="" class="w3-input w3-small" placeholder="Enter Number here" required>
                                        </div>
                                    </div>
                                    
                                    <div class="w3-col l12 w3-margin-bottom">
                                        <div class="col-md-6 col-sm-12 col-xs-12 w3-margin-top">
                                            <input type="checkbox" name="terms_conditions" value="1" required id="mc-chekbox">
                                            <label>
                                                I agree the <a href="<?php echo base_url(); ?>user/terms_conditions" class="w3-text-grey" target="_blank"><u>Terms & Conditions</u></a>.
                                            </label>
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
                url: BASE_URL + "registration/register_user",
                data: dataString,
                return: false, //stop the actual form post !important!
                success: function (data)
                {
                    //alert(data);
                    $('#message').html(data);
                    $('#register').html('<span>Submit</span>');
                }
            });
            return false;  //stop the actual form post !important!
        });
    });


</script>