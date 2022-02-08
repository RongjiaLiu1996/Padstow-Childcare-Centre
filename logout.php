<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
 body {
     font-family: Arial, Helvetica, sans-serif;
     text-align: center;
     background: url('zashley-whitlatch-36aGnv29Ss0-unsplash.jpg') no-repeat fixed;
     background-size: 100% 100%;
    }
form {
    border: 3px solid #f1f1f1;
    width:500px;
    display:inline-block;
    margin-left: auto;
    margin-right: auto;
    text-align: left;
    background:white;
    co11lor:white;
    
}


input[type=text], input[type=password] {
  
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
  
}

button {
  background-color:#04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 10%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

p{
    text-align:center;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<!--button onclick="document.getElementById('id01').style.display='block'">Login</-button-->


<!--div id="id01" class="modal">
  <span-- onclick="document.getElementById('id01').style.display='none'"
class="close" title="Close Modal">&times;</span-->


  <form class="modal-content animate" action="login-process.php" method="post">
    <div class="imgcontainer">
      <img src="sitelogo.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <!--label for="userid"><b>User ID</b></!--label>
      <input type="text" placeholder="Enter UserID" id="userid" name="userid"
      value="<?php if (isset($_SESSION['userid'])) print $_SESSION['userid'];?>">
      
      <label for="ursername"><b>Username</b></label>
      <input type="text" placeholder="Enter Username"  id="username" name="username" 
      value="<?php if (isset($_SESSION['username'])) print $_SESSION['username'];?>">

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" id="password" name="password" 
      value="<?php if (isset($_SESSION['password'])) print $_SESSION['password'];?>">

      <button type="submit" name="login" value="login">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div-- class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div-->
    <p style="color:black; font-size:30px"><b>You Have Been Suceessfully Logged Out</P>
    <p style="color:black; font-size:20px">Click <a href="login.php">here</a> to login back</p>
  </form>
</div>
<?php
if (isset($_GET['message']))
{
    print "<tr>";
    print "<td colspan= '2' align='center'>";
    print $_GET['message'];
    print "</td>";
    print "<tr>";
    $_GET["message"]="";
}
?>
</body>
</html>