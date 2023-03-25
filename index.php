<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Meal Finder</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Daftar Menu Makanan</h1>

  <form method="get">
    <label for="category">Category:</label>
    <select name="category" id="category">
      <option value="">-- Semua --</option>
      <option value="Beef">Daging</option>
      <option value="Breakfast">Sarapan</option>
      <option value="Chicken">Ayam</option>
      <option value="Dessert">Makanan Penutup</option>
      <option value="Goat">Kambing</option>
      <option value="Lamb">Domba</option>
      <option value="Miscellaneous">Miscellaneous</option>
      <option value="Pasta">Pasta</option>
      <option value="Pork">Babi</option>
      <option value="Seafood">Makanan Laut</option>
      <option value="Side">Side</option>
      <option value="Starter">Starter</option>
      <option value="Vegan">Sayuran</option>
      <option value="Vegetarian">Vegetarian</option>
    </select>
    <input type="submit" value="Search">
  </form>

  <hr>

  <?php
    // cek apakah request sudah diproses
    if (isset($_GET['category'])) {
      // ambil data dari Free Meal API
      $category = $_GET['category'];
      $url = "https://www.themealdb.com/api/json/v1/1/filter.php?c=" . urlencode($category);
      $response = file_get_contents($url);
      $data = json_decode($response, true);

      // tampilkan hasil pencarian
      if ($data['meals']) {
        echo "<ul>";
        foreach ($data['meals'] as $meal) {
          echo "<li>";
          echo "<a href='detail.php?id={$meal['idMeal']}'>";
          echo "<img src='{$meal['strMealThumb']}' alt='{$meal['strMeal']}' width='200'>";
          echo "<p>{$meal['strMeal']}</p>";
          echo "</a>";
          echo "</li>";
        }
        echo "</ul>";
      } else {
        echo "<p>No results found for category '{$category}'.</p>";
      }
    }
  ?>

</body>
</html>
