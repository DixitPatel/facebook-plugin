<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <title>Suggestions</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Direction-Aware Hover Effect with CSS3 and jQuery" />
        <meta name="keywords" content="hover, css3, jquery, effect, direction, aware, depending, thumbnails" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
		<link href='http://fonts.googleapis.com/css?family=Alegreya+SC:700,400italic' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script src="js/modernizr.custom.97074.js"></script>
        <noscript><link rel="stylesheet" type="text/css" href="css/noJS.css"/></noscript>
		
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
						<a href="#" class="navbar-brand">Brand</a>
					</div>
					<!-- Collection of nav links, forms, and other content for toggling -->
					<div id="navbarCollapse" class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li class="active"><a href="#">Home</a></li>
							<li><a href="#">Profile</a></li>
							<li class="dropdown">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">Messages <b class="caret"></b></a>
								<ul role="menu" class="dropdown-menu">
									<li><a href="#">Inbox</a></li>
									<li><a href="#">Drafts</a></li>
									<li><a href="#">Sent Items</a></li>
									<li class="divider"></li>
									<li><a href="#">Trash</a></li>
								</ul>
							</li>
					
							<li><a href="#">Login</a></li>
						</ul>
					</div>
				</nav>
			</div>
	
	
        <div class="container1">
			 <div class="row">
					<div class="col-md-31 no-float">
						
									
						
					</div>
					
						<div class="col-md-91 no-float">
		
							<?php
									// 1. Enter Database details
									$dbhost = 'localhost';
									$dbuser = 'root';
									$dbpass = 'nitin';
									$dbname = 'images';

									// 2. Create a database connection
									$connection = mysql_connect($dbhost,$dbuser,$dbpass);
									if (!$connection) {
										die("Database connection failed: " . mysql_error());
									}

									// 3. Select a database to use 
									$db_select = mysql_select_db($dbname,$connection);
									if (!$db_select) {
										die("Database selection failed: " . mysql_error());
									}

									$query = mysql_query("SELECT * FROM image");
									
									$rows = mysql_fetch_array($query);
							?>		
							<section>
								<ul id="da-thumbs" class="da-thumbs">
									<li>
										<a href="http://dribbble.com/shots/505046-Menu">
											<?php
											$query1 = mysql_query("SELECT path FROM image WHERE imageId='1'");
											
											$row = mysql_fetch_array( $query1 );
											
											$img=$row['path'];
											echo "<img src='$img' >";
											
											?>

											<div><span>Menu by Simon Jensen</span></div>
										</a>
									</li>
									<li>
										<a href="http://dribbble.com/shots/504336-TN-Aquarium">
											<img src="images/one.png" />
												<div >
												<img src="images/logo1.png" />
												<span>TN Aquarium by Charlie Gann</span>
												</div>
										</a>
									</li>
									<li>
										<a href="http://dribbble.com/shots/504197-Mr-Crabs">
											<img src="images/one.png" />
											<div><span>Mr. Crabs by John Generalov</span></div>
										</a>
									</li>
									<li>
										<a href="http://dribbble.com/shots/503731-Gallery-of-Mo-2-Mo-logo">
											<img src="images/one.png" />
											<div><span>Gallery of Mo 2.Mo logo by Adam Campion</span></div>
										</a>
									</li>
									<li>	
										<a href="http://dribbble.com/shots/503058-Ice-Cream-nom-nom">
											<img src="images/one.png" />
											<div><span>Ice Cream - nom nom by Eight Hour Day</span></div>
										</a>
									</li>
									<li>
										<a href="http://dribbble.com/shots/502927-My-Muse">
											<img src="images/one.png" />
											<div><span>My Muse by Zachary Horst</span></div>
										</a>
									</li>
					
								</ul>
							</section>
						</div>
						<div class="col-md-31 no-float">Navigation</div>
				</div><!--end of row-->		
        </div>
		
		<div class="container1">
			
			  <div class = "navbar navbar-default navbar-fixed-bottom">
               
                        <div class = "container">
                                <p class = "navbar-text pull-left">Copyright @2014 	TravelFriendly</p>
                                <a href = "http://youtube.com/codersguide" class = "navbar-btn btn-danger btn pull-right">Contact Us</a>
                        </div>
               
                </div>
				
		</div>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.hoverdir.js"></script>	
		<script type="text/javascript">
			$(function() {
			
				$(' #da-thumbs > li ').each( function() { $(this).hoverdir(); } );

			});
		</script>
    </body>
</html>