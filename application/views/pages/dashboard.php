
<title>Dashboard</title>


<div class="right_col" role="main">
    <div class="x_title">
        <h2><i class="fa fa-user-cirlce"></i> Dashboard</h2>
        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="w3-col l12 w3-padding-small w3-margin-top page_title">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class=""></i> Reports</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <?php  
 echo $AUTH_SECRET = 'SvsS6rHdARqFq8Z';
 echo '<br>';
 echo $APPLICATION_ID = '76217';
  echo '<br>';
 echo $AUTH_KEY = 'WVz2CesF2WZBRJv';
  echo '<br>';
 echo $nonce = rand();
  echo '<br>';
 echo $timestamp = 1552560951;
  echo '<br>';
 echo $USER_LOGIN = 'swapnil';
  echo '<br>';
 echo $USER_PASSWORD = 'swapnil1234';
  echo '<br>';
 $signature_string = "application_id=".$APPLICATION_ID."&auth_key=".$AUTH_KEY."&nonce=".$nonce."&timestamp=".$timestamp."&user[login]=".$USER_LOGIN."&user[password]=".$USER_PASSWORD;
 
 echo "stringForSignature: " . $signature_string . "<br><br>";
 $signature = hash_hmac('sha1', $signature_string , $AUTH_SECRET);
 echo $signature;
?>
</div>

<!-- /page content -->
<!-- script for category -->

