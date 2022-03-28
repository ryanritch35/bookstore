<?php
    
    include ('../config/db_connection.php');
    $user_id = htmlspecialchars($_SESSION['user_id']);
    
    $sql = 'SELECT * FROM tbl_shopping_cart WHERE user_id=1;';
    
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

</div>
</form>
<a href="..premium/premium-payment-info.php">Enter Payment</a>
<div id="submit_order">
<button onclick="location.href='..Orders/Order-history.php'">Submit Order</button>
?php
if(isset($_POST['submit']))
{
    $SQL = "INSERT INTO tbl_order_history (user_id , book_id, amount,book_count) VALUES ()";
    $result = mysql_query($SQL);
}

function is_premium( $is_premium,) {
    if(is_premium = 1)
    {
        INSERT INTO tbl_order_history (amount)
        VALUES(amount-5);
    }
    
    
    ?>
    
    </form>
    
    </div>
    
    <?php include('../templates/footer.php') ?>
    </html>
