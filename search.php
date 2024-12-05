<?php
include("Projet/Donnees.inc.php");
$name = $_GET['name'];

function areStringSimilar($str1, $str2) {
    $str1 = strtolower($str1);
    $str2 = strtolower($str2);

    return strpos($str1, $str2) !== false || strpos($str2, $str1) !== false;
}
?>

<div class="result-container" id="result-container">
  <?php
  //echo('<div class="result-container" id="result-container">');
  $count = 0;
  foreach ($Recettes as $Recette) {
      if ($count > 9) {
          break;
      }
      if (areStringSimilar($name, $Recette['titre'])) {
          $encode = urlencode($Recette['titre']);
          echo('<div class="result-item"><a target="htmz" onClick="clearInput()" href="recette.php?name=' . $encode . '#target">' . $Recette['titre'] . '</a></div>');
          $count += 1;
      }
  }
  if ($count == 0) {
      echo('<div id="result-item">Aucun resultat trouvé</div>');
  }
  ?>
  <div>
