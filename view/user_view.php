<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profil de l'utilisateur</title>
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
  <nav>

<div class="nav_left">
    <img src="../images/esera.png" alt="logo esera" class="logo">
    <ul>
        <li><img src="../images/50house.png"></li>
        <li><img src="../images/chat.png"></li>
        <li><img src="../images/23pie.png" alt=""></li>
        <li><img src="../images/notification.png" alt=""></li>
    </ul>

</div>

<div class="nav_right">
    <div class="search_box">
        <img src="../images/search.png" alt="search">
        <input type="search" name="" id="" placeholder="Search">
    </div>

</div>

</nav>



    <div class="profile-container">
        <div class="profile-picture">
            <img src="../images/<?php echo $pdp; ?>" alt="Photo de profil">
        </div>
        <div class="profile-details">
            <h2><?php echo $nom . ' ' . $prenom; ?></h2>
            <p>Pseudo: <?php echo $pseudo; ?></p>
            <p>Téléphone: <?php echo $tel; ?></p>
        </div>
    </div>
  </body>
</html>
