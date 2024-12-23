<!DOCTYPE html>
<div id="target">
  <?php
  //include("Projet/Donnees.inc.php");
  include_once __DIR__ . "/../config/config.php";
  include_once DATA_PATH;
  $name = $_GET['name'];
  $categorie = $Hierarchie[$name];

  $recette_result = array();
  foreach ($Recettes as $Recette) {
      foreach ($Recette['index'] as $index) {
          if ($index === $name) {
              array_push($recette_result, $Recette);
              break;
          }
      }
  }

  if (isset($categorie['super-categorie'])) {
      $sup_name = $categorie['super-categorie'][0];
      $collections = array($sup_name);
      while (isset($Hierarchie[$sup_name]['super-categorie'])) {
          $sup_name = $Hierarchie[$sup_name]['super-categorie'][0];
          array_push($collections, $sup_name);
      }
      $collections = array_reverse($collections);
      $strings = "<div>";
      foreach ($collections as $element) {
          $encode = urlencode($element);
          $strings .= '<a target="htmz" href="categories/categories.php?name=' . $encode . '#target">' . $element . '</a>';
          $strings .= '/';
      }
      echo($strings . $name . "</div>");
  } else {
      echo($name);
  }

  if (isset($categorie['sous-categorie'])) {
      echo("<ul>");
      foreach ($categorie['sous-categorie'] as $sub_categorie) {
          $encode = urlencode($sub_categorie);
          echo('<li>');
          echo('<a target="htmz" href="categories/categories.php?name=' . $encode . '#target">' . $sub_categorie . '</a>');
          echo('</li>');
      }
      echo("</ul>");
  }

  if (count($recette_result) > 0) {
      echo("<h3>Liste des recettes</h3>");
      echo("<ul>");
      foreach ($recette_result as $result) {
          $encode = urlencode($result['titre']);
          echo('<li><a target="htmz" href="recette/recette.php?name=' . $encode . '#target">' . $result['titre'] . '</a></li>');
      }
      echo("</ul>");
  }
  ?>
</div>
