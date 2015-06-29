<!DOCTYPE HTML>

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
 
$app_id = '635303243252854';
$app_secret = '0f56cd57656e5bf6784009d1231dced3';
$app_redirect = 'http://localhost/check.php';

 
 
 
//FacebookSession::setDefaultApplication($app_id,$app_secret);


FacebookSession::setDefaultApplication($app_id,$app_secret);
		session_start();

	//	
	//	include('check.php');

							
							$userid=$_SESSION['userid'];
							//echo $userid;
							//sql query for each table
							
							$sql0="select friendLoc,friendName,friendProfilePic,friendLocPic from suggestion0 where userId=$userid";
							$sql1="select friendLoc, friendName,friendProfilePic,friendLocPic from suggestion1 where userId= $userid";
							$sql2="select friendLoc, friendName,friendProfilePic,friendLocPic from suggestion2 where userId= $userid";
							$sql3="select friendLoc, friendName,friendProfilePic,friendLocPic from suggestion3 where userId= $userid";
							$sql4="select friendLoc, friendName,friendProfilePic,friendLocPic from suggestion4 where userId= $userid";
						    $result0=mysql_query($sql0,$db_handle);
							$result1=mysql_query($sql1,$db_handle);
							$result2=mysql_query($sql2,$db_handle);
							$result3=mysql_query($sql3,$db_handle);
							$result4=mysql_query($sql4,$db_handle);
							
						    $friendloc0=array();$friendloc1=array();$friendloc2=array();$friendloc3=array();$friendloc4=array();
							$friendname0=array();$friendname1=array();$friendname2=array();$friendname3=array();$friendname4=array();
							$profilepic0=array();$profilepic1=array();$profilepic2=array();$profilepic3=array();$profilepic4=array();
						    $friendlocpic0=array();$friendlocpic1=array();$friendlocpic2=array();$friendlocpic3=array();$friendlocpic4=array(); 
							 while ($row=mysql_fetch_array($result0))
							{  $friendloc0[]=$row['friendLoc'];$friendname0[]=$row['friendName'];$profilepic0[]=$row['friendProfilePic'];$friendlocpic0[]=$row['friendLocPic']; }
							while ($row=mysql_fetch_array($result1))
							{  $friendloc1[]=$row['friendLoc'];$friendname1[]=$row['friendName'];$profilepic1[]=$row['friendProfilePic'];$friendlocpic1[]=$row['friendLocPic'];}
	                         while ($row=mysql_fetch_array($result2))
							{  $friendloc2[]=$row['friendLoc'];$friendname2[]=$row['friendName'];$profilepic2[]=$row['friendProfilePic'];$friendlocpic2[]=$row['friendLocPic'];}						
							while ($row=mysql_fetch_array($result3))
							{  $friendloc3[]=$row['friendLoc'];$friendname3[]=$row['friendName'];$profilepic3[]=$row['friendProfilePic'];$friendlocpic3[]=$row['friendLocPic'];}
							while ($row=mysql_fetch_array($result4))
							{  $friendloc4[]=$row['friendLoc'];$friendname4[]=$row['friendName'];$profilepic4[]=$row['friendProfilePic'];$friendlocpic4[]=$row['friendLocPic'];}
							
		
		?>		

