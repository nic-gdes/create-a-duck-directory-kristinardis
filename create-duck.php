<!DOCTYPE html>
<html lang="en">
<?php include 'components/head.php'; ?>
<body>
    <?php include 'components/nav.php'; ?>
    <?php
  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
        $duckName = $_POST["duck_name"];
        $favoriteFoods = $_POST["favorite_foods"];
       
        $duckImage = $_FILES["duck_image"]["name"];
        $biography = $_POST["biography"];

     
        echo "<h2>Submitted Duck Information</h2>";
        echo "<p><strong>Duck Name:</strong> $duckName</p>";
        echo "<p><strong>Favorite Foods:</strong> $favoriteFoods</p>";
        echo "<p><strong>Duck Image:</strong> $duckImage</p>";
        echo "<p><strong>Biography:</strong> $biography</p>";
    } else {

    ?>

    <form action="create-duck.php" method="POST" enctype="multipart/form-data">

        <label for="duck_name">Duck Name:</label>
        <input type="text" id="duck_name" name="duck_name" required>

        <label for="favorite_foods">Favorite Foods:</label>
        <textarea id="favorite_foods" name="favorite_foods" rows="5" required></textarea>

        <label for="duck_image">Duck Image:</label>
        <input type="file" id="duck_image" name="duck_image" accept="image/*" required>

        <label for="biography">Biography:</label>
        <textarea id="biography" name="biography" rows="15" required></textarea>

        <button type="submit">Submit</button>
    </form>

    <?php } ?>
    
    <?php include 'components/footer.php'; ?>

</body>
</html>
