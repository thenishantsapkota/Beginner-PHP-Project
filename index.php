<?php
    // Database Connection
    include("config/db_connect.php");
    // Query for all books
    $sql = "SELECT title, id, tags, email, price FROM books";

    // Make query and fetch result
    $result = mysqli_query($conn, $sql);

    // Fetch the results in array form
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<?php include("./templates/header.php");?>
    <h4 class="center grey-text">List of Books</h4>
    <div class="container">
        <div class="row">
            <?php foreach($books as $book): ?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <img src="images/book.png" height="100" width="100">
                            <h5 style="font-weight: bold;"><?php echo htmlspecialchars($book["title"]) ?></h5>
                            <p>Tags:</p>
                            <div>
                                <ul class="collection">
                                <?php foreach(explode(",", $book["tags"]) as $tag): ?>
                                    <li class="collection-item"><?php echo htmlspecialchars($tag); ?></li>
                                <?php endforeach ?>
                                </ul>
                            </div>
                            <div>
                                Price: <strong>Rs. <?php echo htmlspecialchars($book["price"]);?></strong>
                            </div>
                        </div>
                        <div class="card-action right-align">
                            <a href="details.php?id=<?php echo $book["id"]; ?>">More Info</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
<?php include("./templates/footer.php");?>
</html>