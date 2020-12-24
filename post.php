<?php require_once('main/top.php');?>

</head>
<body>
				<!-- 			nanbar -->
		<?php require_once('main/header.php'); ?>
				<!--------- close navbar -->
		<?php
			if(isset($_GET['post_id'])){
				$post_id=$_GET['post_id'];
				$view_query="UPDATE `posts` SET `views` = views+1 WHERE `posts`.`id` = $post_id;";
				mysqli_query($con,$view_query);
				$query="select * from posts where status = 'publish' and id= $post_id";	
			
				$res=mysqli_query($con,$query);
				if(mysqli_num_rows($res) > 0){
					$row=mysqli_fetch_array($res);
						$id=$row['id'];
						$date=getdate($row['date']);
						$day=$date['mday'];
						$month=$date['month'];
						$year=$date['year'];
						$title=$row['title'];
						$author=$row['author'];
						$author_img=$row['author_img'];
						$img=$row['image'];
						$categories=$row['categories'];
						$teg=$row['tegs'];
						$post_data=$row['post_data'];
						$view=$row['views'];
						$status=$row['status'];


			}

			else{
				header('location:index.php');
			}
		}

		  ?>
		
			<!-- 			slider -->
	<div class="jumbotron">
		<div class="container">

			<div id="details" class="animated fadeInLeft">
				<h1>Custom<span>Post</span></h1>
				<p>Here you can put your own tag line to make it more at</p>
			</div>
		</div>
		<img src="img/benner.jpg">
	</div>

