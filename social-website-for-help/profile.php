<?php
    session_start();
    require('connect.php');
?>
<html>
<head>
    
    <title>Forum Page</title>
</head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<body>
<nav class="navbar navbar-expand-sm bg-warning navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
    <a href="forum.php" class="nav-link" style="color:black;font-size:20px;font-family:cortana;">Home Page</a> 
    </li>
    <li class="nav-item">
    <a href="account.php" class="nav-link" style="color:black;font-size:20px;font-family:cortana;">My Account</a>
    </li>
    <li class="nav-item">
    <a href="members.php" class="nav-link" style="color:black;font-size:20px;font-family:cortana;">Member</a>
    </li>
    <li class="nav-item">
    <a href="forum.php?action=logout" class="nav-link" style="color:black;font-size:20px;font-family:cortana;">Log Out</a>
    </li>
    <li class="nav-item" style="margin-top:10px;margin-left:800px;">
    <a href="post.php"><button style="padding:5px;background-color:cyan;color:black;font-family:cortana;">Share Here</button></a>
    </li>
  </ul>
</nav>


</body>
</html>

<?php
$conn = mysqli_connect("localhost", "root", "", "social_site");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$username=$_SESSION['username'];

$result = mysqli_query($conn, "SELECT username, email FROM signup where username='$username';");
if (mysqli_num_rows($result) != 0) {
    // output data of each row
    echo "<br/>";
    
    while($row = mysqli_fetch_assoc($result)) {
        echo '<div style="font-size:26px;margin-left:50px;font-fa,ily:cortana;font-style: italic;color:red;">'.ucfirst($row['username']).'</div>';
        
        echo "<b style='color:blue;margin-left:50px;font-size:20px;'>Gmail : ".$row["email"]."</b>" ;

    }
    
    } else { echo "0 results"; }
    $conn->close();
  }  
?>

<div class="container">
 <?php
 $conn = mysqli_connect("localhost", "root", "", "social_site");
 // Check connection
 if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
 }
 else{
 $username=$_SESSION['username'];
 $query1="select * from post where topic_creator='$username';";
 $result1 = mysqli_query($conn, $query1);
if(mysqli_num_rows($result1) !=0){
  $row = mysqli_fetch_assoc($result1);
  $id=$row['topic_id'];
$query2="select  p.topic_name,p.topic_content,r.reply_content from post as p ,reply as r where r.topic_id='$id';"; 
$result2=mysqli_query($conn,$query2);
 if (mysqli_num_rows($result2) != 0) {
 // output data of each row
 echo "<br/>";
 echo '<hr>'.'<i style="margin-left:500px;font-size:25px;font-family:Times New Roman;">'.'Replies to your posts'.'</i>'.'<hr>';
 while($row1 = mysqli_fetch_assoc($result2)){ 
     echo '<div style="border:4px solid red;width:100%;margin-left:50px;margin-bottom:20px;padding:15px;padding:bottom:10px;border-radius:20px;font-family:cortana;height:auto;">'.'<p style="font-size:30px;font-style:bold;color:purple;text-decoration:underline;">'.$row1['topic_name'].'</p>';
     echo 'Your post : '.$row1['topic_content'].'<br>';
     echo 'Replies : '.$row1['reply_content'].'</div>';
     //echo "<b>".$row["topic_creator"]."</b>   " .$row["created"]."<br/><br/></div>";
 }
 }
} 
 else { echo "0 results"; }
}
 $conn->close();
 ?>