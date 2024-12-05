<link rel="stylesheet" type="text/css" href="style.css">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $login = $_POST['login'];
    $mdp = $_POST['mdp'];

    if (empty($login) || empty($mdp)) {
        die("Erreur : Les champs login et mot de passe sont obligatoires.");
    }

    try {
        // Connexion à la base de données
        $host = 'mysql-projetwebbuardabarca.alwaysdata.net';
        $dbname = 'projetwebbuardabarca_boisson'; 
        $username = '387640_buard1u'; 
        $password = 'Azerty55@';

        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer et exécuter la requête pour vérifier le login
        $stmt = $db->prepare("SELECT * FROM inscrit WHERE login1 = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        // Vérifier si un utilisateur a été trouvé
        if ($stmt->rowCount() > 0) {
            // Récupérer les informations de l'utilisateur
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Vérification du mot de passe avec password_verify
            if (password_verify($mdp, $user['mdp'])) {
                // Connexion réussie
                echo "<p>Bienvenue, " . htmlspecialchars($user['nom']) . " !</p>";
            } else {
                // Mot de passe incorrect
                echo "<p>Erreur : Mot de passe incorrect.</p>";
            }
        } else {
            // Login non trouvé
            echo "<p>Erreur : Login non trouvé.</p>";
        }

    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "<p>Erreur PDO : " . $e->getMessage() . "</p>";
        error_log("Erreur PDO : " . $e->getMessage() . " dans le fichier " . $e->getFile() . " à la ligne " . $e->getLine());
    }
}
?>
<br><a href="index.php"><button>Continuer</button></a>
