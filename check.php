<html>
<head>
<title>TravelFriendly</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />	</head>
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/responsiveslides.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="js/responsiveslides.min.js"></script>
		  <script>
		    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 1
			      $("#slider1").responsiveSlides({
			        maxwidth: 2500,
			        speed: 600
			      });
			});
		  </script>
			
			<link href = "css/bootstrap.min.css" rel = "stylesheet">
			<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />	</head>
			<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
			<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
			<link rel="stylesheet" href="css/responsiveslides.css">
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
			<script src="js/responsiveslides.min.js"></script>
			
			<style type="text/css">
			.bs-example{
				margin: 20px;
			}
			</style>
			

</head>
<body>
<script>
	var jArray= [];
	function f(jArray){
	FB.ui({method: 'apprequests',
      message: 'Try this app',
      to:'jArray'
      }, requestCallback);
   }
</script>
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
ini_set('max_execution_time', 3000);
ob_start();
/*if ( isset( $_REQUEST['logout'] ) ) {
	 echo "hi";
     unset($_SESSION['fb_token']);
	 unset($_SESSION['fb']);
	 mysql_close($db_handle);
	 session_destroy();
	 //$session->setSession(null);
}*/
$app_id = '635303243252854';
$app_secret = '0f56cd57656e5bf6784009d1231dced3';
$app_redirect = 'http://localhost/Final/check.php';

 
 
FacebookSession::setDefaultApplication($app_id,$app_secret);
$helper = new FacebookRedirectLoginHelper($app_redirect);	
$params = Array('email,read_stream,publish_stream,user_videos,user_likes,user_friends,user_hometown,user_location,user_tagged_places,user_interests,user_photos,user_status,read_stream');

try
{
  // In case it comes from a redirect login helper
  $session = $helper->getSessionFromRedirect();
  //$_SESSION['fb']=$session;
  } 
catch( FacebookRequestException $ex ) 
{
  // When Facebook returns an error
  echo $ex;
} 
catch( Exception $ex ) 
{
  // When validation fails or other local issues
  echo $ex;
}
 
