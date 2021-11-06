<?php
session_start();
require_once "config.php";

 $sql = "SELECT profile_id,first_name,last_name,email,headline FROM profile";
        
 $stmt = mysqli_prepare($conn, $sql);

 if($stmt)
 {

    if(mysqli_stmt_execute($stmt))
    {
        mysqli_stmt_store_result($stmt);

        
        $res_count = mysqli_stmt_num_rows($stmt);
      
        if($res_count >= 1)
        {
            $email = $headline = $first_name = $last_name= "";
            $profile_id = "";
            mysqli_stmt_bind_result($stmt,$profile_id,$first_name,$last_name, $email, $headline); 
            $stack =  array();
            while(mysqli_stmt_fetch($stmt))
            {
                $object = new stdClass();
                $object->email = $email;
                $object->headline = $headline;
                $object->firstname = $first_name;
                $object->lastname = $last_name;
                $object->profile_id = $profile_id;
                array_push($stack, $object);
            }
        
        } 
    }
 }
?>
<!DOCTYPE html>
<html>
<head>
<title>Mohammed Alzamil</title>
<!-- bootstrap.php - this is HTML -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
    crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
    crossorigin="anonymous">

</head>
<body>
<div class="container">
<h1>Chuck Severance's Resume Registry</h1>
<?php
if(isset($_SESSION['message']))
{
    echo '<p style="color:green;">'.$_SESSION['message'].'</p>'; 
}
if(!isset($_SESSION['id'])) 
{
    echo '<p><a href="login.php">Please log in</a></p>';
}else
{
    echo '<p><a href="logout.php">logout</a></p>';
    echo '<p><a href="add.php">add new entry</a></p>';  
}
?>

<table border="1">
<tr><th>Name</th><th>Headline</th>
<?php if(isset($_SESSION['id'])) { echo '<th>Action</th>';} ?>
    <tr>
    <?php
               foreach($stack as $item)
               {
echo '<tr><td>';
echo '<a href="view.php?profile_id='.$item->profile_id.'">'.$item->firstname.' '. $item->lastname.'</a></td><td>';
echo $item->headline.'</td><td>';
 if(isset($_SESSION['id'])) {
echo '<a href="edit.php?profile_id='.$item->profile_id.'">Edit</a> <a href="delete.php?profile_id='.$item->profile_id.'">Delete</a></td></tr>';
               }
            }
?>
</table>
<p>

</div>
</body>