<?php
$cart = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');

    $data = json_decode($input, true);

    if (isset($data['cart']) && is_array($data['cart'])) {
        foreach ($data['cart'] as $item) {
            if (isset($item['name'], $item['quantity'])) {
                $cart[] = [
                    'name' => htmlspecialchars($item['name']),
                    'quantity' => (int)$item['quantity']
                ];
            }
        }
    }
}
?>

<table>
  <thead>
    <tr>
      <th>Produit</th>
      <th>Quantité</th>
      <th>Action</th>
  </th>
  </thead>
  <tbody>
    <?php
    foreach ($cart as $item) {
        echo("<tr>");
        echo("<td>" . $item['name'] . "</td>");
        echo("<td>" . $item['quantity'] . "</td>");
        echo("<td>");
        echo("<button>+</button>");
        echo("<button>-</button>");
        echo("</td>");
        echo("</tr>");
    }
    ?>
  </tbody>
</table>
