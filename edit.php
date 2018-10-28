<?php
session_start();
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	

	$id = mysqli_real_escape_string($mysqli, $_POST['id']);
	
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$phone = mysqli_real_escape_string($mysqli, $_POST['phone']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);	
	$country = mysqli_real_escape_string($mysqli, $_POST['country']);
	$mdate = mysqli_real_escape_string($mysqli, $_POST['mdate']);
	$gender = mysqli_real_escape_string($mysqli, $_POST['gender']);	
	$book = mysqli_real_escape_string($mysqli, $_POST['book']);
	$message = mysqli_real_escape_string($mysqli, $_POST['message']);

	// checking empty fields
	if(empty($name) || empty($age) || empty($email)) {	
			
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($country)) {
			echo "<font color='red'>Country field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}		
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE lib_user SET name='$name',gender='$gender',email='$email',country='$country',mdate='$mdate',phone='$phone',book='$book',message='$message' WHERE id=$id");
		
		//redirectig to the display page. In our case, it is admin.php
		header("Location: table.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM lib_user WHERE id=$id");
$my_result = mysqli_query($mysqli, "SELECT book FROM books ORDER BY id DESC");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$gender = $res['gender'];
	$email = $res['email'];
	$phone = $res['phone'];
	$mdate = $res['mdate'];
	$country = $res['country'];
	$book = $res['book'];
	$message = $res['message'];
	
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>kwara State University</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link href="vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
    <link href="vendors/select/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendors/tags/css/bootstrap-tags.css" rel="stylesheet">

    <link href="css/forms.css" rel="stylesheet">

    
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.php">Kwara State University, Library</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	                <div class="col-lg-12">
	                  <div class="input-group form">
	                       <input type="text" class="form-control" placeholder="Search...">
	                       <span class="input-group-btn">
	                         <button class="btn btn-primary" type="button">Search</button>
	                       </span>
	                  </div>
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo htmlspecialchars($_SESSION["username"]); ?><b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="#">Profile</a></li>
	                          <li><a href="logout.php">Logout</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="calendar.html"><i class="glyphicon glyphicon-calendar"></i> Calendar</a></li>
                    
                    <li><a href="tables.php"><i class="glyphicon glyphicon-list"></i> Registered Visitors</a></li>
                    
                    <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Pages
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="logout.php">Logout</a></li>
                            <li><a href="signup.php">Signup</a></li>
                        </ul>
                    </li>
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">

	  			<div class="row">
	  				<div class="col-md-6">
	  					<div class="content-box-large">
			  				<div class="panel-heading">
					            <div class="panel-title">Edit</div>
					          
					            <div class="panel-options">
					              <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
					              <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
					            </div>
					        </div>
			  				<div class="panel-body">
			  					<form class="form-horizontal" role="form" name="form1" method="post" action="edit.php">
								  <div class="form-group">
								    <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control" name="name" value="<?php echo $name;?>" placeholder="Name">
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="inputPassword3" class="col-sm-2 control-label">Gender</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control"  name="gender" value="<?php echo $gender;?>" placeholder="gender">
								    </div>
								  </div>

                                   <div class="form-group">
								    <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
								    <div class="col-sm-10">
								      <input type="email" class="form-control"  name="email" value="<?php echo $email;?>" placeholder="email">
								    </div>
								  </div>

								   <div class="form-group">
								    <label for="inputPassword3" class="col-sm-2 control-label">Phone</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control"  name="phone" value="<?php echo $phone;?>" placeholder="Phone">
								    </div>
								  </div>

								   <div class="form-group">
								    <label for="inputPassword3" class="col-sm-2 control-label">Country</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control"  name="country" value="<?php echo $country;?>" placeholder="Country">
								    </div>
								  </div>

								   <div class="form-group">
								    <label for="inputPassword3" class="col-sm-2 control-label">Date</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control"  name="mdate" value="<?php echo $mdate;?>" placeholder="Date">
								    </div>
								  </div>
								  
								  <div class="form-group">
								    <label for="inputPassword3" class="col-sm-2 control-label">Book</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control"  name="book" value="<?php echo $book;?>" placeholder="Country">
								    </div>
								  </div>

								  <div class="form-group">
								    <label class="col-sm-2 control-label">Message</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control" name="message" value="<?php echo $message;?>" placeholder="message">
								    </div>
								  </div>
								  
								 
								  <div class="form-group">
								    <div class="col-sm-offset-2 col-sm-10">
								      <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
				<input class="btn btn-primary" type="submit" name="update" value="Update">
								    </div>
								  </div>
								  
								</form>
			  				</div>
			  			</div>
	  				</div>
	  			
	  			</div>

	  		<!--  Page content -->
		  </div>
		</div>
    </div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2014 <a href='#'>Website</a>
            </div>
            
         </div>
      </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <script src="vendors/form-helpers/js/bootstrap-formhelpers.min.js"></script>

    <script src="vendors/select/bootstrap-select.min.js"></script>

    <script src="vendors/tags/js/bootstrap-tags.min.js"></script>

    <script src="vendors/mask/jquery.maskedinput.min.js"></script>

    <script src="vendors/moment/moment.min.js"></script>

    <script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

     <!-- bootstrap-datetimepicker -->
     <link href="vendors/bootstrap-datetimepicker/datetimepicker.css" rel="stylesheet">
     <script src="vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script> 


    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <script src="js/custom.js"></script>
    <script src="js/forms.js"></script>
  </body>
</html>