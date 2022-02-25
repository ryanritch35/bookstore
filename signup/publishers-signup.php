<?php
    include_once('../config/db_connection.php');


    if(isset($_POST['publisher_signup'])){
        $pub_name = htmlspecialchars($_POST['publisher_singup_name']);
        $pub_username = htmlspecialchars($_POST['publisher_signup_username']);
        $pub_password = htmlspecialchars($_POST['publisher_signup_password']);
        $pub_address = htmlspecialchars($_POST['publisher_signup_address']);
        $pub_phone = htmlspecialchars($_POST['publisher_signup_phone']);

        $sql = "INSERT INTO tbl_publishers VALUES ('$pub_name','$pub_username', '$pub_password', '$pub_address', '$pub_phone')";

        if(mysqli_query($conn, $sql)){
            $_SESSION['publisher_name'] = $pub_name;
            $_SESSION['publisher_address'] = $pub_address;
            $_SESSION['publisher_phone'] = $pub_phone;
            header('Location: ../login/log-in-publishers.php');
        } else{
            echo '<script>alert("Username Or Organizaiton already exits!")</script>';
        }
    } else if(isset($_POST['cancel_signup'])){
        header('Location: ../login/log-in-publishers.php');
    }

    

?>

<!DOCTYPE html>
<html lang="en">
    <?php include('../templates/header.php') ?>
    <div class="center">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h3>Publishers Sign Up</h3>
            <div class="publisher_signup-name">
                <label for="publisher_singup_name">Name: </label>
                <input type="text" name="publisher_singup_name" id="" placeholder="organization name">
            </div>
            <div class="publisher-signup-username">
                <label for="publisher_signup_username">Username: </label>
                <input type="email" name="publisher_signup_username" id="" placeholder="email address">
            </div>
            <div class="publisher-signup-password">
                <label for="publisher_signup_password">Password: </label>
                <input type="password" name="publisher_signup_password" id="" placeholder="password">
            </div>
            <div class="publisher-signup-address">
                <label for="publisher_signup_address">Address: </label>
                <input type="text" name="publisher_signup_address" id="" placeholder="your address">
            </div>
            <div class="publisher-signup-phone">
                <label for="publisher_signup_phone">Phone: </label>
                <input type="tel" name="publisher_signup_phone" id="" placeholder="your contact phone" >
            </div>
            <div class="submit-buttons">
                    <button type="submit" name="publisher_signup">Sign up</button>
                    <button type="submit" name="cancel_signup" value="Cancel">Cancel </button>
            </div>
        </form>
    </div>
    <?php include('../templates/footer.php') ?>
</html>