if ( isset( $_SESSION['fb_token'] ) ) {
	//echo $_SESSION['fb_token'];
	$session = new FacebookSession($_SESSION['fb_token']);
	//print_r($_SESSION);
	 try
    {
        $session->Validate($app_id ,$app_secret);
    }
    catch( FacebookAuthorizationException $ex)
    {
        // Session is not valid any more, get a new one.
        $session ='';
    }
}
//$logout = 'http://localhost/logout.php';
if ( isset( $session ) ) {
   if (isset($_SESSION['username'])){
      header('Location: http://localhost/ProjectGUI/new_final.php');  
}
   global $db_handle;	
   // graph api request for user data
   $_SESSION['fb_token'] = $session->getToken();
   //echo "hi";
   //print_r($session);
   $_SESSION['session'] = $session;
   ////print_r($_SESSION);
   //echo "hi";
   //echo $_SESSION['fb_token'];
   $request = new FacebookRequest( $session, 'GET', '/me' );
   $response = $request->execute();
   // get response
   $graphObject = $response->getGraphObject(GraphUser::classname());
   //$name = $graphObject->getName();
   $sql = "create table if not exists userDetails(userName varchar(25) NOT NULL,userId bigint(20),profilePic nvarchar(100),Primary Key(userId))";
   mysql_query($sql,$db_handle);
   $userId = $graphObject->getId();
   $_SESSION['userid']= $userId;

   $userName = $graphObject->getName();
   //$locName = $graphObject->getLocation();
   //print_r($locName);
   //$userLoc=$locName->getProperty('name');
   $userProfilePic = 'http://graph.facebook.com/' .$userId. '/picture';
 $_SESSION['username']=$userName;
$_SESSION['location']=$locName;
$_SESSION['profilepic']=$userProfilePic; 
   
   $sql = "select count(*) from userDetails";
   $c =mysql_query($sql,$db_handle);
   $r = mysql_fetch_array($c);
   //$re = mysql_fetch_array($r);
   $prevRowCount = $r[0];
   //echo "$prevRowCount";
   $_SESSION['db_handle'] = $db_handle;
   $sql = "insert into userDetails values('$userName','$userId','$userProfilePic')";
   mysql_query($sql,$db_handle);
   $sql = "select count(*) from userDetails";
   $r = mysql_fetch_array(mysql_query($sql,$db_handle));
   //$re = mysql_fetch_array($r);
   $RowCount = $r[0];
   //echo "$RowCount";
   //echo $RowCount;
   //echo "<img src=\"" . $userProfilePic . "\" />"; 
   //echo $userName;
   //echo "<br><br>";
   // print_r($graphObject);
   //$locName=$loc->getProperty('name');
   //echo "<br><br>$id";
   //echo "hi";
   $request1 = new FacebookRequest($session,'GET','/me/invitable_friends');
   $response1 = $request1->execute();
   $graphObject1 = $response1->getGraphObject()->asArray();
   $idArr= array();
   foreach($graphObject1['data'] as $val){
		$idArr[] = $val->id;	
   }
   //echo'<pre>',print_r($graphObject1),'</pre>';
   //$name1 = $graphObject1->getName();
   //echo "<br>";
   //echo "<br><br>";
   //print_r($graphObject1);
   //$friendLoc = $graphObject1->getLocation();
   //$friendLocName=$friendLoc->getProperty('name');
   //echo "<br><br>";
   //print_r($friendLoc);

   //$request2 = new FacebookRequest($session,'GET','/me/taggable_friends');
   //$response2 = $request2->execute();
   //$graphObject2 = $response2->getGraphObject()->asArray();
   //echo'<pre>',print_r($graphObject2),'</pre>';
   //$fid = $graphObject2['data']['0']->id;
   //echo "<br>$fid";
   //$t = $graphObject2['data']['0']->picture->data->url;
   //print_r ($t);
   //echo "$t";
   //print_r($_SESSION);
   $request3= new FacebookRequest($session,'GET','/me/friends');
   $response3 = $request3->execute();
   $graphObject3 = $response3->getGraphObject()->asArray();
   //print_r($graphObject4);
   //$ffid = $graphObject3['data']['0']->id;
   //echo "$ffid";
   //echo'<pre>',print_r($graphObject3),'</pre>';
   $i =0;
   //echo "dfd";
   $arraySize = sizeof($graphObject3['data']);
   //echo "$arraySize";
   $fNameArray = array();
   $fIdArray = array();
   $fProfilePicArray = array();
   for($i =0;$i<$arraySize;$i++){
      $fName = $graphObject3['data'][$i]->name;
	  //echo "$fName";
      $fId = $graphObject3['data'][$i]->id;
	  //echo $fId;
	  $fProfilePic = 'http://graph.facebook.com/' .$fId. '/picture';
	  $fNameArray[]=$fName;
	  $fIdArray[]=$fId;
	  $fProfilePicArray[] = $fProfilePic;
   }
   if($prevRowCount == $RowCount-1){?>
      <!--<script>f(<?php //echo json_encode($idArr); ?>);</script>-->
   <?php }
   //echo "<br>".$fIdArray[0]."<br>";
   $sql = "create table if not exists friendDetails(userId bigint(20) NOT NULL,friendName varchar(25),friendId bigint(20),friendProfilePic nvarchar(100),Primary Key(userId,friendId))";
   mysql_query($sql,$db_handle);
   //$i =0;
   //print_r($fIdArray);
   //$sql = "insert into friendDetails values('$userId','$fNameArray[0]','$fIdArray[0]','$fProfilePicArray[0]')";
   //mysql_query($sql,$db_handle);
   for($i =0;$i<sizeof($fIdArray);$i++){
		//echo $i;
	    $sql = "insert into friendDetails values('$userId','$fNameArray[$i]','$fIdArray[$i]','$fProfilePicArray[$i]')";
        mysql_query($sql,$db_handle);
   }
   //print_r($fNameArray);
   //echo "$fName";
   $ArrayofCity = array();
   $ArrayofState = array();
   $ArrayofTime = array();
   $ArrayoffriendLocPic = array();
   //$f = array();
   //$f[] = $fIdArray[0];
   //print_r($f);
   foreach($fIdArray as $value){
      //$request4 = new FacebookRequest($session,'GET','/'.$value.'/tagged_places');
      //$response4 = $request4->execute();
      //$graphObject4 = $response4->getGraphObject()->asArray();
	  $request5 = new FacebookRequest($session,'GET','/'.$value.'/photos');
	  $response5 = $request5->execute();
      $graphObject5 = $response5->getGraphObject()->asArray();
	  //print_r($graphObject4);
	  //echo '<pre>',print_r($graphObject5),'</pre>';
	  //break;
	  $arr = array();
	  $arr1 = array();
	  $arr2 = array();
	  $arr3 = array();
	  $i = sizeof($graphObject5['data']);
      for($v =0; $v<$i;$v++){
	  	 //$lat = $graphObject4['data'][$v]->place->location->latitude;
		 //echo $long;
		 //echo "hi";
	     //$long = $graphObject4['data'][$v]->place->location->longitude;
		 //$my_url = urlencode("my url");
		 //$stringJson= file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='. $lat.','.$long.'&location_type=ROOFTOP&key=AIzaSyCeFeLWyqRv5KsBXnuVOM68bCJBCXlhHHM');
		 //echo "$stringJson";
		 //$a = json_decode($stringJson);
         //echo '<pre>',print_r($a),'</pre>';
		 //$loc = $a->results['0']->address_components['5']->long_name;
		 //echo "$loc";
		 //$arr[] = $loc;
		 //$arr1[] = $graphObject4['data'][$v]->created_time;
		 $city = $graphObject5['data'][$v]->place->location->city;
		 $state = $graphObject5['data'][$v]->place->location->state;
		 $time = $graphObject5['data'][$v]->created_time;
		 $locpic = $graphObject5['data'][$v]->images['0']->source;
		 $country = $graphObject5['data'][$v]->place->location->country;
		 $result = strcmp($country,"Japan");
		 if ($result == 0){
		    $arr[] = $city;
		    $arr1[] = $state;
		    $arr2[] = $time;
		    $arr3[] =$locpic;
		 }
	 }
	 //echo "$c<br>";
	 //$i = $i+1;
	 $ArrayofCity[] = $arr;
	 $ArrayofState[] = $arr1;
	 $ArrayofTime[] = $arr2;
	 $ArrayoffriendLocPic[] = $arr3;
	 //print_r($ArrayofLocation);
	 //echo '<pre>',print_r($ArrayofCity),'</pre>';
   }
   
   $sql = "create table if not exists friendLocation(userId nvarchar(30),friendId bigint(20),friendLoc nvarchar(100),dateOfEvent date,friendLocPic nvarchar(250),wikiPic nvarchar(250),Primary Key(wikiPic,userId,friendId,friendLoc,friendLocPic))";
   mysql_query($sql,$db_handle);
   
   //print_r($ArrayofLocation);
   //$a = str_split($ArrayofDate[0][0],10);
   //$str = json_encode(a[0]
   //echo "<br>".sizeof($ArrayofLocation[0]);
   //echo "<br>".sizeof($ArrayofLocation);
   //echo "<br>".is_array($ArrayofDate[0][0])? 'Array' : 'not an Array';
   // $x=json_encode($ArrayofLocation[0][0]);
   // echo "<br>".$x;
   for($i =0;$i<sizeof($ArrayofCity);$i++){
	  for($j =0;$j<sizeof($ArrayofCity[$i]);$j++){
		 $x=$ArrayofCity[$i][$j];
		 if($x == NULL) continue;
		 $x=$ArrayofState[$i][$j];
		 if($x == NULL) continue;
	     //echo $x;
		 //$y=str_split(json_encode($ArrayofDate[$i][$j]),11);
		 //print_r($ArrayofLocation[$i][$j]);
		 //echo "<br>".is_array($ArrayofDate[$i][$j])? 'Array' : 'not an Array';
		 //$st = json_encode($y[0]);
		 //echo $st;
		 $strCity = serialize($ArrayofCity[$i][$j]);
		 $strCC = explode("\"",$strCity);
		 $strC = explode("-ku",$strCC[1]);
		 //print_r($strC);
		 $strState = serialize($ArrayofState[$i][$j]);
		 $strS = explode("\"",$strState);
		 $loc = "$strC[0],$strS[1]";
		 //echo $strC[0];
		 $url = "http://en.wikipedia.org/w/api.php?action=query&titles=$strC[0]&prop=pageimages&format=json&pithumbsize=100";
		 //echo $url;
		 $response = json_decode(file_get_contents($url));
		 //echo "$stringJson";
		 //$result = json_decode($response);
         //echo '<pre>',print_r($result),'</pre>';
		 $key = array_keys(get_object_vars($response->query->pages))[0]; 
		 //$key = $step[0];
		 //$value = get_object_vars($step);
		 //echo $step;
		 $wikiPic = $response->query->pages->$key->thumbnail->source;
		 //echo $wikiPic;
		 $strProfile = serialize($ArrayoffriendLocPic[$i][$j]);
		 $strP = explode("\"",$strProfile);
		 if($wikiPic == NULL){
		 //echo "hi";
		 $wikiPic = $strP[1];
		 //echo $wikiPic;
		 }
		 $strDate = serialize($ArrayofTime[$i][$j]);
		 //echo $strDate;
		 $strD = explode("T",$strDate);
		 $strDD = explode("\"",$strD[0]);
		 //print_r($strDD);
		 //echo "<br>".is_array($ArrayofCity[$i][$j])? 'Array' : 'not an Array';
		 $sql = "insert into friendLocation values($userId,$fIdArray[$i],'$loc','$strDD[1]','$strP[1]','$wikiPic')";
         mysql_query($sql,$db_handle);
	  }
   }
   //$request5 = new FacebookRequest($session,'GET','/me/feed/');
   //$response5 = $request5->execute();
   //$graphObject5 = $response5->getGraphObject();
   //echo '<pre>',print_r($graphObject5),'</pre>';
   $sql = "create or replace view concat as SELECT * FROM friendlocation NATURAL JOIN frienddetails where frienddetails.userId = $userId"; 
   mysql_query($sql,$db_handle);
   //$sql = "create table if not exists t(SELECT * FROM friendlocation NATURAL JOIN frienddetails where frienddetails.userId = $userId)"; 
   //mysql_query($sql,$db_handle);
   $sql = "create or replace view countLocation as SELECT friendLoc,count(friendLoc) from concat GROUP BY friendLoc Order by count(friendLoc) desc;"; 
   mysql_query($sql,$db_handle);
   //$sql = "create table if not exists locAndfriend(userId nvarchar(30),friendId nvarchar(30),friendName varchar(30),friendProfilePic varchar(100),friendLocation nvarchar(30),Primary Key(userId,friendId,friendName,friendLocation))";
   //mysql_query($sql,$db_handle);
   $sql = "create or replace view trendingLocations as SELECT friendLoc,count(friendLoc) from friendlocation GROUP BY friendLoc Order by count(friendLoc) desc;"; 
   mysql_query($sql,$db_handle);
   $sql = "create table if not exists prefectures(prefectureName nvarchar(30),prefectureNo int,Primary Key(prefectureName,prefectureNo))";
   mysql_query($sql,$db_handle);
   $PrefectureArray = array(Hokkaido,Aomori,Iwate,Miyagi,Akita,Yamagata,Fukushima,Ibaraki,Tochigi,Gunma,Saitama,Chiba,Tokyo,Kanagawa,Niigata,Toyama,Ishikawa,Fukui,Yamanashi,Nagano,Gifu,Shizuoka,Aichi,Mie,Shiga,Kyoto,Osaka,Hyogo,Nara,Wakayama,Tottori,Shimane,Okayama,Hiroshima,Yamaguchi,Tokushima,Kagawa,Ehime,Kochi,Fukuoka,Saga,Nagasaki,Kumamoto,Oita,Miyazaki,Kagoshima,Okinawa);
   $i = 1;
   foreach($PrefectureArray as $value){
	   $sql = "insert into prefectures values('$value',$i)";
	   mysql_query($sql,$db_handle);
	   $i++;
   }
   $sql = "select count(*) from countlocation";
   $count	 = mysql_fetch_array( mysql_query($sql,$db_handle));
   if($count[0] >5){
       $count[0] = 5;
   }
   if($count[0] < 5)
   {$count[0] = 0;
    echo "Sorry! We don't have any recommendations for you at present. Suggest your friends to use this app!!";
   }
   //print_r($count);

   $sql = "select friendLoc from countlocation limit $count[0] offset 0";
   $res = mysql_query($sql,$db_handle);
   if($res === FALSE) {
     die(mysql_error()); // TODO: better error handling
   }
      //echo "dfd";

   //$row = mysql_fetch_array( $res );
   //print_r($row);
   $i =0;
   while($row = mysql_fetch_array( $res )){
      //print_r($row);
      $sql = "select friendId,friendName,friendProfilePic,friendLoc,friendLocPic,wikiPic from concat where friendLoc = '$row[0]'";
	  $r = mysql_query($sql,$db_handle);
	  $name = "suggestion$i";
	  //echo $name;
	  while($row1 =mysql_fetch_array($r)){
	    //print_r($row1); 
	    $sql = "create table if not exists ".$name."(userId nvarchar(20),friendId nvarchar(20),friendName varchar(30),friendProfilePic nvarchar(100),friendLoc nvarchar(100),friendLocPic nvarchar(250),wikiPic nvarchar(250),Primary Key(userId,friendId))";
        //echo $sql;
		mysql_query($sql,$db_handle);
		$sql = "insert into ".$name." values($userId,'$row1[0]','$row1[1]','$row1[2]','$row1[3]','$row1[4]','$row1[5]')";
		mysql_query($sql,$db_handle);
      }
	  $i++;
	  //print_r($row);
   }
   //$sql ="alter table locAndfriend group by friendLocation";
   //mysql_query($sql,$db_handle);
   $_SESSION['help'] = $helper;
   //echo "wsd";
   //echo '<a href="' . $helper->getLogoutUrl($session,'http://localhost/logout.php') . '"><button>LogOut</button></a>';
   header('Location: http://localhost/Final/new_final2.php');  
   exit();

}	
else { ?>
  <!--<a id ="auto" href="<?php echo $helper->getLoginUrl($params); ?>">Login</a>
  <script>
    //var elem = document.getElementById('auto').click();
  </script>-->
  <!--<marquee direction="right"><h2 style="color: silver;">Welcome To Travel Friendly</h2></marquee>
  //<a href="<?php echo $helper->getLoginUrl($params);?>" target ="_top" style="text-align: center;"><h2>Login</h2></a><br><br>-->
		<!---start-wrap---->
			<!---start-header---->
			<div class="bs-example">	
				<nav role="navigation" class="navbar navbar-default">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="#" class="navbar-brand"><h3>Travelfriendly</h3></a>
					</div>
					
					<div id="navbarCollapse" class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							
							<li>
							
							
							
							 <?php
							  echo '<a href="' . $loginUrl=$helper->getLoginUrl($params) . '"><button class="btn btn-small btn-primary" type="button">Login With Facebook</button></a>';
							//echo $_SESSION['profilepic'];
							?>
							</li>
						</ul>
					</div>
				</nav>
			</div>
	

				
			<!---End-header---->
		
		<!--start-image-slider---->
					<div class="image-slider">
						<!-- Slideshow 1 -->
					    <ul class="rslides" id="slider1">
					      <li>
					      	<img src="images/sk1.jpg" alt="">
					      	<div class="slider-info" style="text-al">
					      		<p>TravelFriendly</p>
					      		<span>Travel | Explore | Live</span>
					      		
					      	</div>
					      </li>
					      <li><img src="images/sk2.jpg" alt="">
					      	<div class="slider-info">
					      		<p>TravelFriendly </p>
					      		<span>Travel | Explore | Live</span>
								
					      	</div>
					      </li>
					      <li><img src="images/sk3.jpg" alt="">
					      	<div class="slider-info">
					      		<p>TravelFriendly</p>
					      		<span>Travel | Explore | Live</span>
					      	</div> 
					      </li> 
					    </ul>
						 <!-- Slideshow 2 -->
					</div>
			<!--End-image-slider---->
		<!---End-wrap---->
		<div class="clear"> </div>
		<!---start-content---->
		<div class="content">
			<div class="wrap">
		
			<!--
			<div class="content-grids">
				<div class="grid">
					<a href="#"><img src="images/grids-img1.jpg" title="image-name" /></a>
					<h3>DESTINATIONS</h3>
					<p>Lorem ipsum dolor sit amet consectetur adiing elit. In volutpat luctus eros ac placerat. Quisque erat metus facilisis non feu,aliquam hendrerit quam. Donec ut lectus vel dolor adipiscing tincnt.</p>
					<a class="button" href="#">More</a>
				</div>
				<div class="grid">
					<a href="#"><img src="images/grids-img2.jpg" title="image-name" /></a>
					<h3>NEWS & EVENTS</h3>
					<p>Lorem ipsum dolor sit amet consectetur adiing elit. In volutpat luctus eros ac placerat. Quisque erat metus facilisis non feu,aliquam hendrerit quam. Donec ut lectus vel dolor adipiscing tincnt.</p>
					<a class="button" href="#">More</a>
				</div>
				<div class="grid last-grid">
					<a href="#"><img src="images/grids-img3.jpg" title="image-name" /></a>
					<h3>SUPPORT</h3>
					<p>Lorem ipsum dolor sit amet consectetur adiing elit. In volutpat luctus eros ac placerat. Quisque erat metus facilisis non feu,aliquam hendrerit quam. Donec ut lectus vel dolor adipiscing tincnt.</p>
					<a class="button" href="#">More</a>
				</div>
				<div class="clear"> </div>
			</div>
			
			<div class="clear"> </div>
			<div class="specials">
					<div class="specials-heading">
						<h5> </h5><h3>Traveling Specials</h3><h5> </h5>
						<div class="clear"> </div>
					</div>
					<div class="clear"> </div>
					<div class="specials-grids">
						<div class="special-grid">
							<img src="images/grids-img1.jpg" title="image-name" />
							<a href="#">Latest Plans</a>
							<p>Lorem ipsum dolor sit amet consectetur adiing elit. In volutpat luctus eros ac placerat. Quisque erat metus facilisis non feu,aliquam hendrerit quam. Donec ut lectus vel dolor adipiscing tincnt.</p>
						</div>
						<div class="special-grid">
							<img src="images/grids-img2.jpg" title="image-name" />
							<a href="#">Pre Plans</a>
							<p>Lorem ipsum dolor sit amet consectetur adiing elit. In volutpat luctus eros ac placerat. Quisque erat metus facilisis non feu,aliquam hendrerit quam. Donec ut lectus vel dolor adipiscing tincnt.</p>
						</div>
						<div class="special-grid spe-grid">
							<img src="images/grids-img3.jpg" title="image-name" />
							<a href="#">Free Plans</a>
							<p>Lorem ipsum dolor sit amet consectetur adiing elit. In volutpat luctus eros ac placerat. Quisque erat metus facilisis non feu,aliquam hendrerit quam. Donec ut lectus vel dolor adipiscing tincnt.</p>
						</div>
						<div class="clear"> </div>
					</div>
					<div class="clear"> </div>
			</div>
			
			</div>	
			<div class="clear"> </div>
			<div class="testmonials">
				<div class="wrap">
					<div class="testmonial-grid">
						<h3>TESTIMONIALS :</h3>
						<p>&#34; Lorem ipsum dolor sit amet, consectetur adipiscing elit. In volutpat luctus eros ac placerat. Quisque erat metus, facilisis non felis eu, aliquam hendrrit quam. Donec ut lectus vel dolor adipiscing tincidunt. Ut auctor diam at est iaculis, vitae interdum magna sagittis.&#34;</p>
						<a href="#"> - Lorem ipsum</a>
					</div>
				</div>
			</div>
			-->
		</div>
		<!---End-content---->
		<div class="clear"> </div>
		<!---start-footer---->
		<div class="footer">
			<div class="wrap">
			<div class="footer-grids">
				<div class="footer-grid">
					<h3 style="text-align: center;">EXTRAS</h3>
					<p>Follow your friends wherever they went</p>
				</div>
				<div class="footer-grid">
					<h3>RECENT POSTS</h3>
					<ul>
						<li><a href="#">Top 10 Locations</a></li>
						<li><a href="#">Where To Go</a></li>
						<li><a href="#">Prefeered Places</a></li>
						<li><a href="#">Visit</a></li>
					</ul>
				</div>
				<div class="footer-grid">
					<h3>USEFUL INFO</h3>
					<ul>
						<li><a href="#">Beautiful Places</a></li>
						<li><a href="#">Countries</a></li>
						<li><a href="#">Tour Package</a></li>
						<li><a href="#">Others</a></li>
					</ul>
				</div>
				<div class="footer-grid footer-lastgrid">
					<h3>CONTACT US</h3>
					<p>Travel Friendly,Tokyo</p>
					<div class="footer-grid-address">
						<p>Tel.800-255-9999</p>
						<p>Fax: 1234 568</p>
						<p>Email:<a class="email-link" href="#">contact@travelfriendly.com</a></p>
					</div>
				</div>
				<div class="clear"> </div>
			</div>
			</div>
		</div>
		<!---End-footer---->
		<div class="clear"> </div>
		<div class="copy-right">
			<p>Design by TravelFriendly Team</a></p>
		</div>

  <?php }
?>
</body>
</html>
