<?php

session_start();
error_reporting(0);
include('config.php');
if(!isset($_SESSION['email'])){
	header('Location:index.php');
}
$email=$_SESSION['email'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Student Attendance System</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/achievements.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="assets/css/news-events-tabs.css">
		<link rel="stylesheet" type="text/css" href="assets/css/swiper.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/modal.css">

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" integrity="sha384-KA6wR/X5RY4zFAHpv/CnoG2UW1uogYfdnP67Uv7eULvTveboZJg0qUpmJZb5VqzN" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	    <link rel="stylesheet" type="text/css" href="assets/css/social_media.css">
	    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	  	<link href="https://fonts.googleapis.com/css?family=Hind+Siliguri" rel="stylesheet">
	  	<link rel="stylesheet" type="text/css" href="assets/css/blog.css">
	</head>
	<body class="subpage">

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.php" class="logo">SAS</a>
					<nav id="nav">
						<a href="index.php">Home</a>
						<a href="#">Welcome <?php echo $email; ?></a>
						<a href="logout.php">Logout</a>
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header><br/>

			<!--================= Section A Table =================-->
			<form method="post" action="">
			<div class="form-group row">
  				<label for="today" class="col-2 col-form-label">Date</label>
  				<div class="col-10">
    				<input class="form-control" type="Date" id="today" name="today">
  				</div>
			</div>
			<input type="submit" name="sdate" class="btn btn-primary">
		</form>
		<?php
				if($_SERVER["REQUEST_METHOD"]=="POST"){

					if ($_POST['sdate'])
					{
						$con=mysqli_connect("localhost","root","","attendance") or die(mysqli_error($con));
						$today=$_POST["today"];
						$today=str_replace('-','_',$today);
						$_SESSION["sdate"]=$today;
						$dquery="ALTER TABLE sec_b ADD $today VARCHAR(30)";
						$duplicate_result=mysqli_query($con,$dquery) or die(mysqli_error($con));
				   }

				   elseif($_POST['present']){
				   	$rno=$_POST['present'];
				   	$sdate=$_SESSION["sdate"];
				   	$dquery="UPDATE sec_b SET $sdate='P' WHERE regd_no=$rno";
					$dresult=mysqli_query($con,$dquery) or die(mysqli_error($con));
				   	
				   }
				   elseif($_POST['absent']){
				   	$rno=$_POST['absent'];
				   	$sdate=$_SESSION["sdate"];
				   	$dquery="UPDATE sec_b SET $sdate='A' WHERE regd_no=$rno";
					$dresult=mysqli_query($con,$dquery) or die(mysqli_error($con));
				   	
				   }

			}


				$query = "SELECT * FROM sec_b"; //You don't need a ; like you do in SQL
				$result = mysqli_query($con,$query) or die(mysqli_error($con));

				echo "<table>"; // start a table tag in the HTML
				echo "<th>Name</th><th>Present</th><th>Absent</th>";
				while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through results
				echo '<tr><td>'. $row['name'] . '</td><td><form method="POST" action=""><input style="border:4px solid green;" type="submit" name="present" value="'.$row['regd_no'].'"></form></td><td><form method="POST" action=""><input style="border:4px solid red;" type="submit" name="absent" value="'.$row['regd_no'].'"></form></td></tr>'; 
				}

				echo "</table>"; //Close the table in HTML

				?>








































			<!--==================== Footer ========================-->
			<footer id="footer">
				<div class="inner">
					<div class="flex">
						<div class="copyright">
							&copy; Untitled. Design: <a href="https://templated.co">TEMPLATED</a>. Images: <a href="https://unsplash.com">Unsplash</a>.
						</div>
						<ul class="icons">
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-linkedin"><span class="label">linkedIn</span></a></li>
							<li><a href="#" class="icon fa-pinterest-p"><span class="label">Pinterest</span></a></li>
							<li><a href="#" class="icon fa-vimeo"><span class="label">Vimeo</span></a></li>
						</ul>
					</div>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>