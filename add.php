<?php
session_start();
if(!isset($_SESSION['id']))
{
    echo 'Not logged in';
    die();
}
require_once "config.php";
if(isset($_POST["first_name"])){
$first_name =htmlentities(trim($_POST["first_name"]));
$last_name = htmlentities($_POST["last_name"]);
$email = htmlentities($_POST["email"]);
$headline = htmlentities($_POST["headline"]);
$summary = htmlentities($_POST["summary"]);
$user_id = htmlentities($_SESSION["id"]);

 $sql = "INSERT INTO `profile`(`user_id`, `first_name`, `last_name`, `email`, `headline`, `summary`) VALUES ('".$_SESSION["id"]."','".$_POST["first_name"]."','".$_POST["last_name"]."','".$email."','".$headline."','".$summary."')";
     
 $stmt = mysqli_prepare($conn, $sql);

 if($stmt)
 {

    if(mysqli_stmt_execute($stmt))
    {
        mysqli_stmt_store_result($stmt);

        
        $_SESSION['message'] = "Profile Added !";
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
    <title>Document</title>
</head>
<body>
<div class="container">
<h1>Adding Profile for UMSI</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post">
<p>First Name:
<input type="text" name="first_name" size="60"/></p>
<p>Last Name:
<input type="text" name="last_name" size="60"/></p>
<p>Email:
<input type="text" name="email" size="30"/></p>
<p>Headline:<br/>
<input type="text" name="headline" size="80"/></p>
<p>Summary:<br/>
<textarea name="summary" rows="8" cols="80"></textarea>
<p>
<input type="submit" value="Add">
<input type="submit" name="cancel" value="Cancel">
</p>
</form>
</div>
</body>
</html>