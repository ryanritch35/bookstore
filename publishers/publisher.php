<?php

    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');
 
    session_start();


    $min_book_count = 1;
    $max_book_count = 999;
    $min_price = 0;
    $max_price = 10000;
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


    if(isset($_POST['book_add'])){
        $b_title = htmlspecialchars($_POST['book_name']);
        $b_isbn = htmlspecialchars($_POST['book_isbn']);
        
        $b_genre = htmlspecialchars($_POST['book_genre']);
        $b_type = htmlspecialchars($_POST['book_type']);
        $b_price = htmlspecialchars($_POST['book_price']);
        
        if(check_if_book_exist($b_isbn, $b_type, $conn)){

            $sql = "INSERT INTO tbl_books(isbn, title, genre, book_type, price, publisher_name) VALUES('$b_isbn', '$b_title', '$b_genre', '$b_type', '$b_price', '$publisher_name')";


            if(mysqli_query($conn, $sql)){
                $last_inserted_book_id = mysqli_insert_id($conn);
                // function changed here
                $sql = build_multi_sql_authors_id_included($last_inserted_book_id,$available_authors);
                if(mysqli_multi_query($conn, $sql)){
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
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="book_name">
                <label for="book_name">Title;</label>
                <input type="text" name="book_name" id="" placeholder="Enter Title" required>
            </div>
            <div class="book_isbn">
                <label for="book_isbn">ISBN:</label>
                <input type="text" name="book_isbn" id="" placeholder="Enter ISBN" req<input type="text" name="book_name" id="" placeholder="Enter Title" required>
            </div>
            
            <div class="book_genre">
                <label for="book_genre">Genre:</label>
                <select type="text" name="book_genre" id="" placeholder="Enter Genre">
                    <?php  foreach($book_genres as $genre): ?>
                        <option value="<?php echo $genre; ?>"> <?php echo $genre; ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <div class="book_type">
                <label for="book_type">Type:</label>
                <select type="text" name="book_type" id="" placeholder="Enter Book Type"> 
                    <?php $index = 0; foreach($book_types as $type): ?>
                        <option value="<?php echo $index; ?>"> <?php echo $type; ?></option>

                    <?php $index++; endforeach;?>
                </select>
            </div>
            <div class="book_price">
                <label for="book_price">Price:</label>
                <input type="number" name="book_price" id="" placeholder="0.00" step="0.01" min="<?php echo $min_price; ?>" max="<?php echo $max_price; ?>" required>
            </div>

            <div class="book_author">
                <label for="book_author">Authors:</label>
                <!-- <input type="text" name="book_author" id="" placeholder="Enter Author Name"> -->
                <!-- <select multiple type="text" name="availabe_authors" id="" placeholder="Choose Author names"> -->
                <div class="book_author-checkbox">
                    <?php $index = 0; foreach($available_authors as $authors): ?>
                        <input type="checkbox" name="availabe_authors[]" value="<?php echo $authors['author_name']; ?>"> <?php echo $authors['author_name']; ?></input><br>
                    <?php $index++; endforeach;?>
                <!-- </select> -->
                </div>
                <p>Not listed? <a href="#">Register here</a></p>
            </div>
            <div class="form-add">
                <button type="submit" name="book_add" value="Add">Add</button>  
            </div>
           
        </form>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <button type="submit" name="log_out" value="Log out">Log out</button>
        </form>
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
                <td><?php echo $book['title'] ?></td>
                <td><?php echo $book['isbn'] ?></td>
                <td><?php echo $book['genre'] ?></td>
                <td><?php echo determine_Booktype($book['book_type']); ?></td>
                <td><?php $number = sprintf('%.2f', $book['price']); echo '$'.$number;  ?></td>
                <td><?php echo $book['rating'] ?></td>
                <td><?php  echo get_author_for_each_book($book['book_id'], $conn);?></td>

                <td style="text-align:center;">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <button style="font-size: 20px; text-align: center; border-radius: 50%; color: red; border: 2px solid red;" type="submit" name="delete_book" value=""><b>&#8722;</b></button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php include('../templates/footer.php') ?>
</html>