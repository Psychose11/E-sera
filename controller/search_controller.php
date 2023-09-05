<?php



session_start();



if (isset($_SESSION['pseudo'])) {
    // Utiliser la valeur du pseudo
    $pseudo = $_SESSION['pseudo'];


    // Connexion à la base de données
    require_once '../model/connexion.php';

    try {
        // Préparer la requête pour récupérer les informations de l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM user WHERE pseudo = ?");
        $stmt->execute([$pseudo]);

        // Vérifier si l'utilisateur existe dans la base de données
        if ($stmt->rowCount() > 0) {
            // Récupérer les données de l'utilisateur
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $id =  $user['id'];
            $pdp = $user['pdp'];
            $nom = $user['pseudo'];
        } else {
            echo "Utilisateur introuvable.";
        }
    } catch (PDOException $e) {
        // En cas d'erreur de requête, afficher le message d'erreur
        echo "Erreur lors de la récupération des informations de l'utilisateur : " . $e->getMessage();
    }
} else {

    header('Location: ../view/login_view.php');
    exit();
}



// Inclure le modèle de connexion à la base de données
require_once '../model/connexion.php';

// Vérifier si le formulaire a été soumis


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/swiper-bundle.min.css">
    <link rel="stylesheet" href="../css/style_search.css">
    <title>E sera search🤖</title>
</head>

<body>

    <nav>

        <div class="nav_left">
            <img src="../images/esera.png" alt="logo esera" class="logo">
            <ul>
                <li><a href="../index.php"><img src="../images/50house.png" alt=""></a></li>
                <li><img src="../images/chat.png" alt=""></li>
                <li><img src="../images/23pie.png" alt=""></li>
                <li><img src="../images/notification.png" alt=""></li>
            </ul>

        </div>

        <div class="nav_right">
            <div class="search_box">

                <form action="../controller/search_controller.php" method="post">
                    <button type="submit"><img src="../images/search.png" alt="search"></button>
                    <input type="search" name="search" placeholder="Search">
                </form>
            </div>
            <div class="nav_user_icon online" onclick="showMenu()">
                <img src="../images/pdp/<?php echo $pdp; ?>" alt="">
            </div>
        </div>

        <div class="setting_menu">
            <div id="dark_btn">
                <span></span>
            </div>


            <div class="setting_menu_inner">
                <div class="user_profile">
                    <img src="../images/pdp/<?php echo $pdp; ?>">
                    <div>
                        <p>
                            <?php echo $nom; ?>
                        </p>
                        <a href="#">See your profile</a>

                    </div>
                </div>
                <hr>
                <div class="user_profile">
                    <img src="../images/feedback.png">
                    <div>
                        <p>
                            Give Feedback
                        </p>
                        <a href="#">Help us to improve the new design</a>

                    </div>
                </div>
                <hr>
                <div class="setting_links">
                    <img src="../images/setting.png" class="setting_icon">
                    <a href="#">Settings & Privacy<img src="../images/arrow.png" width="10px"></a>
                </div>
                <div class="setting_links">
                    <img src="../images/help.png" class="setting_icon">
                    <a href="#">Help & Support<img src="../images/arrow.png" width="10px"></a>
                </div>
                <div class="setting_links">
                    <img src="../images/display.png" class="setting_icon">
                    <a href="#">Display & Accessibility<img src="../images/arrow.png" width="10px"></a>
                </div>

                <div class="setting_links">
                    <img src="../images/logout.png" class="setting_icon">
                    <a href="../controller/logout_controller.php">Logout<img src="../images/arrow.png" width="10px"></a>
                </div>
            </div>
        </div>

        </div>
    </nav>

    <?php
echo "<div class='carousel'>";
echo "  <div class='carousel-inner'>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les valeurs du formulaire
    $search = $_POST['search'];

    try {
        $query = "SELECT p.*, u.pseudo AS utilisateur_nom, u.pdp AS utilisateur_pdp, u.tel AS tel FROM produit p 
              JOIN user u ON p.utilisateur_id = u.id 
              WHERE p.nom LIKE '%$search%' OR p.prix LIKE '%$search%' OR p.description LIKE '%$search%'";
        $stmt = $pdo->query($query);

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $produit_id = $row['id'];
                $nom = $row['nom'];
                $image = $row['image'];
                $description = $row['description'];
                $prix = $row['prix'];
                $type = $row['type'];
                $utilisateur_nom = $row['utilisateur_nom'];
                $tel = $row['tel'];
                $utilisateur_pdp = $row['utilisateur_pdp'];
                
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

                echo "
            <div class='carousel-item'>
                <div class='card'>
                    <div class='card-image'>
                        <img src='../images/produit/$image' alt='$nom' />
                    </div>
                    <div class='card-content'>
                        <div class='user-info'>
                            <img src='../images/pdp/$utilisateur_pdp' alt='' />
                            <h4 class='username'>$utilisateur_nom</h4>
                        </div>
                        <h3 class='product-name'>$nom</h3>
                        <div class='description'>$description</div>
                        <p class='price'>Price: $prix Ar</p>
                        <p class='tel'>Tel: $tel</p>
                        <p class='date'>Published ago $decalage</p>
                        
";




echo" <div class='activity_icons'>
<div>";
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
                                echo "<img src='../images/liked.png' alt='Liked'> You and";
                               
                            }
                             else {
                                // Afficher le bouton "Like" avec un lien pour ajouter le like
                                echo "<a href='../controller/ajouter_like.php?produit_id=$produit_id&utilisateur_id=$id'><img src='../images/like.png' alt='Liked'></a>";
                            }
                            $queryLikes = "SELECT COUNT(*) AS total_likes FROM likes WHERE produit_id = :produit_id";
                            $stmtLikes = $pdo->prepare($queryLikes);
                            $stmtLikes->bindParam(':produit_id', $produit_id);
                            $stmtLikes->execute();
                            $resultLikes = $stmtLikes->fetch(PDO::FETCH_ASSOC);
                            $totalLikes = $resultLikes['total_likes'];
                            if($totalLikes == 0){echo "<span>$totalLikes</span>";}
                            else{echo"<span>$totalLikes others</span>";}
                            
                            

echo    " </div>
</div>";












 echo"                       

                    </div>
                </div>
            </div>";
            }
        } else {
            echo "<p>Aucun résultat trouvé.</p>";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

echo "  </div>";
echo "  <button class='carousel-prev'>&#8249;</button>";
echo "  <button class='carousel-next'>&#8250;</button>";
echo "</div>";
?>

<style>

</style>

<script>
const carousel = document.querySelector('.carousel');
const carouselInner = document.querySelector('.carousel-inner');
const carouselItems = document.querySelectorAll('.carousel-item');
const prevBtn = document.querySelector('.carousel-prev');
const nextBtn = document.querySelector('.carousel-next');
let currentIndex = 0;

prevBtn.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
    updateCarousel();
});

nextBtn.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % carouselItems.length;
    updateCarousel();
});

function updateCarousel() {
    carouselInner.style.transform = `translateX(-${currentIndex * 33.33}%)`;
}

updateCarousel();
</script>


</body>
<script src="../scripts/scripts.js"></script>


</html>