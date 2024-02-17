<!DOCTYPE html>
<html lang="en">

<?php require("./config/db.php"); ?>
<?php include 'components/head.php'; ?>

<body>
    <?php include 'components/nav.php'; ?>
    <?php

    $showForm = true;
    $name = "";
    $favorite_foods = "";
    $bio = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {// create error array
        $errors = ["name" => '', "favorite_foods" => '', "bio" => ''];
        $name = htmlspecialchars($_POST["name"]);
        $favorite_foods = htmlspecialchars($_POST["favorite_foods"]);
        $bio = htmlspecialchars($_POST["biography"]);
        $nameMatch = preg_match('/^[a-z0-9\s]+$/i', $name);
        $favoriteFoodsMatch = preg_match('/^[a-z0-9\s]+$/i', $favorite_foods);
        $bioMatch = preg_match('/^[a-z0-9\s]+$/i', $bio);
    
        if (empty($name)) {
            $errors["name"] = 'A name is required';
        } else if (!$nameMatch) {
            $errors["name"] = 'The name has illegal characters';
        }
    
        if (empty($favorite_foods)) {
            $errors["favorite_foods"] = "You are hungry";
        } else if (!$favoriteFoodsMatch) {
            $errors["favorite_foods"] = 'Favorite foods has illegal characters';
        }
    
        if (empty($bio)) {
            $errors["bio"] = 'You must have a bio';
        } else if (!$bioMatch) {
            $errors['bio'] = 'Bio has illegal characters';
        }
    
        $success = empty($errors['name']) && empty($errors['favorite_foods']) && empty($errors['bio']);
    
        if ($success) {
            $imageBinary = file_get_contents($_FILES['duck_image']['tmp_name']);
            $image = mysqli_real_escape_string($conn, $imageBinary);
            $name = mysqli_real_escape_string($conn, $name);
            $favorite_foods = mysqli_real_escape_string($conn, $favorite_foods);
            $bio = mysqli_real_escape_string($conn, $bio);

            $sql = "INSERT INTO ducks (name, favorite_foods, biography, image, created_at) 
                    VALUES ('$name', '$favorite_foods', '$bio', '$image', NOW())";

            if ($conn->query($sql) === TRUE) {
                echo "Duck created successfully!";
                $showForm = false;
                header("Location:index.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "There are errors in the form:";
            
            foreach ($errors as $error) {
                echo "<br/>" . $error;
            }
        }
    }
    
    if ($showForm) {
        ?>

        <form action="create-duck.php" method="POST" enctype="multipart/form-data">

            <label for="name">Duck Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name ?>" required>

            <label for="favorite_foods">Favorite Foods:</label>
            <textarea id="favorite_foods" name="favorite_foods" rows="5" required><?php echo $favorite_foods ?></textarea>

            <label for="duck_image">Duck Image:</label>
            <input type="file" id="duck_image" name="duck_image" accept="image/*" required>

            <label for="biography">Biography:</label>
            <textarea id="biography" name="biography" rows="15" required><?php echo $bio ?></textarea>

            <button type="submit">Submit</button>
        </form>

    <?php } ?>

    <?php include 'components/footer.php'; ?>

</body>

</html>