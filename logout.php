<?php
require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/Entities/AccessToken.php');
require_once( 'Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'Facebook/HttpClients/FacebookCurl.php' );
require_once( 'Facebook/HttpClients/FacebookCurlHttpClient.php' );
require_once( 'Facebook/GraphUser.php' );
require_once( 'Facebook/GraphSessionInfo.php' );
require_once( 'Facebook/GraphLocation.php' );



 
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken; 
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\GraphLocation;
include('My_Sql Connection.php'); 
session_start();
$sql = "delete from suggestion0 where userId ='".$_SESSION['userid']."'";
echo $sql;
mysql_query($sql,$db_handle);
$sql = "delete from suggestion1 where userId ='".$_SESSION['userid']."'";
mysql_query($sql,$db_handle);
$sql = "delete from suggestion2 where userId ='".$_SESSION['userid']."'";
mysql_query($sql,$db_handle);
$sql = "delete from suggestion3 where userId ='".$_SESSION['userid']."'";
mysql_query($sql,$db_handle);
$sql = "delete from suggestion4 where userId ='".$_SESSION['userid']."'";
if (isset($_SESSION)){
	unset($_SESSION);
}

mysql_query($sql,$db_handle);
mysql_close($db_handle);
//ob_destroy();
session_destroy();
header('Location: check.php');  
?>
