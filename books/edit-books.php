<?php
    include('../config/db_connection.php');
    include('../variables/variables.php');

    $current_book = array('id'=>'','title' =>'', 'isbn'=>'', 'price'=>'');
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
                    $current_book['id'] = $edit[0]['book_id'];
                    $current_book['title'] = $edit[0]['title'];
                    $current_book['isbn'] = $edit[0]['isbn'];
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

    if(isset($_POST['book_edit'])){
        $b_title = htmlspecialchars($_POST['book_name']);
        $b_isbn = htmlspecialchars($_POST['book_isbn']);
        $b_price = htmlspecialchars($_POST['book_price']);
        $b_id = $current_book['id'];

        $sql = "UPDATE tbl_books SET title = '$b_title', isbn = '$b_isbn', price = '$b_price' WHERE book_id= '$b_id';"; 

        if(mysqli_query($conn, $sql)){
            $current_book['id'] = '';
            $current_book['title'] = '';
            $current_book['isbn'] = '';
            $current_book['price'] = '';
            header('refresh: 0; url = ../publishers/publisher.php');
        } else{
            echo '<script>alert("Unable to Update Book Data")</script>';
        }
    } else if(isset($_POST['cancel'])){
        header('Location: ../publishers/publisher.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php include('../templates/header.php'); ?>

    <div class="center">
        <div style="padding: 10px;">
            <h3>Current Book Details</h3>
            <label for="cur_title">Title:</label><span name="cur_title"><?php echo $current_book['title']; ?></span><br>
            <label for="cur_isbn">ISBN:</label><span name="cur_isbn"><?php echo $current_book['isbn']; ?></span><br>
            <label for="cur_price">Price:</label><span name="cur_price"><?php $pr=sprintf('%.2f', $current_book['price']);  echo '$'.$pr;?></span><br>
            
            <h3>Edit Book Details</h3>
            <?php include('../books/add-books.php'); ?>
        </div>
    </div>

    <?php include('../templates/footer.php'); ?>
    
</body>
</html>