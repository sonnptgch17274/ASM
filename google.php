
<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
require_once 'vendor/autoload.php';
// Lấy những giá trị này từ https://console.google.com
$client_id = '243977505354-ed8vaqcecbclr6lj0drm8p6i1djs06iv.apps.googleusercontent.com'; 
$client_secret = 'qNrAzdzOcg74_352n40aBnsd';
$redirect_uri = 'https://'. $_SERVER['HTTP_HOST'] .'/ASM/ASM/google.php';
// add set for client
$client = new Google_Client();
$client->addScope("https://www.googleapis.com/auth/userinfo.email");
$client->setAccessType('offline');        // offline access
$client->setIncludeGrantedScopes(true);   // incremental auth
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setAccessType('offline');
$client->setPrompt('select_account consent');
$plus = new Google_Service_Oauth2($client);
//connect db
$servename = "localhost";
$username = "root";
$password = "";
$dbname = "edusys";
$conn = mysqli_connect($servename, $username, $password, $dbname);
if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

if (isset($_REQUEST['logout'])) {
        unset($_SESSION['access_token']);
}

if (isset($_GET['code'])) {
        if (strval($_SESSION['state']) !== strval($_GET['state'])) {
                error_log('The session state did not match.');
                exit(1);
        }

        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();
        //header('Location: ' . REDIRECT);
}

if (isset($_SESSION['access_token'])) {
        $client->setAccessToken($_SESSION['access_token']);
}

if ($client->getAccessToken() && !$client->isAccessTokenExpired()) {
        try {
                $me = $plus->userinfo->get();
                echo'------>HERE<------------';
                $gid = $me['id'];
                //echo $gid;
                $namequery = mysqli_query($conn,"SELECT * FROM tbluser WHERE googleid= '$gid' ");

                if(mysqli_num_rows($namequery) > 0){

                    $row = mysqli_fetch_array($namequery, MYSQLI_ASSOC );
                    $_SESSION['currUserName'] = $row['Name'];
                    $_SESSION['currUser'] = $row['username'];
                    $_SESSION['currusername'] = $row['username'];
                    $_SESSION['googleid'] = $row['googleid'];
                    $_SESSION['Email'] = $row['Email'];

                    if ($row['Role'] == 'Admin') {
                        $_SESSION['currAdmin'] = $row['Role'];
                        header("Refresh:0;url = pages/adminstrator.php");
                    }
                    else if($row['Role'] == 'Trainer'){
                        $_SESSION['currUser'] = $row['Role'];
                        header("Refresh:0;url = trainer/index.php");
                    }
                    else if($row['Role'] == 'Trainee'){
                        $_SESSION['currUser'] = $row['Role'];
                        header("Refresh:0;url = trainee/index.php");
                    }

                } else{
                    echo "<script> alert('Invalid Username')</script>";
                }

        $sql = "SELECT * FROM tbluser WHERE googleid = '$gid'";
        $query = mysqli_query($conn, $sql);
        if ($query)
        {
        if (mysqli_num_rows($query) > 0) {
                echo "Login with Google successfully";
            } else {
                echo "No account ";
            }
        }else{
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        $conn->close();

        } catch (Google_Exception $e) {
                error_log($e);
                $body = htmlspecialchars($e->getMessage());
        }
        # the access token may have been updated lazily
       $_SESSION['access_token'] = $client->getAccessToken();
       
} else {
        $state = mt_rand();
        $client->setState($state);
        $_SESSION['state'] = $state;
        $body = sprintf('<p> <a href="%s"> Click to continue </a></p>',
            $client->createAuthUrl());
}

?>
<!DOCTYPE HTML>
<HTML>
<HEAD>
        <TITLE>Login with Google </TITLE>
</HEAD>
<BODY>
        <?= $body ?>
</BODY>
</HTML>

<?php

if (isset($gid)){
if ($conn->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
	
}
?>