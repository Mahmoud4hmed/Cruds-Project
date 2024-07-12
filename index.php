<?php

  try{
    require_once "includes/dbh.inc.php";

    $query = "SELECT * FROM products";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;

  } catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="crud">
    <header>
      <h1>My Store</h1>
      <p>Administrator Management System</p>
    </header>

    <form action="includes/submit.inc.php" method="POST" class="inputs">
      <input type="text" name="title" id="title" placeholder="Title">
      <div class="price">
        <input onkeyup="getTotal()" type="number" name="price" id="price" placeholder="Price">
        <input onkeyup="getTotal()" type="number" name="taxes" id="taxes" placeholder="Taxes">
        <input onkeyup="getTotal()" type="number" name="ads" id="ads" placeholder="Ads">
        <input onkeyup="getTotal()" type="number" name="discount" id="discount" placeholder="Discount">
        <span id="total">Total: <span id="sum">0</span>$</span>
      </div >
      <input type="number" name="amount" id="count" placeholder="Amount">
      <input type="text" name="category" id="category" placeholder="Category">
      <button type="submit" id="submit" name="submit">Submit</button>
    </form>

    <div class="output">
      <div class="searchBlock">
        <input onkeyup="searchData(this.value)" type="text" name="search" id="search" placeholder="Search">
        <div class="btnSearch">
          <button onclick="getSearchmood(this.id)" id="searchTitle">Search By Title</button>
          <button onclick="getSearchmood(this.id)" id="searchCategory">Search By Category</button>
        </div>
      </div>
      <div id="deleteAll">
         
      </div>
      <table>
        <tr>
          <th>id</th>
          <th>title</th>
          <th>price</th>
          <th>taxes</th>
          <th>ads</th>
          <th>discount</th>
          <th>total</th>
          <th>category</th>
          <th>amount</th>
          <th>delete</th>
        </tr>
        <tbody id="">
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['id']); ?></td>
                <td><?php echo htmlspecialchars($product['title']); ?></td>
                <td><?php echo htmlspecialchars($product['price']); ?></td>
                <td><?php echo htmlspecialchars($product['taxes']); ?></td>
                <td><?php echo htmlspecialchars($product['ads']); ?></td>
                <td><?php echo htmlspecialchars($product['discount']); ?></td>
                <td><?php echo htmlspecialchars($product['price'] + $product['taxes'] + $product['ads'] - $product['discount']); ?></td>
                <td><?php echo htmlspecialchars($product['category']); ?></td>
                <td><?php echo htmlspecialchars($product['amount']); ?></td>
                <td><button class="btn btn-danger">Delete</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
  <script src="main.js"></script>
</body>

</html>