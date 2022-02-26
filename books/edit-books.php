<?php
    include('../config/db_connection.php');
    include('../variables/variables.php');

    $current_book = array('title' =>'', 'isbn'=>'', 'genre'=>'', 'type'=>'', 'price'=>'');
    if($_SERVER['PHP_SELF'] =='/bookstore/books/edit-books.php'){
        echo basename($_SERVER['PHP_SELF']);
    }

    if(isset($_GET['id'])){

        if($_GET['id'] != ""){
            $edit_book_id = (int)htmlspecialchars($_GET['id']);

            if($edit_book_id > 0){
                $sql = "SELECT book_id, isbn, title, genre, book_type, price FROM tbl_books WHERE book_id = '$edit_book_id';";

                $result = mysqli_query($conn, $sql);
                $rows = mysqli_num_rows($result);

                if($rows > 0){
                    $edit = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    $current_book['title'] = $edit[0]['title'];
                    $current_book['isbn'] = $edit[0]['isbn'];
                    $current_book['genre'] = $edit[0]['genre'];
                    $current_book['type'] = $edit[0]['book_type'];
                    $current_book['price'] = $edit[0]['price'];

                    print_r($current_book);
                } else {
                    echo '<h1>ERROR 404: NO SUCH BOOK EXIST! </h1><br>';
                }
                mysqli_free_result($result);
            } else {
                echo '<h1>ERROR THE BOOK ID CANNOT BE FOUND! </h1><br>';
            }
        }else {
            echo '<h1>ERROR THE BOOK ID CANNOT BE FOUND! </h1><br>';
        }
        
    } else{
        echo '<h1>ERROR THE BOOK ID CANNOT BE FOUND! </h1><br>';
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php include('../templates/header.php'); ?>

    <?php include('../books/add-books.php'); ?>

    <?php include('../templates/footer.php'); ?>
    
</body>
</html>