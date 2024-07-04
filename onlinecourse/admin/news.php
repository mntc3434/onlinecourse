<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}else{

// Code for News Insertion
if(isset($_POST['submit']))
{
$ntitle=$_POST['newstitle'];
$ndescription=$_POST['description'];
$ret=mysqli_query($con,"insert into news(newstitle,newsDescription) values('$ntitle','$ndescription')");
if($ret)
{
echo '<script>alert("News added successfully")</script>';
echo "<script>window.location.href='news.php'</script>";
}else {
echo '<script>alert("Something went wrong. Please try again.")</script>';
echo "<script>window.location.href='news.php'</script>";
}
}

//Code Deletion
if(isset($_GET['del']))
{
$nid=$_GET['id'];    
mysqli_query($con,"delete from news where id ='$nid'");
echo '<script>alert("News deleted succesfully.")</script>';
echo '<script>window.location.href=news.php</script>';
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin | News</title>
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>
    <!-- LOGO HEADER END-->
<?php if($_SESSION['alogin']!="")
{
 include('includes/menubar.php');
}
 ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container">
              <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">News  </h1>
                    </div>
                </div>
                <div class="row" >
                  <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           News 
                        </div>



                        <div class="panel-body">
                       <form name="dept" method="post">
   <div class="form-group">
    <label for="department">News Title </label>
    <input type="text" class="form-control" id="newstitle" name="newstitle" placeholder="News Title" required />
  </div>

     <div class="form-group">
    <label for="department">News description </label>
    <textarea class="form-control" id="description" name="description" placeholder="News Description" required></textarea>
  </div>
 <button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>
                            </div>
                            </div>
                    </div>
                  
                </div>
                <div class="col-md-12">
                    <!--    Bordered Table  -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Session
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>News Title</th>
                                            <th>News Description</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$sql=mysqli_query($con,"select * from news");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


                                        <tr>
                                            <td><?php echo $cnt;?></td>
                                            <td><?php echo htmlentities($row['newstitle']);?></td>
                                            <td><?php echo htmlentities($row['newsDescription']);?></td>
                                            <td><?php echo htmlentities($row['postingDate']);?></td>
                                            <td>
  <a href="news.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                            <button class="btn btn-danger">Delete</button>
</a>
                                            </td>
                                        </tr>
<?php 
$cnt++;
} ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!--  End  Bordered Table  -->
                </div>
            </div>





        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('../includes/footer.php');?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="../assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
