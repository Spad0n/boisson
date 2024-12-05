<?php
include("Projet/Donnees.inc.php");
if (isset($_GET['name'])) {
    $result = null;
    foreach ($Recettes as $Recette) {
        if ($Recette['titre'] === $_GET['name']) {
            $result = $Recette;
            break;
        }
    }
    $ingredients = explode('|', $result['ingredients']);
}

$images = scandir("Projet/Photos");
unset($images[0]);
unset($images[1]);
$dict = array();

foreach ($images as $image) {
    $key = pathinfo($image, PATHINFO_FILENAME);
    $key = str_replace('_', ' ', $key);
    $key = strtolower($key);
    $key_value = [$key => "Projet/Photos/" . $image];
    $dict += $key_value;
}
?>

<div id="target">
  <?php
  echo('<h1 id="title">' . $_GET['name'] . '</h1>');
  $key = strtolower($result['titre']);
  if (isset($dict[$key])) {
      $img = $dict[$key];
      echo('<p><img src="' . $img . '"></p>');
  } else {
      echo('<p><img src="assets/default.jpg"></p>');
  }
  ?>
  <h2>Ingredients</h2>
  <ul>
    <?php
    foreach ($ingredients as $ingredient) {
        echo("<li>" . $ingredient . "</li>");
    }
    ?>
  </ul>
  <h2>Preparation</h2>
  <p><?= $result['preparation'] ?></p>
  <div>
    <?php
    $strings = "";
    foreach ($result['index'] as $categorie) {
        $encode = urlencode($categorie);
        $strings .= '<a target="htmz" onClick="clearInput()" href="categories.php?name=' . $encode . '#target">' . $categorie . '</a>';
        $strings .= ' · ';
    }
    echo(substr($strings, 0, -3));
    ?>
  </div>
  <button onClick="addToCart()">
    add to cart
  </button>
</div>
