<?php
    include("config/db_connect.php");
    if(isset($_POST["delete"])){
        $idToDelete = mysqli_real_escape_string($conn, $_POST["id_to_delete"]);
        $sql = "DELETE FROM books WHERE id=$idToDelete";
        if(mysqli_query($conn, $sql)){
            //success
            header("location:index.php");
        }else{
            echo "Query Error: ". mysqli_error($conn);
        }
    }
    // Check if id is present
    if(isset($_GET["id"])){
        $id = mysqli_real_escape_string($conn, $_GET["id"]);

        // SQL
        $sql = "SELECT * FROM books WHERE id=$id";

        $result = mysqli_query($conn, $sql);

        $book = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($conn);

    }
?>
<!DOCTYPE html>
<html lang="en">
<?php include("templates/header.php");
 if($book): ?>
<div class="container center">
    <h3>Details</h3>
    <div class="card z-depth-0">
        <div class="card-content center">
            <div class="row">
                <h4><?php echo htmlspecialchars($book["title"]) ?></h4>
            </div>
            <div class="row">
                <h6>Created by: <strong><?php echo htmlspecialchars($book["email"]); ?></strong></h6>
            </div>
            <div class="row">
                <h6>Created at: <strong><?php echo date($book["created_at"]); ?></strong></h6>
            </div>
            <div class="row">
                <h6>Tags: <strong><?php echo htmlspecialchars($book["tags"]); ?></strong></h6>
            </div>
            <div class="row">
                <h6>Price: <strong>Rs. <?php echo htmlspecialchars($book["price"]); ?></strong></h6>
            </div>
        </div>
        <div class="card-action">
            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $book["id"] ?>">
                <input type="submit" name="delete" value="delete" class="btn z-depth-0">
            </form>
        </div>
    </div>
</div>
<?php else: ?>
    <div class="container center">
        <img class="center" src="https://stories.freepiklabs.com/storage/26832/oops-404-error-with-a-broken-robot-rafiki-2849.png" alt="" width="400" height="400"> 
    </div>
    <h5 class="center">No book found!</h5>
<?php endif;?>
<?php include("templates/footer.php");?>
</html>