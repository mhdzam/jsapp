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
          
           if(isset($_POST["first_name"])){
            $first_name = htmlentities(($_POST["first_name"]));
            $last_name = htmlentities($_POST["last_name"]);
            $email = htmlentities($_POST["email"]);
            $headline = htmlentities($_POST["headline"]);
            $summary = htmlentities($_POST["summary"]);
            $user_id = htmlentities($_SESSION["id"]);
            
           

             $sql = "UPDATE `profile` SET `first_name`='".$_POST['first_name']."',`last_name`='".$_POST['last_name']."',`email`='".$_POST['email']."',`headline`='".$_POST['headline']."',`summary`='".$_POST['summary']."' WHERE profile_id=".$_POST['profile_id'];
                 
             $stmt = mysqli_prepare($conn, $sql);
            
           
             if($stmt)
             {
            
                if(mysqli_stmt_execute($stmt))
                {
                    mysqli_stmt_store_result($stmt);
            
                    
                    $_SESSION['message'] = "Profile Updated !";
                        header("location: index.php");
             
                }
             
}
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mohammed Alzamil</title>
</head>
<body>
    
<div class="container">
<h1>Editing Profile for UMSI</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
<p>First Name:
<input type="text" name="first_name" size="60"
value="<?php echo $first_name; ?>"
/></p>
<p>Last Name:
<input type="text" name="last_name" size="60"
value="<?php echo $last_name; ?>"
/></p>
<p>Email:
<input type="text" name="email" size="30"
value="<?php echo $email; ?>"
/></p>
<p>Headline:<br/>
<input type="text" name="headline" size="80"
value="<?php echo $headline; ?>"
/></p>
<p>Summary:<br/>
<textarea name="summary" rows="8" cols="80">
<?php echo $summary; ?></textarea>
<p>
<input type="hidden" name="profile_id"
value="<?php echo $profile_id; ?>"
/>
<input type="submit" value="Save">
<input type="submit" name="cancel" value="Cancel">
</p>
</form>
</div>
</body>
</html>