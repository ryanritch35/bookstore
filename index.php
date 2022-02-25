<?php
    session_start();
    
    print_r($_SESSION);

    include('./config/db_connection.php');

    function determine_Booktype($type){
        include("./variables/variables.php");
        return $book_types[$type];
    }

    if(isset($_POST['publishers'])){
        if(isset($_SESSION['publisher_logged_in']) && $_SESSION['publisher_logged_in']==True){
            header(('Location: ./publishers/publisher.php'));
        }else{
            header('Location: ./login/log-in-publishers.php');
        }
    } else if (isset($_POST['users'])){
        // this is where user log in page goes
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('./templates/header.php'); ?>

    <div class="index-center">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h3> Log-in</h3>
            <div class="log-in-type">
                <button type="submit" name="users" <?php if(isset($_SESSION['publisher_logged_in']) && $_SESSION['publisher_logged_in']==True) echo 'disabled'; ?> >Users</button>
                <button type="submit" name="publishers">Publishers</button>
            </div>
        </form>
    </div>
    <hr>
    <h3>Availabe Books</h3>
    <?php include('./books/display-books.php') ?>

    <?php include('./templates/footer.php'); ?>
</html>