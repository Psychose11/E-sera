<?php
session_start();

$_SESSION['pseudo']='';


?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>E sera connexion</title>
    <link rel="stylesheet" href="../css/login.css">
    
  </head>
  <body>
    <div class="left">

<img src="../images/ressources/robot.gif" alt="" width="90px">


<?php if (isset($_SESSION['message'])): ?>
        <div class="error-message">
          <?php echo $_SESSION['message']; ?>
        </div>
      <?php endif; ?>
</div>

    <div class="center">
      <h1 style="color:#507294;font-family:cursive;">Welcome to E sera 👋</h1>
      
      <form method="POST" action="../controller/login_controller.php"> 
        <div class="txt_field">
          <input type="text" required name="pseudo">
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password"  name="password" required>
          <span></span>
          <label>Password</label>
        </div>
        
        <input type="submit" value="Login">
        <div class="signup_link">
          Haven't an account? <a href="../view/form_create_user.php">Create your account</a>
        </div>
      </form>
    </div>

  </body>
</html>