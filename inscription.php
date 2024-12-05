<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <h1>Formulaire d'inscription</h1>

    <h2>Veuillez remplir vos informations</h2>

    <form action="verifInscription.php" method="POST">
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required><br><br>

        <label for="sexe">Sexe :</label>
        <select id="sexe" name="sexe">
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
            <option value="Autre">Autre</option>
        </select><br><br>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom"><br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom"><br><br>

        <label for="naissance">Date de naissance :</label>
        <input type="date" id="naissance" name="naissance"><br><br>

        <label for="mail">Email :</label>
        <input type="email" id="mail" name="mail"><br><br>

        <label for="phone">Numéro de téléphone :</label>
        <input type="text" id="phone" name="phone"><br><br>

        <label for="adresse">Adresse :</label>
        <input type="text" id="adresse" name="adresse"><br><br>

        <label for="ville">Ville :</label>
        <input type="text" id="ville" name="ville"><br><br>

        <label for="postal">Code postal :</label>
        <input type="text" id="postal" name="postal"><br><br>

        <button type="submit">S'inscrire</button>
    </form>

</body>

</html>
