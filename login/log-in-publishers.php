<?php
    include_once('../config/db_connection.php');
    session_start();
    $typedIn = array('user_name'=>'');
    print_r($typedIn);
    print_r($_SESSION);
    if(isset($_POST['publisher_login'])){
        $publisher_username = htmlspecialchars($_POST['publisher_username']);
        $publisher_password = htmlspecialchars($_POST['publisher_password']);
        $typedIn['user_name'] = $publisher_username;

        $sql = "SELECT * FROM tbl_publishers WHERE pub_username = '$publisher_username' AND pub_password='$publisher_password'";

        $result = mysqli_query($conn, $sql);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $total_users = mysqli_num_rows($result);
        mysqli_free_result($result);
        mysqli_close($conn);
        
        if($total_users == 0){
            echo '<script>alert("Invalid Username or Password")</script>';
        } else {
            $typedIn['user_name'] = '';
            $_SESSION['publisher_name'] = $users[0]['pub_name'];
            $_SESSION['publisher_address'] = $users[0]['pub_address'];
            $_SESSION['publisher_phone'] = $users[0]['pub_phone'];
            $_SESSION['publisher_logged_in'] = True;
            header('Location: ../publishers/publisher.php');
        }

    }else if(isset($_POST['cancel'])){
        header('Location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('../templates/header.php') ?>
    <div class="publisher-log-in center">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h3>Publishers Log In</h3>
            <div class="publisher-username">
                <label for="publisher-username">Username: </label>
                <input type="text" name="publisher_username" id="" placeholder="Enter username" value="<?php echo $typedIn['user_name']; ?>">
            </div>
            <div class="publisher-password">
                <label for="publisher-password">Pasword: </label>
                <input type="password" name="publisher_password" id="" placeholder="Enter password">
            </div>

            <div class="submit-buttons">
                <button type="submit" name="publisher_login">Log in</button>
                <button type="submit" name="cancel" value="Cancel">Cancel </button>
            </div>
        </form>

        <a href="../signup/publishers-signup.php">Don't have an account?</a>
    </div>
    <?php include('../templates/footer.php') ?>
</html>