<?php
    include("config/db_connect.php");

    $errors = array("email" => "", "title" => "", "tags" => "", "price" => "");
    $email = $title = $tags = $price =  "";
    if(isset($_POST["submit"])){
        //check email
        if(empty($_POST["email"])){
            $errors["email"] =  "An email is required <br />";
        }else{
            $email = $_POST["email"];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors["email"] =  "Not a valid email <br />";
            }
        }
        // Check title
        if(empty($_POST["title"])){
            $errors["title"] =  "A title is required <br />";
        }else{
            $title = $_POST["title"];
            if(!preg_match("/^[a-zA-Z\s]+$/", $title)){
                $errors["title"] =  "Invalid title, must be spaces and alphabets only <br />";
            }
        }
        // Check tags
        if(empty($_POST["tags"])){
            $errors["tags"] =  "Tags are required <br />";
        }else{
            $tags = $_POST["tags"];
            if(!preg_match("/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/", $tags)){
                $errors["tags"] =  "Tags must be comma seperated <br />";
            }
        }

        // Check Price
        if(empty($_POST["price"])){
            $errors["price"] =  "Price is required <br />";
        }else{
            $price = $_POST["price"];
        }

        if(!array_filter($errors)){
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $title = mysqli_real_escape_string($conn, $_POST["title"]);
            $tags = mysqli_real_escape_string($conn, $_POST["tags"]);
            $price = mysqli_real_escape_string($conn, $_POST["price"]);

            // Create sql query
            $sql = "INSERT INTO books (title, tags, email, price) VALUES('$title', '$tags', '$email', '$price')";

            // Save to db and check
            if(!mysqli_query($conn, $sql)){
                echo "Query Error: ". mysqli_error($conn);
            }else{
                header("Location: index.php");
            }
        }

        // end of POST check

    }
?>
<!DOCTYPE html>
<html lang="en">

<?php include("templates/header.php");?>
    <section class="container grey-text">
        <h5 class="center">Add a Book</h5>
        <form action="add.php" class="white" method="POST">
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
                    <label for="email">Your Email</label>
                    <div class="red-text">
                        <?php echo $errors["email"]; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
                    <label for="title">Book Title</label>
                    <div class="red-text">
                        <?php echo $errors["title"]; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div  class="input-field col s12">
                    <input type="text" name="tags" value="<?php echo htmlspecialchars($tags); ?>">
                    <label for="tags">Book Tags(comma seperated)</label>
                    <div class="red-text">
                        <?php echo $errors["tags"]; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div  class="input-field col s12">
                    <input type="number" name="price" value="<?php echo htmlspecialchars($price); ?>">
                    <label for="price">Price</label>
                    <div class="red-text">
                        <?php echo $errors["price"]; ?>
                    </div>
                </div>
            </div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn z-depth-0">
            </div>
        </form>
    </section>
<?php include("templates/footer.php");?>
</html>