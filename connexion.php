<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <h1>Formulaire de connexion</h1>

    <h2>Veuillez fournir vos informations</h2>

    <form action="verifconnexion.php" method="POST">
        <label for="login">Login :</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp" required><br><br>

        <button type="submit">Se connecter</button>
    </form>

</body>

</html>