<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Create Different Styles of Hover Effects with CSS3 Only</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>	
	<link rel="stylesheet" href="style.css" />
	<script type="text/javascript" src="http://www.queness.com/js/bsa2.js"></script>
	<style type="text/css">
		

		.item {
			text-align:center;
			float:left;
			margin:5px;
			position:relative;			
		}
		
			.item,
			.item-hover,
			.item-hover .mask,
			.item-img,
			.item-info {
				width: 250px;
				height: 100%;	
			}

			.item-hover,
			.item-hover .mask,
			.item-img { 
				position:absolute;
				top:0;
				left:0;			
			}			
		
			.item-type-line .item-hover {	
				z-index:100;	
				-webkit-transition: all 300ms ease-out;
				-moz-transition: all 300ms ease-out;
				-o-transition: all 300ms ease-out;
				transition: all 300ms ease-out;	
				opacity:0;
				cursor:pointer;						
				display:block;
				text-decoration:none;
				text-align:center;
			}
			
				.item-type-line .item-info {
					z-index:10;
					color:#ffffff;
					display:table-cell;
					vertical-align:middle;
					position:relative;
					z-index:5;				 					
				}
			
				.item-type-line .item-info .headline {
					font-size:30px;					
				}
				
				.item-type-line .item-info .line {
					 height:1px;
					 width:0%;
					 margin:15px auto;
					 background-color:#ffffff;
					-webkit-transition: all 500ms ease-out;
					-moz-transition: all 500ms ease-out;
					-o-transition: all 500ms ease-out;
					transition: all 500ms ease-out;					 

				}
				
				.item-type-line .item-info .date {
					font-size:20px;
				}
				
				.item-type-line .item-hover .mask {
					background-color:#000;
					-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
					filter: alpha(opacity=50);										
					opacity:0.5;
					z-index:0;
				}
				
				.item-type-line .item-hover:hover .line {
					width:75%;
				}
				
				.item-type-line .item-hover:hover {
					opacity:1;
				}				
			
			.item-img {			
				background-color:#7a548f;
				z-index:0;			
				
				max-height:100%;
			}
					
		
	</style>
	
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
			        speed: 5	
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
		<style>


		#circle
		{
		border-radius:50% 50% 50% 50%;  
		width:150px;
		height:150px;
		
		}
		</style>

	
	
</head>
<body>
	
	
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
						<a href="#" class="navbar-brand">Travelfriendly</a>
					</div>
					<!-- Collection of nav links, forms, and other content for toggling -->
					<div id="navbarCollapse" class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="#">Home</a></li>
							<li>																
							 <?php
							  echo '<a href="' . $_SESSION['help']->getLogoutUrl($_SESSION['session'],'http://localhost/Final/logout.php') . '">LogOut</a>';
							//echo $_SESSION['profilepic'];
							?>
							</li>
						</ul>
					</div>
				</nav>
			</div>
	
	
	
	
	
	
