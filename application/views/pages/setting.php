<div class="right_col" role="main">
    <div class="page-title">
        <div class="title_left w3-col l12">
            <h3><i class="fa fa-cog"></i> Settings</h3>
        </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
        <!-- upload document div -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-cog"></i> Settings</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div id="response_msg"></div>

                <div class="container x_content">
                    <div class="w3-col l12">
                        <!-- div for update email id -->
                        <div class="col-lg-6 w3-padding-small ">
                            <div class="w3-col l12 w3-small w3-round w3-margin-bottom w3-border w3-padding-medium">
                                <label><i class="fa fa-inr"></i> Fixed Cost</label><br>
                                <form id="updateFixedCost">
                                    <div class="w3-col l8 w3-padding-right w3-margin-bottom">
                                        <input type="text" name="fixed_cost" value="<?php echo $fcost['status_message'][0]['setting_value']; ?>" placeholder="Enter Email-ID here..." id="fixed_cost" class="w3-input" required>
                                    </div>
                                    <div class="w3-col l4">
                                        <button type="submit" class="w3-button w3-red">Update</button>
                                    </div>
                                </form>
                            </div>

                            <div class="w3-col l12 w3-round w3-margin-bottom w3-small w3-border w3-padding-medium">
                                <label><i class="fa fa-percent"></i> Profit Margin</label><br>
                                <form id="updateProfitMargin">
                                    <div class="w3-col l8 w3-padding-right w3-margin-bottom">
                                        <input type="text" name="profit_margin" value="<?php echo $profit['status_message'][0]['setting_value']; ?>" placeholder="Enter Private Key here..." id="profit_margin" class="w3-input" required>
                                    </div>
                                    <div class="w3-col l4">
                                        <button type="submit" class="w3-button w3-red">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- div for update user name -->
                        <!--                        <div class="col-lg-6 w3-padding-small w3-small w3-margin-bottom">
                                                    <div class="w3-col l12 w3-small w3-round w3-margin-bottom w3-border w3-padding-small">
                                                        <label><i class="fa fa-users"></i> Update Username</label><br>
                                                        <form id="updateUname">
                                                            <div class="w3-col l8 w3-padding-right w3-margin-bottom">
                                                                <input type="text" name="admin_uname" value="" placeholder="Enter Username Here..." id="admin_uname" class="w3-input" required>
                                                            </div>
                                                            <div class="w3-col l4">
                                                                <button type="submit" class="w3-button w3-red">Update Username</button>
                                                            </div>
                                                        </form>
                                                    </div>
                        
                                                    <div class="w3-col l12 w3-round w3-margin-bottom w3-border w3-padding-small">
                                                        <label><i class="fa fa-lock"></i> Update Password</label><br>
                        
                                                        <form id="updatePass">
                                                            <div class="w3-col l8 w3-padding-right w3-margin-bottom">
                                                                <input type="text" name="admin_pass" value="" placeholder="Enter Password here..." id="admin_email" class="w3-input" required>
                                                            </div>
                                                            <div class="w3-col l4">
                                                                <button type="submit" class="w3-button w3-red">Update Password</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- upload document div ends -->
        <!-- view all document div ends -->
    </div>
</div>

<script>
    $(function () {
        $("#updateFixedCost").submit(function () {
            dataString = $("#updateFixedCost").serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>settings/updateFixedCost",
                data: dataString,
                return: false, //stop the actual form post !important!
                success: function (data)
                {
                    $.alert(data);
                }
            });
            return false;  //stop the actual form post !important!
        });
    });
</script>
<!-- script ends here -->
<!--  script to update email id   -->
<script>
    $(function () {
        $("#updateProfitMargin").submit(function () {
            dataString = $("#updateProfitMargin").serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>settings/updateProfitMargin",
                data: dataString,
                return: false, //stop the actual form post !important!

                success: function (data)
                {
                    $.alert(data);
                }
            });
            return false;  //stop the actual form post !important!
        });
    });
</script>
