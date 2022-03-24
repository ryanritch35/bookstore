<?php
    
    include ('../config/db_connection.php');
    $user_id = htmlspecialchars($_SESSION['user_id']);
    
    $sql = 'SELECT * FROM tbl_shopping_cart;';
    
    $result = mysqli_query($conn,$sql);
    $cart= mysqli_fetch_all($result,MYSQLI_ASSOC);
    mysqli_free_result($result);
    print_r($cart);
    ?>

    <table>
    <th>Book_ID</th>;
    <th>Book_count</th>;
    <th>Price</th>;
    <?php  foreach($cart as $c):    ?>

    <tr>
<td><?php echo $c['book_id']; ?>

    </td>
    <td><?php echo $c['book_count']; ?>  </td>
 <td><?php echo '$'.$c['amount']; ?>  </td>
    </tr>

<?php endforeach;?>
</table>


<!DOCTYPE html>
<html lang="en">
<?php include('../templates/header.php') ?>

<div class="submit-buttons">
</div>
</form>
<a href="..premium/premium-payment-info.php">Enter Payment</a>
<a href="..Orders/Order-history.php">Order History</a>
</div>

<?php include('../templates/footer.php') ?>
</html>
