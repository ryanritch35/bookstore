<?php
    
    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');
    session_start();
     $typed_inputs = array('user_id' =>'', 'book_id'=>'', 'order_id'=>'', 'comment'=>'', 'rating'=>'', 'amount'=>'' , 'book_count'=>'','created_at'=>array());)
    
        $publisher_name = htmlspecialchars($_SESSION['order_history']);
    
    $sql = "SELECT $tbl_order_history.user_id, $tbl_order_history.book_id, $tbl_order_history.order_id, $tbl_order_history.comment, $tbl_order_history.rating, $tbl_order_history.amount, $tbl_order_history.book_count,$tbl_order_history.created_at,  FROM $tbl_order_history WHERE order_history = '$order_history'";

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
    
    if(isset($_POST['order_add'])){
        $b_userid = htmlspecialchars($_POST['user_id']);
        $b_bookid = htmlspecialchars($_POST['book_id']);
        $b_orderid = htmlspecialchars($_POST['order_id']);
        $b_comment = htmlspecialchars($_POST['comment']);
        $b_rating = htmlspecialchars($_POST['rating']);
        $b_bookcount = htmlspecialchars($_POST['book_count']);
        $b_createdat = htmlspecialchars($_POST['created_at']);
        
        $names = (isset($_POST['availabe_orders'])) ? $_POST['availabe_orders'] : array();
        
        $typed_inputs['user_id'] = $b_userid;
        $typed_inputs['book_id'] = $b_bookid;
        $typed_inputs['order_id'] = $b_orderid;
        $typed_inputs['comment'] = $b_comment;
        $typed_inputs['rating'] = $b_rating;
        $typed_inputs['book_count'] = $b_bookcount;
        $typed_inputs['created_at'] = $b_createdat;
        $typed_inputs['order'] = create_order_array_to_return_checked_status($names);
        print_r($typed_inputs);
    

    <?php include('../templates/footer.php') ?>
</html>
