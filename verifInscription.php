<link rel="stylesheet" type="text/css" href="style.css">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $sexe = $_POST['sexe'] ?? null;
    $nom = $_POST['nom'] ?? null;
    $prenom = $_POST['prenom'] ?? null;
    $naissance = $_POST['naissance'] ?? null;
    $mail = $_POST['mail'] ?? null;  
    $phone = $_POST['phone'] ?? null;
    $adresse = $_POST['adresse'] ?? null;
    $ville = $_POST['ville'] ?? null;
    $postal = $_POST['postal'] ?? null;

    // Vérification des champs obligatoires
    if (empty($login) || empty($mdp)) {
        die("Erreur : Les champs login et mot de passe sont obligatoires.");
    }

    // Hachage du mot de passe
    $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);

    try {
        // Connexion à la base de données
        $host = 'mysql-projetwebbuardabarca.alwaysdata.net';
        $dbname = 'projetwebbuardabarca_boisson'; 
        $username = '387640_buard1u'; 
        $password = 'Azerty55@';
    
        $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Vérifier si la table 'inscrit' existe
        $tableExistsQuery = $db->query("SHOW TABLES LIKE 'inscrit';");
        if ($tableExistsQuery->rowCount() == 0) {
            die("Erreur : La table 'inscrit' n'existe pas dans la base de données.");
        }

        // Vérification des colonnes nécessaires
        $columnsQuery = $db->query("DESCRIBE inscrit;");
        $columns = $columnsQuery->fetchAll(PDO::FETCH_COLUMN);
        $requiredColumns = ['login1', 'mdp', 'genre', 'nom', 'prenom', 'email', 'datenaissance', 'adresse', 'ville', 'code_postal', 'phone'];
        $missingColumns = [];
        foreach ($requiredColumns as $column) {
            if (!in_array($column, $columns)) {
                $missingColumns[] = $column;
            }
        }
        if (!empty($missingColumns)) {
            die("Erreur : Les colonnes suivantes sont manquantes dans la table 'inscrit' : " . implode(", ", $missingColumns) . ".");
        }

        // Préparer la requête d'insertion
        $query = "
            INSERT INTO inscrit (login1, mdp, genre, nom, prenom, email, datenaissance, adresse, ville, code_postal, phone)
            VALUES (:login, :mdp, :sexe, :nom, :prenom, :mail, :naissance, :adresse, :ville, :postal, :phone);
        ";

        // Préparer la requête
        $stmt = $db->prepare($query);

        // Lier les paramètres
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':mdp', $hashedPassword);
        $stmt->bindParam(':sexe', $sexe);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':mail', $mail);
        $stmt->bindParam(':naissance', $naissance);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':postal', $postal);
        $stmt->bindParam(':phone', $phone);

        // Exécuter la requête d'insertion
        $stmt->execute();

        // Vérification de l'insertion
        $checkInsert = $db->prepare("SELECT * FROM inscrit WHERE login1 = :login");
        $checkInsert->bindParam(':login', $login);
        $checkInsert->execute();

        if ($checkInsert->rowCount() > 0) {
            echo "<p>L'utilisateur a été inséré avec succès.</p>";
        } else {
            echo "<p>Erreur : L'utilisateur n'a pas été inséré.</p>";
        }

    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "<p>Erreur PDO : " . $e->getMessage() . "</p>";
        error_log("Erreur PDO : " . $e->getMessage() . " dans le fichier " . $e->getFile() . " à la ligne " . $e->getLine());
    }
}
?>
<br><a href="index.php"><button>Continuer</button></a>
