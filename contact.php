<?php require_once('main/top.php');?>

</head>
<body>
				<!-- 			nanbar -->
				<?php require_once('main/header.php'); ?>
				<!--------- close navbar -->
	
			<!-- 			slider -->
	<div class="jumbotron">
		<div class="container">

			<div id="details" class="animated fadeInLeft">
				<h1>Contact<span>Us</span></h1>
				<p>We are available 24X7.So Free to Contact Us</p>
			</div>
		</div>
		<img src="img/benner.jpg">
	</div>

<!-- ------------------	contain -->
	<section>
		<div class="container">
			<div class="row">
				<!-- 				LEFT SIDE CONTAIN -->
				<div class="col-md-7">
					<div class="row">
						<div class="col-md-12  mt-4">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d238132.63727384948!2d72.68220738859046!3d21.15946270544973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04e59411d1563%3A0xfe4558290938b042!2sSurat%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1566908490023!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
						</div>				
						<div class="col-md-12">	
						<form action="" class="contactform mb-5" method="post">
							<?php if(isset($_POST['submit'])){
								$name=mysqli_real_escape_string($con,$_POST['fname']);
								$email=mysqli_real_escape_string($con,$_POST['email']);
								$website=mysqli_real_escape_string($con,$_POST['website']);
								$comment=mysqli_real_escape_string($con,$_POST['massages']);

								$to="shantigupta2105@gmail.com";
								$header="From: $name<$email>";
								$subject="Message From $name";

								$message="<b>Name:</b> $name <br><b>Email:</b> $email <br><b>Website:</b> $website <br><b>comment:</b> $comment";

								if(empty($name) or empty($email) or empty($comment)){
									$error="All(*) Fields Are Required";
								}else{
									if(mail($to, $subject, $message,$header)){
										$msg="Message Has Been sent";
									}else{
										$error="Message Has Not Been sent";
									}
								}
							} ?>
							<h2>Contact form</h2>
							<div class="form-group">
								<label for="f_name">Full Name*</label>
								<?php 
									if(isset($error)){
										echo "<span class='pull-right' style='color:red'>$error</span>";
									}else if(isset($msg)){
										echo "<span class='pull-right' style='color:green'>$msg</span>";
									}
								?>
								<input type="text" name="fname" id="name" class="form-control" placeholder="Full Name">
							</div>
							<div class="form-group">
								<label for="email">Email*</label>
								<input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
							</div>
							<div class="form-group">
								<label for="webside">Website</label>
								<input type="text" name="website" id="website" class="form-control" placeholder="Website">
							</div>
							<div class="form-group">
								<label for="msg">Massages</label>
								<textarea name="massages" id="msg" class="form-control" cols="30" rows="8" placeholder="massages"></textarea>
							</div>
							<div class="form-group">
								<input type="submit" name="submit" value="submit" class="btn btn-primary">
							</div >
						</form>
							
						</div>		
					</div>				
				</div><!-- left side CLOSE -->







				<!-- 		RIGHT SIDE CONTAIN -->
				<div class="col-md-5">
					<?php require_once('main/sideber.php') ?>
				</div><!--  CLOSE -->
				
			</div>
		</div>
	</section>



	<footer>
			<h5 class="bg-dark">Copyright &copy; by <a href="">Jwalaprasad Gupta</a>All Right Reserved from 2018-<?php echo date('Y');?></h5>
	</footer>

	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>