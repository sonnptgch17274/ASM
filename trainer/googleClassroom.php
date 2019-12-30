<?php
 require_once '../vendor/autoload.php'; // or wherever autoload.php is located
 require_once '../database.php';
 require_once("../logout_require.php");
 //session_start() ; //require_once 'email_Sender.php';
 $_SESSION['ownerId'] = $_GET['email'];
 $_SESSION['ID_Course'] = $_GET['id'];
 error_reporting(E_ERROR | E_PARSE);


    $client = new Google_Client();
    //$client->setApplicationName('Google Classroom API PHP Quickstart');
    $client->addScope("https://www.googleapis.com/auth/classroom.courses");
    $client_id = '243977505354-ed8vaqcecbclr6lj0drm8p6i1djs06iv.apps.googleusercontent.com'; 
    $client_secret = 'qNrAzdzOcg74_352n40aBnsd';
    //$client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');
    $redirect_uri = 'https://'. $_SERVER['HTTP_HOST'] .'/ASM/ASM/trainer/googleClassroom.php';
// add set for client
    $client->setIncludeGrantedScopes(true);   // incremental auth
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.

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

    if (isset($_SESSION['access_token'])) {

        try {
            $api = new Google_Service_Classroom($client);
            $client = $api->getClient();
            $ownerId = $_SESSION['ownerId'];
            $ID_Course = $_SESSION['ID_Course'];
            $course = new Google_Service_Classroom_Course(['name'=>'Vleuuuu']);
            $course->setOwnerId($ownerId);
            $excute = $api->courses->create($course);
            $enr = $excute['enrollmentCode'];
            $ow = $excute['ownerId'];
            $link = $excute['alternateLink'];
            require_once '../database.php';
            $connect = mysqli_connect($hostname, $username, $password, $dbname);  
            $sql = "UPDATE tblcourse SET googleclass='$enr',classURL = '$link' WHERE ID_Course=" . $ID_Course;
            mysqli_query($connect,$sql);
            if($sql)
            echo "<script> alert('Successfully! Please access Googleclassroom to Enroll')</script>";
            echo "Successfully Update <a href='https://localhost/ASM/ASM/trainer/viewCourse.php'>Click Here to back</a>";
            header("refresh: 0;url=https://localhost/ASM/ASM/trainer/viewCourse.php");
        } catch (Exception $e) {
            print($e->getMessage());
            //unset($_SESSION['access_token']);
        } 
    }else {
        // Failed Authentication
        if (isset($_REQUEST['error'])) {
            //header('Location: ./index.php?error_code=1');
            echo "error auth";
        }
        else{
            // Redirects to google for User Authentication
            $authUrl = $client->createAuthUrl();
            header("Location: $authUrl");
        }
    }
?>