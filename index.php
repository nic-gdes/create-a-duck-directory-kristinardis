<?php
// Path: index.php
include('./config/db.php');
// create a query
$sql = "SELECT id,name,favorite_foods,image,biography,created_at FROM ducks";
// make the query and get result
$result = mysqli_query($conn, $sql);
// fetch the resulting rows as an array
$ducks = mysqli_fetch_all($result, MYSQLI_ASSOC);
// free the result from memory;
mysqli_free_result($result);
// close the connection
mysqli_close($conn);

?>


<!DOCTYPE html>
<html> 
<?php include 'components/head.php'; ?>    
<body>
    <?php include 'components/nav.php'; ?>
    <main>
   
    <h1>Welcome to the world of ducks and their favorite  things!</h1>
<section class="duck-grid">    
    <div class="grid-container">

    <?php foreach($ducks as $duck) : ?>
        <div class="grid-item">
           <div class="card">
           <div class="card-image"><img src="get-image.php?id=<?php echo $duck["id"] ?>" width="200" height="200"></div>
                    <div class="content"></div>
                        <h2><?php echo $duck["name"]; ?></h2>
                        
                        <p><strong>Favorite Foods:</strong></p>
                        <p><?php echo $duck["favorite_foods"]; ?></p>

                        <p><strong>Biography:</strong></p>
                        <p><?php echo $duck["biography"]; ?></p>
                        </div>
                    </div>
               <?php endforeach ?>
           </div>
        </div>
</section>
   
</div>
</main> 
<?php include 'components/footer.php'; ?>  
</body>
</html>