<?php
//check for POST
if (isset($_POST['submit'])) {

    // create error array
    $errors = array(
        "name" => "",
        "favorite_foods" => "",
        "bio" => "",
    );

    $name = htmlspecialchars($_POST["name"]);
    $favorite_foods = htmlspecialchars($_POST["favorite_foods"]);
    $bio = htmlspecialchars($_POST["bio"]);


    if (empty($name)) {
        $errors['name'] = 'The name is required';
    } else {
        if (preg_match('/^[a-z,\s]+$/1', $name)) {
            $errors['name'] = 'The name has illegal characters';
        }

        if (empty($favorite_foods)) {
            $errors['favorite_foods'] = 'No favorite foods>  You are hungry';
        } else {
            if (preg_match('/^[a-z,\s]+$/1', $favorite_foods)) {
                $errors['favorite_foods'] = 'Favorite foods must be a comma separated list';
            }

            if (empty($bio)) {
                $errors['bio'] = 'You must have a bio';
            }

            if (preg_match('/^[a-z,\s]+$/1', $bio)) {
                $errors['bio'] = 'Bio must be a string';
            }
            if (!array_filter($errors)) {
            } else {
                
                //connect to db
                require('./config/db.php');
                //build sql query
                $sql = "INSERT INTO ducks(name, favorite_foods, biography) VALUES ('$name', '$favorite_foods', '$bio')";
               

                //exwcute query in mysql
                mysqli_query($conn, $sql);

                //load home page
                header("Location: ./index.php");
            }
        }
    }
}

?>



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