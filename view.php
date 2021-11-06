<?php
session_start();
require_once "config.php";
if(!isset($_SESSION['id']))
{
    echo 'Not logged in';
    die();
}
if(isset($_GET['profile_id'])){
 $sql = "SELECT `profile_id`, `first_name`, `last_name`, `email`, `headline`, `summary` FROM `profile` WHERE profile_id = ".$_GET['profile_id'];
 
 $stmt = mysqli_prepare($conn, $sql);

 if($stmt)
 {

    if(mysqli_stmt_execute($stmt))
    {
        mysqli_stmt_store_result($stmt);
       $profile_id = $first_name = $last_name = $email = $headline = $summary = "";
        
        if(mysqli_stmt_num_rows($stmt) == 1){   
                         
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $profile_id, $first_name, $last_name, $email, $headline, $summary);  

           
            mysqli_stmt_fetch($stmt);
        }}}
    } 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
<h1>Profile information</h1>
<p>First Name:
<?php echo $first_name; ?>
</p>
<p>Last Name:
<?php echo $last_name; ?>
</p>
<p>Email:
<?php echo $email; ?>
</p>
<p>Headline:<br/>
<?php echo $headline; ?>
</p>
<p>Summary:<br/>
<?php echo $summary; ?>
</p>
</p>
<a href="index.php">Done</a>
</div>  
</body>
</html>