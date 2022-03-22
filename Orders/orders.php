<?php
    
    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');
    session_start();
    
     $typed_inputs = array('user_id' =>'', 'book_id'=>'', 'order_id'=>'', 'comment'=>'', 'rating'=>'', 'amount'=>'' , 'book_count'=>'','created_at'=>array());)
    
        $orders = htmlspecialchars($_SESSION['order_history']);
    $sql = "SELECT * FROM $tbl_order_history WHERE user_id = '$user_id'";
    //  Display vertically
    echo "<br><table>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><th>User ID</th><td>{$row['user_id']}</td></tr>";
        echo "<tr><th>Book Id</th><td>{$row['book_id']}</td></tr>";
        echo "<tr><th>Order ID</th><td>{$row['Order_id']}</td></tr>";
        echo "<tr><th>Comment</th><td>{$row['comment']}</td></tr>";
        echo "<tr><th>Rating</th><td>{$row['rating']}</td></tr>";
        echo "<tr><th>Comment</th><td>{$row['comment']}</td></tr>";
        echo "<tr><th>Amount</th><td>{$row['amount']}</td></tr>";
        echo "<tr><th>Book Count</th><td>{$row['book_count']}</td></tr>";
        echo "<tr><th>Created At</th><td>{$row['created_at']}</td></tr>";

    $result = mysqli_query($conn, $sql);
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
     mysqli_free_result($result);

    
    echo '<br><br><br>';
    print_r($orders);
    echo '<br><br><br>';
    if(isset($_POST['delete_order'])){
        $id_to_del =  htmlspecialchars($_POST['id_to_del']);
        $sql = "DELETE FROM $tbl_order_history WHERE order_id = '$id_to_del';";
        
        if(mysqli_query($conn, $sql)){
            echo '<script>alert("Successfully deleted!")</script>';
            header('refresh: 0; url = ./orders.php');
        } else {
            echo '<script>alert("Unable to delete selected order!")</script>';
        }
    }
    
   

    <?php include('../templates/footer.php') ?>
</html>
