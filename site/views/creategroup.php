<?php
session_start();
if (!isset($_SESSION['user_id'])) {
	header('Location: ./login.php?id=4');
	exit();
}
?>


<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Create group page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" type="test/css" href="css/style.css">
	<style>

        <?php $theme = $_SESSION['user_theme']; ?>
       
        body{
           background-image: url("../assets/images/themes/<?php echo $theme; ?>.jpg");
		   background-size: 15%;
        }
        
        </style>
</head>

<body >

  
	<div class="card mx-auto mt-5" style="width: 18rem;">
  
		<div class="card-body mb-3 mt-2">
    <form action="creategroup2.php" method = "POST">
			<h5 class="card-title">Creating Groups</h5>

			<label for="exampleFormControlInput1" class="form-label">Name of Group</label>
			<input name="grpname" type="text" class="form-control" id="exampleFormControlInput1" minlength = "3" maxlength = "50" required>


			<label for="exampleFormControlTextarea1" class="form-label; float: left;">Bio</label>
			<textarea name="grpbio" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
			<a href="home.php" class="btn btn-primary mt-3 "
				style="background-color: rgb(108, 2, 119); border-color: rgb(108, 2, 119);">Return</a>
			<button  class="btn btn-primary mt-3" type="submit"
				style="float: right; background-color: rgb(108, 2, 119); border-color: rgb(108, 2, 119); ">Continue</button>
        </form>
      </div>
    

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
			crossorigin="anonymous"></script>
</body>

</html>
