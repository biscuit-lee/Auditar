
<!DOCTYPE html>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
	
	<!-- stylesheet för ikons-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	
</head>


<body>
	<!-- först navbar-->

	<div class="row justify-content-center m-4">
		<h1 class="logo"> LOGO </h1>
	</div>
	
	<!-- andra navbar-->
	<div class="container-fluid">
		<div class="row">
			<!-- login drop down -->
			<div class="col-md-12 bg-light text-right">
				<div class="dropdown">
				  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span i class="material-icons" style="font-size:28px;">account_circle </i></span> 
				  </button>
				  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" href="login/register.php">Register</a>
					<a class="dropdown-item" href="login/login.php">Login</a>
				  </div>
				</div>
			</div>
			
			
			<div class="col-md-12 bg-light text-left">
				
			</div>
			
			
		</div>
	</div>

	<!-- först content -->
	<div class="container-fluid ">
		<img src="Images\loginIcon" alt="Guitar 1">
		<h1> Guitar 1 </h1>
	</div>
	
	<div class="container-fluid content1">
		
		<h1> Guitar 2 </h1>
	</div>
	
	
	<div class="container-fluid content1">
		
		<h1> Guitar 3 </h1>
	</div>
	
	
</body>
</html>