<div class="container-fluid">
	
		<div class="row-fluid">
			<div class="col-md-3" style="align:center;">
					<div class="row"  style="margin-bottom: 50px;">
									
					</div>
			
					<div class="row" >
						<div class="myfont" style="text-align:center;">		
							<span>WelCome</span>
											<h1><span>											
									<?php
											echo $_SESSION['username'];
											?></span></h1>
											
							<p>Superb Travel Experiece by your Facebook Friends</p>
						</div>
					</div>
			
					<hr size=30 noshade> 
					
					<div class="row" style="margin-bottom: 10px; padding-left:80px; image-align:center;">
						<div class="col-md-1"></div>
						<img src='<?php echo $_SESSION['profilepic'] ?>' id="circle"  >	
					</div>
								
			</div>

		</div>
		
		<!--Left Column top row-->
		<div class="col-md-9" style="border-left: 1px solid #9E9E9E;height: 100%;">
				
					<div class="row" >
						<div class="myfont" style="text-align:center">		
							<span>Suggestions for you</span>
							<h1>Direction =<span>Facebook Friends</span></h1>
							<p>Superb Travel Experiece by your Facebook Friends</p>
						</div>
					</div>
							
					
					
					<div class="row"  style="padding-left:10px; padding-bottom:80px; height:400px">
						<section >
								<div class="item item-type-line">
									<?php $loc = explode(",",$friendloc0[0]); 
														//print_r( $loc); 
														$sql = "select prefectureNo from prefectures where prefectureName = '$loc[1]'";
														$res = mysql_fetch_array(mysql_query($sql,$db_handle));
														//print_r($res);
														$url = "http://travel.rakuten.com/hotellist/Japan-'$loc[0]'/JP_JP-$res[0]/";
														//echo $friendloc0[0];
														?>
									<a class="item-hover" href=<?php echo $url  ?> target="_blank">
										<div class="item-info">
											<div class="headline"><?php echo $friendloc0[0];?></div>
													<div class="line"></div>
													<div class="date">Who's been here</div>
													<div class="line"></div>
													<?php foreach($profilepic0 as $pic){
													  echo '<img src="'.$pic.'"style="padding-bottom:2px;  "/>';
																	}?>
													<div class="line"></div>
													<button class="btn btn-small btn-primary" type="button"  >
															Take Tour																	
													</button>
										</div>
										<div class="mask"></div>
									</a>
									<div class="item-img" style="height: 350px; width:250px">
										<div class="image-slider" >
					
											<!-- Slideshow 1 -->
											<ul class="rslides" id="slider1" style="max-height:2500px;">
											  <?php foreach($friendlocpic0 as $pic){
													  echo '<li><img src="'.$pic.'"style="padding-bottom:2px; "/></li>  </li> <img src="images/slider2.jpg">  </li>';
																	}?>
											</ul>
											 <!-- Slideshow 2 -->
										</div>
		
									</div>
								</div>	
	
								<div class="item item-type-line">
									<?php $loc = explode(",",$friendloc1[0]); 
														//print_r( $loc); 
														$sql = "select prefectureNo from prefectures where prefectureName = '$loc[1]'";
														$res = mysql_fetch_array(mysql_query($sql,$db_handle));
														//print_r($res);
														$url = "http://travel.rakuten.com/hotellist/Japan-'$loc[0]'/JP_JP-$res[0]/";
														//echo $friendloc0[0];
														?>
									<a class="item-hover" href=<?php echo $url  ?> target="_blank">
										<div class="item-info">
											<div class="headline"><?php echo $friendloc1[0];?></div>
													<div class="line"></div>
													<div class="date">Who's been here</div>
													<div class="line"></div>
													<?php foreach($profilepic1 as $pic){
													  echo '<img src="'.$pic.'"style="padding-bottom:2px; "/>';
																	}?>
													<div class="line"></div>
													<button class="btn btn-small btn-primary" type="button"  >
															Take Tour																	
													</button>
										</div>
										<div class="mask"></div>
									</a>
									<div class="item-img" style="height: 350px; width:250px">
										<div class="image-slider" >
					
											<!-- Slideshow 1 -->
											<ul class="rslides" id="slider1">
											  <?php foreach($friendlocpic2 as $pic){
													  echo '<li><img src="'.$pic.'"style="padding-bottom:2px; "/></li>';
																	}?>
											</ul>
											 <!-- Slideshow 2 -->
										</div>
		
									</div>
								</div>	
	
								<div class="item item-type-line">
									<?php $loc = explode(",",$friendloc2[0]); 
														//print_r( $loc); 
														$sql = "select prefectureNo from prefectures where prefectureName = '$loc[1]'";
														$res = mysql_fetch_array(mysql_query($sql,$db_handle));
														//print_r($res);
														$url = "http://travel.rakuten.com/hotellist/Japan-'$loc[0]'/JP_JP-$res[0]/";
														//echo $friendloc0[0];
														?>
									<a class="item-hover" href=<?php echo $url  ?> target="_blank">
										<div class="item-info">
											<div class="headline"><?php echo $friendloc2[0];?></div>
													<div class="line"></div>
													<div class="date">Who's been here</div>
													<div class="line"></div>
													<?php foreach($profilepic2 as $pic){
													  echo '<img src="'.$pic.'"style="padding-bottom:2px; "/>';
																	}?>
													<div class="line"></div>
													<button class="btn btn-small btn-primary" type="button"  >
															Take Tour																	
													</button>
										</div>
										<div class="mask"></div>
									</a>
									<div class="item-img" style="height: 350px; width:250px">
										<div class="image-slider" >
					
											<!-- Slideshow 1 -->
											<ul class="rslides" id="slider1">
											  <?php foreach($friendlocpic0 as $pic){
													  echo '<li><img src="'.$pic.'"style="padding-bottom:2px; "/></li>';
																	}?>
											</ul>
											 <!-- Slideshow 2 -->
										</div>
		
									</div>
								</div>	
						</section>
						
					</div>


					<div class="row"  style="padding-left:10px; padding-bottom:80px;">
						</section>
								<div class="item item-type-line">
									<?php $loc = explode(",",$friendloc3[0]); 
														//print_r( $loc); 
														$sql = "select prefectureNo from prefectures where prefectureName = '$loc[1]'";
														$res = mysql_fetch_array(mysql_query($sql,$db_handle));
														//print_r($res);
														$url = "http://travel.rakuten.com/hotellist/Japan-'$loc[0]'/JP_JP-$res[0]/";
														//echo $friendloc0[0];
														?>
									<a class="item-hover" href=<?php echo $url  ?> target="_blank">
										<div class="item-info">
											<div class="headline"><?php echo $friendloc3[0];?></div>
													<div class="line"></div>
													<div class="date">Who's been here</div>
													<div class="line"></div>
													<?php foreach($profilepic3 as $pic){
													  echo '<img src="'.$pic.'"style="padding-bottom:2px; "/>';
																	}?>
													<div class="line"></div>
													<button class="btn btn-small btn-primary" type="button"  >
															Take Tour																	
													</button>
										</div>
										<div class="mask"></div>
									</a>
									<div class="item-img" style="height: 350px; width:250px">
										<div class="image-slider" >
					
											<!-- Slideshow 1 -->
											<ul class="rslides" id="slider1">
											  <?php foreach($friendlocpic0 as $pic){
													  echo '<li><img src="'.$pic.'"style="padding-bottom:2px; "/></li>';
																	}?>
											</ul>
											 <!-- Slideshow 2 -->
										</div>
		
									</div>
								</div>	
	

								<div class="item item-type-line">
									<?php $loc = explode(",",$friendloc4[0]); 
														//print_r( $loc); 
														$sql = "select prefectureNo from prefectures where prefectureName = '$loc[1]'";
														$res = mysql_fetch_array(mysql_query($sql,$db_handle));
														//print_r($res);
														$url = "http://travel.rakuten.com/hotellist/Japan-'$loc[0]'/JP_JP-$res[0]/";
														//echo $friendloc0[0];
														?>
									<a class="item-hover" href=<?php echo $url  ?> target="_blank">
										<div class="item-info">
											<div class="headline"><?php echo $friendloc4[0];?></div>
													<div class="line"></div>
													<div class="date">Who's been here</div>
													<div class="line"></div>
													<?php foreach($profilepic4 as $pic){
													  echo '<img src="'.$pic.'"style="padding-bottom:2px; "/>';
																	}?>
													<div class="line"></div>
													<button class="btn btn-small btn-primary" type="button"  >
															Take Tour																	
													</button>
										</div>
										<div class="mask"></div>
									</a>
									<div class="item-img" style="height: 350px; width:250px">
										<div class="image-slider" >
					
											<!-- Slideshow 1 -->
											<ul class="rslides" id="slider1">
											  <?php foreach($friendlocpic0 as $pic){
													  echo '<li><img src="'.$pic.'"style="padding-bottom:2px; "/></li>';
																	}?>
											</ul>
											 <!-- Slideshow 2 -->
										</div>
		
									</div>
								</div>	
	
								
		
	
	
						</section>				
					</div>
					
		</div>		
</div>	

				<div class="row-fluid">
			
					  <div class = "navbar navbar-default navbar-fixed-bottom">
               
		                        <div class = "container">
		                                <p class = "navbar-text pull-left">Copyright @2014 	TravelFriendly</p>
		                                <a href = "http://youtube.com/codersguide" class = "navbar-btn btn-danger btn pull-right">Contact Us</a>
		                        </div>
               
		                </div>
				
				</div>


</body>
</html>