<!-- ------------------	contain -->
	<section>
		<div class="container ">
			<div class="row">
				<!-- 				LEFT SIDE CONTAIN -->
				<div class="col-md-7">
					<div class="post">
					<div class="row">
						<div class="col-lg-2 post_date">
							<div class="day"><?php echo $day; ?></div>
							<div class="month"><?php echo $month; ?></div>
							<div class="year"><?php echo $year ?></div>
						</div>
						<div class="col-lg-8 post_title">
							<a href="post.php?post_id=<?php echo $id; ?>"><h5><?php echo $title; ?></h5></a>
							<p>Written by:<span><?php echo $author; ?></span></p>
						</div>
						<div class="col-lg-2 profile_pic">
							<img src="admin/img/<?php echo $author_img; ?>">
						</div>
					</div>
					<a href="img/<?php echo $img;?>"><img src="img/<?php echo $img; ?>" alt="post img"></a>
					<p><?php echo $post_data; ?></p>
					
					<div class="button">
						<span class="first"><i class="fa fa-folder"></i><a href="#"> <?php echo ucfirst($categories); ?></a></span> |
						<span class="second"><i class="fa fa-comment"></i><a href="#"> Comment</a></span>

					</div>
				</div><!--  post close -->

				<div class="reletive">  <!--     reletive post -->
					<h2>Reletive Post</h2>
					<hr>
				<div class="row">
					<?php
					$r_query="select * from posts where status= 'publish' and title like '%$title%' limit 3";
					$r_res=mysqli_query($con,$r_query);
					while($row=mysqli_fetch_array($r_res)){
					$r_id=$row['id'];
					$r_img=$row['image'];
					$r_title=$row['title'];
					
					 ?>
					<div class="col-md-4">
						<a href="post.php?post_id=<?php echo $r_id; ?>">
							<img src="img/<?php echo $r_img; ?>">
							<h3><?php echo $r_title; ?></h3>
						</a>
					</div>
				<?php } ?>
				</div>	
			</div>  <!-- colse reletive post -->
			<!-- 			auther post -->

			<div class="auther">
					<h2 class="authername">Auther Post</h2>
				<hr>
			<div class="row">

				<div class="col-md-4 col-sm-6 ">
					<img src="img/<?php echo $author_img; ?>" alt="images" style="width: 60%; border-radius: -40%;" >
				</div>
				<div class="col-md-8 ">
					<h2><?php echo $author; ?></h2>
					<?php
					$bio_query="select * from users where username = '$author'";
					$bio_run=mysqli_query($con,$bio_query);
					if(mysqli_num_rows($bio_run)>0){
						$bio_row=mysqli_fetch_array($bio_run);
						$auther_details=$bio_row['details'];

					 
					?>
					<p><?php echo $auther_details; ?></p>
					<?php
					} 
					?>
				</div>
			</div>
			</div> <!--  close auther post -->

			<?php 
				$c_query="select * from comments where status = 'approve' and post_id=$post_id order by id desc";
				$c_res=mysqli_query($con,$c_query);
				if(mysqli_num_rows($c_res)>0){
					
			?>
			<div class="comment">
				<h2>Comments</h2>
				<?php
				 while ($c_row=mysqli_fetch_array($c_res)) {
						$c_id=$c_row['id'];
						$c_name=$c_row['name'];
						$c_username=$c_row['username'];
						$c_image=$c_row['image'];
						$c_comment=$c_row['comment'];
					

				?>
				 
				<hr>
				<div class="row">
					<div class="col-md-3">
						<img src="admin/img/<?php echo $c_image; ?>" alt="profilepic" style="width: 80%; height: 100px; border-radius: 50px;">
					</div>
					<div class="col-md-9">
						<h4><?php echo ucfirst($c_name); ?></h4>
						<p><?php echo $c_comment; ?></p>
					</div>
				</div>
				<?php } ?>
								
			</div>
		<?php } ?>
		<?php 
			if(isset($_POST['submit'])){
				$cs_name=$_POST['fname'];
				$cs_email=$_POST['email'];
				$cs_website=$_POST['webside'];
				$cs_comments=$_POST['comments'];
				$cs_date=time();

				if(empty($cs_name) or empty($cs_email) or empty($cs_comments)){
					$errmeg="All (*) feilds are required";
				}
				else{
					$cs_query="INSERT INTO `comments` (`id`, `date`, `name`, `username`, `post_id`, `email`, `website`, `image`, `comment`, `status`) VALUES (NULL, '$cs_date', '$cs_name', 'user', '$post_id', '$cs_email', '$cs_website', 'comment.jpg', '$cs_comments', 'pedding')";
	
						if(mysqli_query($con,$cs_query)){
						$msg="comment submited and waiting for approve";
						$cs_name="";
						$cs_email="";
						$cs_website="";
						$cs_comments="";
						
					}
					else{
						$errmeg="comment has not be submit";
					}
				}
				
			}
		?>


			<div class="commentform">
				<div class="row">
					<div class="col-md-12">
						<form action="" method="post">
							<div class="form-group">
								<label>Full Name*</label>
								<input type="text" name="fname" value="<?php if(isset($cs_name)){ echo $cs_name;}?>" class="form-control" placeholder="Full Name">
							</div>
							<div class="form-group">
								<label>Email*</label>
								<input type="text" name="email" value="<?php if(isset($cs_email)){ echo $cs_email;}?>" class="form-control" placeholder="Email">
							</div>
							<div class="form-group">
								<label>Webside</label>
								<input type="text" name="webside" class="form-control" value="<?php if(isset($cs_website)){ echo $cs_website;}?>" placeholder="Webside">
							</div>
							<div class="form-group">
								<label>comment*</label>
								<textarea name="comments" class="form-control" cols="30" rows="10" placeholder="your commnet Should be here"><?php if(isset($cs_comments)){ echo $cs_comments;}?></textarea>
							</div>
							<div class="form-group">
								<input type="submit" name="submit" value="submit value"  class=" btn btn-primary">
								<?php 
								 if(isset($errmeg)){
								 	echo "<span style='color:red;'>$errmeg</span>";
								 }
								 else if(isset($msg)){
								 	echo "<span style='color:green;'>$msg</span>";	
								 }
								?>
							</div>


						</form>
					</div>
					
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