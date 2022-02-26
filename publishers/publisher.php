<?php

    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');
 
    session_start();
    $typed_inputs = array('title' =>'', 'isbn'=>'', 'genre'=>'', 'type'=>'', 'price'=>'', 'authors'=>array());


    $publisher_name = htmlspecialchars($_SESSION['publisher_name']);

    $sql = "SELECT tbl_books.book_id, tbl_books.isbn, tbl_books.title, tbl_books.genre, tbl_books.book_type, tbl_books.price, tbl_books.rating, tbl_books.publisher_name FROM tbl_books WHERE publisher_name = '$publisher_name'";

    $result = mysqli_query($conn, $sql);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    // This is for available authors
    $sql = "SELECT DISTINCT author_name, user_id from tbl_authors ORDER BY author_name;";
    $result = mysqli_query($conn, $sql);
    $available_authors = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    print_r($available_authors);

    if(isset($_POST['delete_book'])){
        $id_to_del =  htmlspecialchars($_POST['id_to_del']);
        $sql = "DELETE FROM tbl_books WHERE book_id = '$id_to_del';";

        if(mysqli_query($conn, $sql)){
            echo '<script>alert("Successfully deleted!")</script>';
            header('refresh: 0; url = ./publisher.php');
        } else {
            echo '<script>alert("Unable to delete selected book!")</script>';
        }
    }


    if(isset($_POST['book_add'])){
        $b_title = htmlspecialchars($_POST['book_name']);
        $b_isbn = htmlspecialchars($_POST['book_isbn']);
        
        $b_genre = htmlspecialchars($_POST['book_genre']);
        $b_type = htmlspecialchars($_POST['book_type']);
        $b_price = htmlspecialchars($_POST['book_price']);
        $names = (isset($_POST['availabe_authors'])) ? $_POST['availabe_authors'] : array();

        $typed_inputs['title'] = $b_title;
        $typed_inputs['isbn'] = $b_isbn;
        $typed_inputs['genre'] = $b_genre;
        $typed_inputs['type'] = $b_type;
        $typed_inputs['price'] = $b_price;
        $typed_inputs['authors'] = create_author_array_to_return_checked_status($names);
        

        if(publisher_book_info_validation($typed_inputs)){    
            if(check_if_book_exist($b_isbn, $b_type, $conn)){

                $sql = "INSERT INTO tbl_books(isbn, title, genre, book_type, price, publisher_name) VALUES('$b_isbn', '$b_title', '$b_genre', '$b_type', '$b_price', '$publisher_name')";


                if(mysqli_query($conn, $sql)){
                    $last_inserted_book_id = mysqli_insert_id($conn);
                    // function changed here
                    $sql = build_multi_sql_authors_id_included($last_inserted_book_id,$available_authors, $names);
                    if(mysqli_multi_query($conn, $sql)){
                        $typed_inputs['title'] = '';
                        $typed_inputs['isbn'] = '';
                        $typed_inputs['genre'] = '';
                        $typed_inputs['type'] = '';
                        $typed_inputs['price'] = '';
                        $typed_inputs['authors'] = array();
                        header('refresh: 0; url = ./publisher.php');
                    } else{
                        echo '<script>alert("Unable to add new authors")</script>';
                    }
                } else{
                    echo '<script>alert("Unable to insert new book")</script>';
                }
            } else{
                echo '<script>alert("Book already exists!")</script>';
            }
        } else {
            echo '<script>alert("Please insert complete info!")</script>';
        }
    } else if(isset($_POST['log_out'])){
        unset($_SESSION['publisher_name']);
        unset($_SESSION['publisher_address']);
        unset($_SESSION['publisher_phone']);
        unset($_SESSION['publisher_logged_in']);
        header('Location: ../index.php');
    }
?>

    <?php 
        include('../templates/header.php');    
        
        function determine_Booktype($type){
            include("../variables/variables.php");
            return $book_types[$type];
        }
    ?>
    <!-- LOL SMTHING ADDED HERE -->
    <h1>Welcome <?php echo $_SESSION['publisher_name']; ?></h1> <hr>
    <div class="publisher-center">
        <?php include('../books/add-books.php'); ?>
    </div>
    <hr>
    <h3>Published books</h3><br>
    <table>
        <tr>
            <th>Publisher</th>
            <th>Title</th>
            <th>ISBN</th>
            <th>Genre</th>
            <th>Book Type</th>
            <th>Price</th>
            <th>Rating</th>
            <th>Authors</th>
            <th>Remove</th>
        </tr>

        <?php foreach($books as $book): ?>
            <tr>
                <td><?php echo $book['publisher_name'] ?></td>
                <td><a href="../books/edit-books.php?id=<?php echo $book['book_id'] ?>"><?php echo $book['title'] ?></a></td>
                <td><?php echo $book['isbn'] ?></td>
                <td><?php echo $book['genre'] ?></td>
                <td><?php echo determine_Booktype($book['book_type']); ?></td>
                <td><?php $number = sprintf('%.2f', $book['price']); echo '$'.$number;  ?></td>
                <td><?php echo $book['rating'] ?></td>
                <td><?php  echo get_author_for_each_book($book['book_id'], $conn);?></td>

                <td style="text-align:center;">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <input type="hidden" name= "id_to_del" value="<?php echo $book['book_id']; ?>">
                        <button style="font-size: 20px; text-align: center; border-radius: 50%; color: red; border: 2px solid red;" type="submit" name="delete_book" value=""><b>&#8722;</b></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php include('../templates/footer.php') ?>
</html>