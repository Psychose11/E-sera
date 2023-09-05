<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);


// Vérifier si la variable de session existe
if (isset($_SESSION['pseudo'])) {
    // Utiliser la valeur du pseudo
    $pseudo = $_SESSION['pseudo'];


    // Connexion à la base de données
    require_once 'model/connexion.php';

    try {
        // Préparer la requête pour récupérer les informations de l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM user WHERE pseudo = ?");
        $stmt->execute([$pseudo]);

        // Vérifier si l'utilisateur existe dans la base de données
        if ($stmt->rowCount() > 0) {
            // Récupérer les données de l'utilisateur
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $pdp = $user['pdp'];
            $id = $user['id'];
            $nom = $user['pseudo'];
        } else {
            echo "Utilisateur introuvable.";
        }
    } catch (PDOException $e) {
        // En cas d'erreur de requête, afficher le message d'erreur
        echo "Erreur lors de la récupération des informations de l'utilisateur : " . $e->getMessage();
    }
} else {

    header('Location: view/login_view.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>E sera 🤖</title>





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
    <nav>

        <div class="nav_left">
            <img src="images/esera.png" alt="logo esera" class="logo">
            <ul>
                <li><img src="images/50house.png" alt=""></li>
                <li><img src="images/chat.png" alt=""></li>
                <li><img src="images/23pie.png" alt=""></li>
                <li><img src="images/notification.png" alt=""></li>
            </ul>

        </div>

        <div class="nav_right">
            <div class="search_box">

            <form action="controller/search_controller.php" method="post">
                <button type="submit"><img src="images/search.png" alt="search"></button>
                <input type="search" name="search" placeholder="Search">
            </form>
            </div>
            <div class="nav_user_icon online" onclick="showMenu()">
                <img src="images/pdp/<?php echo $pdp; ?>" alt="">
            </div>
        </div>

        <div class="setting_menu">
        <div id="dark_btn">
            <span></span>
        </div>


        <div class="setting_menu_inner">
              <div class="user_profile">
                <img src="images/pdp/<?php echo $pdp; ?>">
                <div>
                    <p>
                        <?php echo $nom; ?>
                    </p>
                    <a href="#">See your profile</a>

                </div>
            </div>
            <hr>
            <div class="user_profile">
                <img src="images/feedback.png">
                <div>
                    <p>
                        Give Feedback
                    </p>
                    <a href="#">Help us to improve the new design</a>

                </div>
            </div>
            <hr>
            <div class="setting_links">
                <img src="images/setting.png" class="setting_icon">
                <a href="#">Settings & Privacy<img src="images/arrow.png" width="10px"></a> 
            </div>
            <div class="setting_links">
                <img src="images/help.png" class="setting_icon">
                <a href="#">Help & Support<img src="images/arrow.png" width="10px"></a> 
            </div>
            <div class="setting_links">
                <img src="images/display.png" class="setting_icon">
                <a href="#">Display & Accessibility<img src="images/arrow.png" width="10px"></a> 
            </div>
           
            <div class="setting_links">
                <img src="images/logout.png" class="setting_icon">
                <a href="controller/logout_controller.php">Logout<img src="images/arrow.png" width="10px"></a> 
            </div>
        </div>
 </div>

        </div>






    </nav>




    <div class="container">



        <div class="left_sidebar">
            <div class="imp_links">
                <a href="#"><img src="images/front-store.png" alt="">Latest News</a>
                <a href="#"><img src="images/friends (1).png" alt="">Friends</a>
                <a href="#"><img src="images/show-apps-button.png" alt="">Groups</a>
                <a href="#"><img src="images/shopping-cart.png" alt="">MarketPlace</a>
                <a href="#">See more...</a>
            </div>
            <div class="shorcut_link">
                <p>Your Shortcuts</p>
                <a href=""><img src="images/shortcut/shortcut3.jpeg" alt=""> Malagasy Web Developers</a>
                <a href=""><img src="images/shortcut/sho.jpeg" alt=""> Web Design course</a>
                <a href=""><img src="images/shortcut/shortcut2.jpeg" alt=""> Full Stack Development</a>
                <a href=""><img src="images/shortcut/shortcut1.jpeg" alt=""> Python courses in Malagasy</a>
            </div>

        </div>

        <div class="main_content">
            <div class="story_gallery">
                <div class="story story0" style="background-image:url('images/pdp/<?php echo $pdp; ?>');">
                    <img src="images/story/icons/add.png">
                    <p>New story</p>
                </div>
                <div class="story story1">
                    <img src="images/pdp/james.jpg">
                    <p>Njaraniaina James</p>
                </div>
                <div class="story story2">
                    <img src="images/pdp/mandimby.jpg">
                    <p>Gasimiaro Mandimby</p>
                </div>
                <div class="story story3">
                    <img src="images/pdp/mianja.jpg">
                    <p>Mirantsoa Rakotomalala</p>
                </div>
                <div class="story story4">
                    <img src="images/pdp/leo.jpg">
                    <p>Léothicia Ralantoarison</p>
                </div>
            </div>

            <div class="write_post_container">

                <div class="user_profile">
                    <img src="images/pdp/<?php echo $pdp; ?>">
                    <div>
                        <p>
                            <?php echo $nom; ?>
                        </p>
                        <small>Public<img src="images/down-arrow.png"> </small>
                    </div>
                </div>

                <div class="post_input_container">

                    <h2>What to sell today🤤??</h2>
                    <form method="post" action="controller/post_produit.php" enctype="multipart/form-data">
                        <label for="nom">Name of product :</label>
                        <input type="text" name="nom" id="nom" required><br><br>

                        <label for="image">Pictures :</label>
                        <input type="file" name="image" id="image" required><br><br>

                        <label for="description">Description :</label>
                        <textarea name="description" id="description" required></textarea><br><br>
                        <label for="prix">Price :</label>
                        <input type="number" name="prix" id="prix" required><br><br>





                        <label for="type">Type :</label>
                        <select name="type" id="type">
                            <option value="Shoes">Shoes</option>
                            <option value="Autos/moto">Shoes</option>
                            <option value="Technologie">Technologie</option>
                            <option value="Pets&co">Pets&co</option>
                            <option value="Musical">Musical</option>
                            <option value="Decoration">Decoration</option>
                            <option value="Other">Other</option>
                        </select><br><br>

                        <input type="submit" value="Share">
                    </form>
                </div>

            </div>


            <?php
            // Inclure le modèle de connexion à la base de données
            require_once 'model/connexion.php';

            try {
                // Requête pour récupérer tous les produits et leurs informations d'utilisateur associées
    // Requête pour récupérer tous les produits et leurs informations d'utilisateur associées, triés par la date la plus récente
$query = "SELECT p.*, u.pseudo, u.pdp, u.tel FROM produit p JOIN user u ON p.utilisateur_id = u.id ORDER BY p.date_publication DESC";

                $stmt = $pdo->query($query);

                // Vérifier s'il y a des résultats
                if ($stmt->rowCount() > 0) {
                    // Parcourir les résultats
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Récupérer les informations du produit
                        $produit_id = $row['id'];
                        $nom = $row['nom'];
                        $image = $row['image'];
                        $description = $row['description'];
                        $prix = $row['prix'];
                        $type = $row['type'];

                        // Récupérer les informations de l'utilisateur
                        $pseudo = $row['pseudo'];
                        $pdp = $row['pdp'];
                        $tel = $row['tel'];

                        // Récupérer la date de publication et calculer le décalage
                        $date_publication = new DateTime($row['date_publication']);
                        $maintenant = new DateTime();
                        $diff = $date_publication->diff($maintenant);
                        $decalage = "";

                        // Afficher le décalage de la date de publication
                        if ($diff->y > 0) {
                            $decalage = $diff->format('%y year(s) ');
                        } elseif ($diff->m > 0) {
                            $decalage = $diff->format('%m month ');
                        } elseif ($diff->d > 0) {
                            $decalage = $diff->format('%d day(s) ');
                        } elseif ($diff->h > 0) {
                            $decalage = $diff->format('%h hour(s) ');
                        } elseif ($diff->i > 0) {
                            $decalage = $diff->format('%i min(s) ');
                        } else {
                            $decalage = "a few seconds";
                        }
                        // Afficher les informations du produit et de l'utilisateur

          
                        echo "<div class='post_container'>";
                        echo " 
                        <div class='post_row'>
                        
                                    <div class='user_profile'>
                                        <img src='images/pdp/$pdp' alt='Photo de profil de $pseudo'>
                                                    <div>
                            ";
                        echo " 
                        
                        
                        
                




<div>
                                        <p>
                                            $pseudo

                                        </p>

                                        <small>Public<img src='images/down-arrow.png'> </small>

                                        <span> Published ago
                                        $decalage 
                                        </span>
                                                            </div>
                                                    </div>
                                        </div>
                                        <a href='#'><img src='images/more.png' style='width:20px;height:20px;'></a>
                                        




                                </div>
                                <p class='post_text'>
                                <h3>$nom</h3><br>
                                <span>$description</span><br>
                                <span>$prix Ariary</span><br>
                                <span><a href='#'>#$type</a></span><br>
                                <span>Info : $tel</span><br>

                               </p>



                               <img src='images/produit/$image' alt='$nom' class='post_img'>

                            





                                    <div class='post_row'>";

                            echo"
                            <div class='activity_icons'>";
                   
echo" <div>";
                            $utilisateur_id = $id;
                            
                            // Requête pour vérifier si l'utilisateur a déjà aimé le produit
                            $query5 = "SELECT COUNT(*) AS liked_count FROM likes WHERE produit_id = :produit_id AND utilisateur_id = :utilisateur_id";
                            $stmt5 = $pdo->prepare($query5);
                            $stmt5->bindParam(':produit_id', $produit_id);
                            $stmt5->bindParam(':utilisateur_id', $utilisateur_id);
                            $stmt5->execute();
                            $result5= $stmt5->fetch(PDO::FETCH_ASSOC);
                            $liked_count = $result5['liked_count'];
                        
                            // Afficher l'icône "Liked" si l'utilisateur a déjà aimé le produit
                            if ($liked_count > 0) {
                                echo "<img src='images/liked.png' alt='Liked'> You and";
                               
                            }
                             else {
                                // Afficher le bouton "Like" avec un lien pour ajouter le like
                                echo "<a href='controller/ajouter_like.php?produit_id=$produit_id&utilisateur_id=$id'><img src='images/like.png' alt='Liked'></a>";
                            }
                            $queryLikes = "SELECT COUNT(*) AS total_likes FROM likes WHERE produit_id = :produit_id";
                            $stmtLikes = $pdo->prepare($queryLikes);
                            $stmtLikes->bindParam(':produit_id', $produit_id);
                            $stmtLikes->execute();
                            $resultLikes = $stmtLikes->fetch(PDO::FETCH_ASSOC);
                            $totalLikes = $resultLikes['total_likes'];
                            if($totalLikes == 0){echo "<span>$totalLikes</span>";}
                            else{echo"<span>$totalLikes others</span>";}
                            
                            

echo" </div>";

 

                        echo" </div>";
                                
                            
                            
                            echo"
                                
                                        <div class='post_profile_icon'>
                                            <img src='images/pdp/$pdp' alt='Photo de profil de $pseudo'>
                                            <img src='images/down-arrow.png' style='width:20px;height:20px;'>   
                    
                    
                                        </div>
                                    </div>
                        
                            </div>

                                
        ";
                    }
                } else {
                    echo "Aucun produit trouvé.";
                }
            } catch (PDOException $e) {
                // En cas d'erreur d'exécution de la requête, afficher le message d'erreur
                echo "Erreur lors de la récupération des produits : " . $e->getMessage();
            }
            ?>




        </div>




        <div class="right_sidebar">
            <div class="sidebar_title">
                <h4>Events</h4>
                <a href="#"> See All</a>
            </div>
            <div class="event">

                <div class="left_event">
                    <h3>15</h3>
                    <span>November</span>
                </div>
                <div class="right_event">
                    <h4>Social Media</h4>
                    <p><img src="images/location.png" width="10px"> Zuckerberg Tech Park</p>
                    <a href="#">More Information</a>
                </div>
            </div>
            <div class="event">

                <div class="left_event">
                    <h3>27</h3>
                    <span>December</span>
                </div>
                <div class="right_event">
                    <h4>Web cup</h4>
                    <p><img src="images/location.png" width="10px"> Akata Goavana contribution</p>
                    <a href="#">More Information</a>
                </div>
            </div>
            <div class="event">

                <div class="left_event">
                    <h3>19</h3>
                    <span>January</span>
                </div>
                <div class="right_event">
                    <h4>University Hackathon</h4>
                    <p><img src="images/location.png" width="10px"> Build our Airtel API</p>
                    <a href="#">More Information</a>
                </div>
            </div>
            <div class="sidebar_title">

                <h4>Advertissement</h4>
                <a href="#">Close</a>
            </div>
            <img src="images/advertissement.jpg" class="sidebar_ads">

            <div class="sidebar_title">

                <h4>Conversation</h4>
                <a href="#">Hide chat</a>
            </div>



            <div class="online_list">
                <div class="online">
                    <img src="images/pdp/mandimby.jpg">
                </div>
                <p>Mandimby Gasimiaro</p>
            </div>

            <div class="online_list">
                <div class="online">
                    <img src="images/pdp/james.jpg">
                </div>
                <p>James Rakotonirina</p>
            </div>
            <div class="online_list">
                <div class="online">
                    <img src="images/pdp/leo.jpg">
                </div>
                <p>Léothicia Ralantoarison</p>
            </div>


            <div class="online_list">
                <div class="online">
                    <img src="images/pdp/rasta.jpg">
                </div>
                <p>Stephan NyAina</p>
            </div>
            <div class="online_list">
                <div class="online">
                    <img src="images/pdp/rija.jpg">
                </div>
                <p>Rija Lalaina</p>
            </div>
        </div>
    </div>
    <button class="load_more_btn" type="button">Load More</button>
    <div class="footer">
        <p>Copyright 2023 - @Psychose corp</p>


    </div>
<script src="scripts/scripts.js">

</script>
</body>

</html>