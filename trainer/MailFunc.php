
<?php
error_reporting(0);
require_once("../logout_require.php"); 
  require_once '../vendor/autoload.php'; // or wherever autoload.php is located
  require_once '../database.php';
  $_SESSION['reciv'] = $_GET['reciv'];
  $_SESSION['body'] = $_GET['body'];
  $_SESSION['subj'] = $_GET['subj'];
  $_SESSION['from'] = $_GET['from'];
  $connect = mysqli_connect($hostname, $username, $password, $dbname);
    $client = new Google_Client();
    $client->setClientId("243977505354-ed8vaqcecbclr6lj0drm8p6i1djs06iv.apps.googleusercontent.com");
    $client->setClientSecret("qNrAzdzOcg74_352n40aBnsd");
    $client->setRedirectUri("https://localhost/ASM/ASM/trainer/MailFunc.php");
    $client->setAccessType('offline');
    $client->setApprovalPrompt('force');
 
    $client->addScope("https://mail.google.com/");
    $client->addScope("https://www.googleapis.com/auth/gmail.compose");
    $client->addScope("https://www.googleapis.com/auth/gmail.modify");
    $client->addScope("https://www.googleapis.com/auth/gmail.readonly");
 
 
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

    
 
//$isAccessCodeExpired = $client->isAccessTokenExpired();
//if (isset($_SESSION['gmail_access_token']) &amp;&amp; !empty($_SESSION['gmail_access_token']) &amp;&amp; $isAccessCodeExpired != 1) {
if (isset($_SESSION['gmail_access_token'])) {
    try {
        //$client = getClient();
    $OK = $_SESSION['reciv'];
    $service = new Google_Service_Gmail($client);
    $strSubject = $_SESSION['subj'];
    $mail = $_SESSION['Email'];
    $strRawMessage = "From: ".$mail."\r\n";
    $strRawMessage .= "To: ".$OK."\r\n";
    $strRawMessage .= "Subject: =?utf-8?B?" . base64_encode($strSubject) .     "?=\r\n";
    $mime = rtrim(strtr(base64_encode($strRawMessage), '+/', '-_'), '=');
    $msg = new Google_Service_Gmail_Message();
    $msg->setRaw($mime);
    // $strRawMessage .= "Content-Type: text/html; charset=utf-8\r\n";
    // $strRawMessage .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
    // $strRawMessage .= "Name";
    $id = $_SESSION['googleid'];
    //echo $id;
    $service->users_messages->send($id, $msg);
    //echo "mail sent";
    echo "<script> alert('Successfully!')</script>";
    echo "Successfully Update <a href='https://localhost/ASM/ASM/trainer/viewCourse.php'>Click Here to back</a>";
    header("refresh: 0;url=https://localhost/ASM/ASM/trainer/viewCourse.php");
                 
    } catch (Exception $e) {
        //print($e->getMessage());
        //unset($_SESSION['access_token']);
    } 
}
else {
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
 
function encodeRecipients($recipient){
    $recipientsCharset = 'utf-8';
    // if (preg_match("/(.*)<(.*)>/", $recipient, $regs)) {
    //     $recipient = '=?' . $recipientsCharset . '?B?'.base64_encode($regs[1]).'?= <'.$regs&#91;2&#93;.'>';
    // }
    return $recipient;
}