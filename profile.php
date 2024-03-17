<?php

require('./config/db.php');

$duck_is_live = false;//assumes no duck exists until db query is successful
include 'components/nav.php';

//get duck info from the database
//Assign a variable to the id of the duck
//connect to db
//copys and pastes code into page
//create a query to select intended duck from database

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $sql = "SELECT id, name, favorite_foods, biography, image FROM ducks WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $duck = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
    if (isset($duck["id"])) {
        $duck_is_live = true;
    }
} else if (isset($_POST['id_to_delete'])) {
    $id = htmlspecialchars($_POST['id_to_delete']);
    $sql = "DELETE FROM ducks WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Duck deleted successfully";
        echo " <script> location.replace('index.php'); </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    mysqli_close($conn);
    $duck_is_live = false;
} else {
    $duck_is_live = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile of my Duck</title>
</head>

<body>
    <?php include 'components/head.php'; ?>

    <main>
        <h1>Welcome to the world of ducks and their favorite things!</h1>
    <?php if ($duck_is_live): ?>
            <section class="profile">
                <h3>profile content goes here</h3>
            </section>

        <?php else: ?>
            <section class="no-duck">
                <h3>Sorry, no duck found</h3>
            </section>
        <?php endif; ?>
        


        <div class="grid-container">
            <div class="grid-item">
                <img src="./get-image.php?id=<?php echo $id ?>" alt="duck">

                <h2>Name</h2>
            </div>
            <div class="grid-item">
                <h2>My Favorite Foods</h2>
                <p>
                    <?php
                    if (isset($duck['favorite_foods'])) {
                        echo $duck['favorite_foods'];
                    } else {
                        echo "Favorite foods not available";
                    }
                    ?>
                </p>
            </div>
            <div class="grid-item">
                <h2>Biography</h2>
                <p>
                    <?php
                    if (isset($duck['biography'])) {
                        echo $duck['biography'];
                    } else {
                        echo "Biography not available";
                    }
                    ?>
                </p>
            </div>
        </div>

        <form action="./profile.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $id; ?>">
            <input type="submit" name="delete" value="Delete Duck">
        </form>
    </main>

    <?php include 'components/footer.php'; ?>
</body>

</html>