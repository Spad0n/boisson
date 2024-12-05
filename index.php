<!DOCTYPE html>
<html>
  <head>
    <title>Based Beverage</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <nav>
      <!-- <h1 style="cursor: pointer;">Based Beverage</h1> -->
      <h1 class="nav-title" id="tag_Based_Beverage">Based Beverage</h1>
      <div class="nav-search">
        <input class="search-input" id="search" type="search" placeholder="Search ALL Recipes..." spellcheck="false">
        <button class="search-btn">🔍</button>
      </div>
      <div class="result-container" id="result-container"></div>
      <div class="nav-icons">
        <!-- <form id="form-cart" action="cart.php#target" target="htmz"> -->
          <button class="cart-btn" onClick="sendCartData()">
            🛒
            <span class="cart-badge" id="cart-badge">0</span>
          </button>
        <!-- </form> -->
      </div>
      <a style="color: #eee; padding: 10px;" href="inscription.php">inscription</a>
      <a style="color: #eee;" href="connexion.php">connexion</a>
    </nav>
    <article>
      <?php
      $_GET['name'] = 'Aliment';
      include("categories.php");
      ?>
    </article>
    <iframe hidden name="htmz" id="htmzIframe"></iframe>
    <script src="front.js"></script>
  </body>
</html>
