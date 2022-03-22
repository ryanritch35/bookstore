<?php
    
    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');
    session_start();
    
    $f_name = htmlspecialchars($_SESSION['f_name']);
    $l_name = htmlspecialchars($_SESSION["l_name"]);
    $user_id = htmlspecialchars($_SESSION['user_id']);
    
     $sql = "SELECT * FROM $shopping_cart WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    //  Display vertically
    echo "<br><table>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><th>User ID</th><td>{$row['user_id']}</td></tr>";
        echo "<tr><th>Book Id</th><td>{$row['book_id']}</td></tr>";
        echo "<tr><th>Book Count</th><td>{$row['book_count']}</td></tr>";
          echo "<tr><th>Amount</th><td>{$row['amount']}</td></tr>";
        echo "<tr><th>Status</th><td>{$row['status']}</td></tr>";
        echo "<tr><th>Created At</th><td>{$row['created_at']}</td></tr>";
    }
    echo "</table>";
    //  Free result
    mysqli_free_result($result);
    
        if(isset($_POST['submit'])) {
            $query = mysql_query("INSERT INTO tbl_order_history VALUES  (user_id,book_id,count,book_count,amount,created_at)");        }
    ?>
    mysqli_free_result($result);
    <!DOCTYPE html>
    <html lang="en">
    <?php include('../templates/header.php') ?>
<html>
  <div class="Finish Order">
    <button type="button" name="Submit_Order "></button>
<button type="button" name="Add_Payment">Add Payment</button>
      </form>
<a href="../tbl_order_history/order_history.php">Submit Order</a>
<a href ="../users/user-payment-info.php">add payment</a>
</div>
<?php include('../templates/footer.php') ?>
</html>
