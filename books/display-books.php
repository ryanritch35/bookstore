<?php

    // Getting all the books with Publishers
    if(basename($_SERVER['PHP_SELF']) =='index.php'){
        $sql = "SELECT tbl_books.book_id, tbl_books.isbn, tbl_books.title, tbl_books.genre, tbl_books.book_type, tbl_books.price, tbl_books.rating, tbl_books.publisher_name FROM tbl_books";

        $result = mysqli_query($conn, $sql);
        $display_books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

?>




<table>
    <th>Title</th>
    <th>Add</th>
    <?php foreach($display_books as $book): ?>
        <tr>
            <td>
                <p style="font-size: 18px; font-weight: bold;" ><?php echo $book['title'] ?></p>
                <div style="font-size: 14px;">
                    <p><b>ISBN:</b>&emsp;<?php echo $book['isbn'] ?> &emsp;<b>Genre:</b>&emsp;<?php echo $book['genre'] ?> &emsp;<b>Type:</b>&emsp;<?php echo determine_Booktype($book['book_type']); ?></p>
                    <p><b>Price:</b>&emsp;<?php $number = sprintf('%.2f', $book['price']); echo '$'.$number; ?> &nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<b>Rating:</b>&emsp;<?php echo $book['rating'] ?></p>
                    <p><b>Authors:</b>&emsp;<?php  echo get_author_for_each_book($book['book_id'], $conn);?></p>
                </div>
            </td>
            <td style="text-align:center;">
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <button style="font-size: 20px; text-align: center; border-radius: 50%;" type="submit" name="add_to_cart" value="" <?php if(isset($_SESSION['publisher_logged_in']) && $_SESSION['publisher_logged_in']==True) echo 'disabled'; ?>><b>&#43;</b></button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>

</table>