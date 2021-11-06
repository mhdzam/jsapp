<?php

session_start();
if(!isset($_SESSION['id']))
{
    echo 'Not logged in';
    die();
}
require_once "config.php";
if(isset($_GET['profile_id'])){
$sql = "SELECT `first_name`, `last_name` FROM `profile` WHERE profile_id = ".$_GET['profile_id'];
$stmt = mysqli_prepare($conn, $sql);

if($stmt)
{

   if(mysqli_stmt_execute($stmt))
   {
       mysqli_stmt_store_result($stmt);
      $first_name = $last_name = "";
       
       if(mysqli_stmt_num_rows($stmt) == 1){   
                        
           // Bind result variables
           mysqli_stmt_bind_result($stmt, $first_name, $last_name);  

          
           mysqli_stmt_fetch($stmt);
       }}}
    }

if(isset($_POST['profile_id'])){
 $sql = "DELETE FROM `profile`  WHERE profile_id = ".$_POST['profile_id'];

 $stmt = mysqli_prepare($conn, $sql);

 if($stmt)
 {

    if(mysqli_stmt_execute($stmt))
    {
        mysqli_stmt_store_result($stmt);
       $profile_id = $first_name = $last_name = $email = $headline = $summary = "";
       $_SESSION['message'] = "Profile Deleted !";
       header("location: index.php");
        if(mysqli_stmt_num_rows($stmt) == 1){   
                         
            // Bind result variables
          /*   mysqli_stmt_bind_result($stmt, $profile_id, $first_name, $last_name, $email, $headline, $summary);  

           
            mysqli_stmt_fetch($stmt); */
         
          
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
<h1>Deleteing Profile</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<p>First Name:
<?php echo $first_name; ?></p>
<p>Last Name:
<?php echo $last_name; ?></p>
<input type="hidden" name="profile_id"
value="<?php echo $_GET['profile_id']; ?>"
/>
<input type="submit" name="delete" value="Delete">
<input type="submit" name="cancel" value="Cancel">
</p>
</form>
</div>
</body>
</html>