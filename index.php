
<?php
 require_once('main/top.php');?>
</head>

<body>
				<!-- 			nanbar -->
	<?php require_once('main/header.php');

	$number_of_post=2;

	if(isset($_GET['page'])){
		$pages_id=$_GET['page'];
	}
	else{
		$pages_id=1;
	}

	if(isset($_GET['cat'])){
		$cat_id=$_GET['cat'];
		$cat_query="select * from categori where id = $cat_id";
		$cat_run=mysqli_query($con,$cat_query);
		$cat_row=mysqli_fetch_array($cat_run);
		$cat_name=$cat_row['categori'];
	}

	if(isset($_POST['search'])){
		$search=$_POST['search-title'];
		$all_post_query="select * from posts where status='publish'";
		$all_post_query.="and tegs like '%$search%'";
		$all_post_run=mysqli_query($con,$all_post_query);
		$all_post=mysqli_num_rows($all_post_run);
		$total_pages=ceil($all_post / $number_of_post);
		$post_start_from=($pages_id - 1) * $number_of_post;

	}
	else
	{
	$all_post_query="select * from posts where status='publish'";
	if(isset($cat_name)){
		$all_post_query.="and categories='$cat_name'";
	}
	$all_post_run=mysqli_query($con,$all_post_query);
	$all_post=mysqli_num_rows($all_post_run);
	$total_pages=ceil($all_post / $number_of_post);
	$post_start_from=($pages_id - 1) * $number_of_post;

	}
	

	?>

				<!--------- close navbar -->
	
			<!-- 			slider -->
	<div class="jumbotron">
		<div class="container">

			<div id="details" class="animated fadeInLeft">
				<h1>Baber786<span>Blog</span></h1>
				<p>This is an Online Tutorial Huge Portal.So now Shine With us</p>
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
					<?php
					$silder_query="select * from posts where status = 'publish' order by id desc limit 3"; 
					$silder_run=mysqli_query($con,$silder_query);
					if(mysqli_num_rows($silder_run)>0){
						$count=mysqli_num_rows($silder_run);	
						
					?>
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					  <ol class="carousel-indicators">
					  	<?php
					  		for($i=0; $i<$count; $i++){
					  		if($i==0){
					  			echo "<li data-target='#carouselExampleIndicators' data-slide-to='".$i."' class='active bg-primary'></li>";
					  		
					  		}
					  		else
					  		{
					  				echo "<li data-target='#carouselExampleIndicators' data-slide-to='".$i."' class='bg-primary'></li>";
					  		}
					  	}
					  	 ?>

					  </ol>
					  <div class="carousel-inner">
					  	<?php 
					  			$check=0;

					  		while ($silder_row=mysqli_fetch_array($silder_run)) {
					  			$silder_id=$silder_row['id'];
					  			$silder_img=$silder_row['image'];
					  			$silder_title=$silder_row['title'];
					  			$check=$check+1;
					  			if($check==1){
					  				echo "<div class='carousel-item active'>";
					  			}
					  			else
					  			{
					  				echo "<div class='carousel-item '>"	;
					  			}
					  		
					  	?>
					      <a href="post.php?post_id=<?php echo $silder_id; ?>"><img src="img/<?php echo $silder_img; ?>" class="d-block w-100" height="300px;"></a>
					      <div class="carousel-caption">
					      		<h5><?php echo $silder_title; ?></h5>
					  	  </div>
					  </div>
						<?php } ?>
	 				</div>

					  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					    <span class="carousel-control-prev-icon bg-primary" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					    <span class="carousel-control-next-icon bg-primary" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>
					

										
				<?php
				}
				
				if(isset($_POST['search'])){
					$search=$_POST['search-title'];
					$query="select * from posts where status = 'publish'";
					$query.="and tegs like '%$search%'";
					$query.= "order by id desc limit $post_start_from, $number_of_post";
				
				}
				else{
				$query="select * from posts where status = 'publish'";	
				if(isset($cat_name)){
					$query.="and categories='$cat_name'";
				}
				$query.= "order by id desc limit $post_start_from, $number_of_post";
				
				}
				$res=mysqli_query($con,$query);
				if(mysqli_num_rows($res) > 0){
					while($row=mysqli_fetch_array($res)) {
						$id=$row['id'];
						$date=getdate($row['date']);
						$day=$date['mday'];
						$month=$date['month'];
						$year=$date['year'];
						$title=$row['title'];
						$author=$row['author'];
						$author_img=$row['author_img'];
						$img=$row['image'];
						$cate=$row['categories'];
						$teg=$row['tegs'];
						$post_data=$row['post_data'];
						$view=$row['views'];
						$status=$row['status'];

				?>		
				<div class="post">
					<div class="row">
						<div class="col-lg-2 post_date">
							<div class="day"><?php echo $day; ?></div>
							<div class="month"><?php echo $month; ?></div>
							<div class="year"><?php echo $year; ?></div>
						</div>
						<div class="col-lg-8 post_title">
							<a href="post.php?post_id=<?php echo $id; ?>"><h5><?php echo $title ?></h5></a>
							<p>Written by:<span><?php echo ucfirst($author) ?></span></p>
						</div>
						<div class="col-lg-2 profile_pic">
							<img src="admin/img/<?php echo $author_img; ?>">
						</div>
					</div>

					<a href="post.php?post_id=<?php echo $id; ?>"><img src="img/<?php echo $img; ?>" alt="post img"></a>
					<div><?php echo substr($post_data,0,300)."......."; ?></div>
					<a href="post.php?post_id=<?php echo $id; ?>" class="btn btn-info">Read more..</a>
					<div class="button">
						<span class="first"><i class="fa fa-folder"></i><a href="#"><?php echo $cate ?></a></span> |
						<span class="second"><i class="fa fa-comment"></i><a href="#"> Comment</a></span>

					</div>

				</div><!--  post close -->

				<?php 

					}
				}
				else
				{
					echo "<h2 class='text-center'>no post Available</h2>";
				}
				?>
			
			<nav aria-label="Page navigation example" class="nav">
				  <ul class="pagination">
				  	<?php
				  		for($i=1; $i<=$total_pages; $i++){
				  			echo "<li class='".($pages_id == $i ? 'active' : '')."'><a class='page-link' href='index.php?page=".$i."&".(isset($cat_name)?"cat=$cat_id":"")."'>$i</a></li> ";
				  		}
				  	 ?>
				    </ul>
				</nav>
			</div>
					
				
				

				<!-- 		RIGHT SIDE bar CONTAIN -->
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