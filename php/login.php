<?php

    extract($_POST);
    
?>

 <?php
   $servername = "localhost";
   $usname = "root";
   $pass= "";
   $dbname = "guvi";
   $count=0;

$conn = new mysqli($servername, $usname, $pass, $dbname);
// Check connection
if ($conn->connect_error) {  die("Connection failed: " . $conn->connect_error);
}



$stmt = $conn->prepare("SELECT * FROM userprofile where username=? and passw=?");
$stmt->bind_param("ss",$uname,$pword);

$stmt->execute();
$result=$stmt->get_result();

$row = $result -> fetch_array(MYSQLI_ASSOC);
$a=$row["age"];
$d=$row["dob"];
$c=$row["contact"];

$rowcount=mysqli_num_rows($result);
$count=$rowcount;

 if($rowcount>0)
   echo "<h1 style=\"color:green\";> Login Successful, Welcome to my Home page </h1>";
   else
   echo "<h1 style=\"color:red\";> Invalid Username/Password </h1>";
  mysqli_free_result($result);
  $stmt->close();
  mysqli_close($conn);
?>
<!--
<script>
  function ajaxcall()
  {
    //alert("Hello");
    const xmlhttp = new XMLHttpRequest();
     xmlhttp.onload = function() {
     const myObj = JSON.parse(this.responseText);
 
   document.getElementById("result").innerHTML = JSON.stringify(myObj);
   //document.getElementById("result").innerHTML = myObj.name+"--"+myObj.email;
}
xmlhttp.open("GET", "jsonfile.php");
xmlhttp.send();
  }

</script>

<h1>
<a style="hover:underline;" href="Javascript:ajaxcall()" > Click here to show personal details in JSON - by getting details from jsonfile.php through AJAX call </a>
</h1>

<h1 id="result"> </h1>

-->

<?php
if($count>0)
{
?>

<script>

     localStorage.setItem("username",'<?php echo $uname; ?>');
     localStorage.setItem("password",'<?php echo $pword?>');
     console.log("localStorage is successfully created");
</script>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="../js/profile.js"></script>



</head>
<body><div class="first">
    <div class="signupFrm">
        <form action="update.php" class="form" method="post" id="ProfileForm">
          <div class="header">
           
          <h1 class="title">Profile </h1></div>
  
          <div class="inputContainer">
            <label for="" class="label">Age </label>
            <?php
            echo "<input type=\"number\" class=\"input\"  name=\"age\" id=\"age\" value=$a placeholder=\"Age\">"
            ?>
          </div>
          
          <div class="inputContainer">
            <label for="" class="label">DOB</label>
            <?php
      echo "<input type=\"date\" class=\"input\" id=\"dob\" name=\"dob\" value=$d  placeholder=\"DOB\">"
            ?>
          </div>
<br>
          <div class="inputContainer1">
            <label for="" class="label">Contact </label>
            <br>
            <?php
            echo "<input type=\"text\" class=\"input\"  name=\"contact\" id=\"contact\" value=$c placeholder=\"Contact No\" style=\"width:380px;height:50px;\">"
            ?>
            </div>
        <?php
          echo "<input type=\"hidden\" name=\"uname\" value=$uname>";

          
          echo "<input type=\"hidden\" name=\"pword\" value=$pword>";
          

          ?>
          
          <input type="submit" class="submitBtn" value="Update" id="update" style="margin-top:50px"/>
       
        </div>
      </form>
    </div>
</div>
</body>
</html>
<?php
}?>
