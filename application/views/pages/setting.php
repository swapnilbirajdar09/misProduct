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
                        <div class="col-lg-6 col-sm-12 col-xs-12 w3-padding-small ">
                            <div class="w3-col l12 w3-small w3-round w3-margin-bottom w3-border w3-padding-medium">
                                <label><i class="fa fa-inr"></i> Fixed Cost</label><br>
                                <form id="updateFixedCost">
                                    <div class="w3-col l8 w3-padding-right w3-margin-bottom">
                                        <input type="text" name="fixed_cost" value="<?php echo $fcost['status_message'][0]['setting_value']; ?>" placeholder="Enter Fixed Cost" id="fixed_cost" class="w3-input" required>
                                    </div>
                                    <div class="w3-col l4">
                                        <button type="submit" class="w3-button theme_bg">Update</button>
                                    </div>
                                </form>
                            </div>

                            <div class="w3-col l12 w3-round w3-margin-bottom w3-small w3-border w3-padding-medium">
                                <label><i class="fa fa-percent"></i> Profit Margin</label><br>
                                <form id="updateProfitMargin">
                                    <div class="w3-col l8 w3-padding-right w3-margin-bottom">
                                        <input type="text" name="profit_margin" value="<?php echo $profit['status_message'][0]['setting_value']; ?>" placeholder="Enter Profit Margin" id="profit_margin" class="w3-input" required>
                                    </div>
                                    <div class="w3-col l4">
                                        <button type="submit" class="w3-button theme_bg">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                       <!--  <div class="col-lg-6 col-sm-12 col-xs-12">
                            <div class="w3-card w3-padding" id="skill" ng-app="skillApp" ng-controller="skillController">
                                <label for="skill"><i class="fa fa-database"></i> Add Skill:</label>
                                <div class="w3-container w3-white">
                                    <div class="w3-row w3-margin-top">
                                        <form ng-submit="submit()" method="POST">
                                            <div class="w3-col l10 s10">
                                                <input type="text" ng-model="skillname" class="form-control w3-small"  required>
                                            </div>
                                            <div class="w3-col l2 s2"> 
                                                <button class="btn btn-primary theme_bg btn-block" type="submit"><i class="fa fa-plus "></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="row w3-padding" style="height:250px; overflow: auto;">
                                        <div class="col-lg-12 col-xs-12 col-md-12 w3-padding" ng-repeat='skill in skills'>
                                            <span>{{skill.skill_name}} </span>
                                            <a type="btn" ng-click="delskill(skill.skillid)" class="w3-right" ><i class="fa fa-times w3-text-black"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

 <!-- add skill div start -->

    <div class="col-md-4 col-sm-12 col-xs-12 w3-margin">
        <label for="skill"><i class="fa fa-database"></i> Add Skill:</label>
        <div class="w3-card w3-padding" id="skill" ng-app="skillApp" ng-controller="skillController">
            <div class="w3-container w3-white">
                <div class="w3-row w3-margin-top">
                    <form ng-submit="submit()" method="POST">
                        <div class="w3-col l10 s10">
                            <input type="text" ng-model="skillname" class="form-control w3-small"  required>
                        </div>
                        <div class="w3-col l2 s2"> 
                            <button class="btn btn-primary theme_bg btn-block" type="submit"><i class="fa fa-plus "></i></button>
                        </div>
                    </form>
                </div>
                <div class="row w3-padding" style="height:250px; overflow: auto;">
                    <div class="col-lg-12 col-xs-12 col-md-12 w3-padding" ng-repeat='skill in skills'>
                        <span>{{skill.skill_name}} </span>
                        <a type="btn" ng-click="delskill(skill.skill_id)" class="w3-right" ><i class="fa fa-times w3-text-black"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- div for add category -->                        
                    </div>
                </div>
            </div>
        </div>
        <!-- upload document div ends -->
        <!-- view all document div ends -->
    </div>
</div>
<script>
        var skill = angular.module('skillApp', ['ngSanitize']);
    skill.controller('skillController', function($scope, $http){

//alert($scope.skillname);
    $scope.submit = function ()    {           // POST form data to controller
    $http({
    method: 'POST',
            url: '<?php echo base_url(); ?>settings/addskills',
            headers: {'Content-Type': 'application/json'},
            data: JSON.stringify({skillname: $scope.skillname})
    }).then(function successCallback (data) {
    // alert(data);
    //console.log(data);
    $scope.skillname = '';
    $scope.getUsers();
    });
    };
    //---------show all skill
    $scope.getUsers = function(){
    $http({
    method: 'get',
            url: '<?php echo base_url(); ?>settings/getAllSkills'
    }).then(function successCallback(response) {
    // Assign response to skills object
     //console.log(response);
    $scope.skills = response.data;
    // $scope.mes=response;
    });
    };
    $scope.getUsers();
    //---del skill
    $scope.delskill = function(skillid){

    $http({
     method: 'get',
             url: '<?php base_url(); ?>settings/delSkill?skillid=' + skillid
     }).then(function successCallback(response) {
 // alert(response);
    // // Assign response to skills object
 console.log(response);
    //$scope.skills = response.data;
     $scope.getUsers();
     });
     };
    });
    //  var skill = angular.module('skillApp', ['ngSanitize']);
    //  skill.controller('skillController', function ($scope, $http) { //alert("1");
    //      $scope.submit = function () {           // POST form data to controller
    //          $http({//alert("2");
    //              method: 'POST',
    //              url: '<?php echo base_url(); ?>settings/addskills',
    //              headers: {'Content-Type': 'application/json'},
    //              data: JSON.stringify({skillname: $scope.skill_name})
    //          }).then(function (data) {
    //              alert(data);
    //             console.log(data);
    //             $scope.skillname = '';
    //             $scope.getSkills();
    //         });
    //     };
    //     //---------show all skill
    //     $scope.getSkills = function () {
    //         $http({
    //             method: 'get',
    //             url: '<?php echo base_url(); ?>settings/getAllSkills'
    //         }).then(function successCallback(response) {
    //             // Assign response to skills object
    //             // console.log(response);
    //             $scope.skills = response.data;
    //             // $scope.mes=response;
    //         });
    //     };
    //     $scope.getSkills();
    //     //---del skill
    //     $scope.delskill = function (skillid) {

    //         $http({
    //             method: 'get',
    //             url: '<?php base_url(); ?>settings/delSkill?skillid=' + skillid
    //         }).then(function successCallback(response) {
    //             // alert(response);
    //             // Assign response to skills object
    //             console.log(response);
    //             //$scope.skills = response.data;
    //             $scope.getSkills();
    //         });
    //     };
    // });
    angular.bootstrap(document.getElementById("skill"), ['skillApp']);

</script>
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script> -->
