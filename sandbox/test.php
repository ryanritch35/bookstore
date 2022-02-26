<?php
    include('../config/db_connection.php');
    include('../functions/functions.php');
    $arr = array("John Smith", "Stacy Saga");
    get_author_user_id($arr, $conn);

    // This is for available authors
    $sql = "SELECT DISTINCT author_name, user_id from tbl_authors;";
    $result = mysqli_query($conn, $sql);
    $available_authors = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    print_r($available_authors);
    echo '<br><br><br>';

    $map = array();
    foreach ($available_authors  as $a){
        $map[$a['author_name']] = $a['user_id'];
    }
    print_r($map);
    echo '<br><br><br>';

    echo "id of Oskar Mclellan:".$map['Oskar Mclellan'];
    echo '<br><br><br>';



    if(isset($_POST['submit'])){
        $names = $_POST['availabe_authors'];
        // foreach ($names as $name){ 
        //     echo $name."<br />";
        // }
        echo build_multi_sql_authors_id_included("1", $available_authors, $names);
    }




    
?>

<br><br><br>
<hr>
<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
<div class="book_author">
            <label for="book_author">Author:</label>
            <!-- <input type="text" name="book_author" id="" placeholder="Enter Author Name"> -->
            <!-- <select multiple type="text" name="availabe_authors" id="" placeholder="Choose Author names"> -->
                <?php $index = 0; foreach($available_authors as $authors): ?>
                    <input type="checkbox" name="availabe_authors[]" value="<?php echo $authors['author_name']; ?>"> <?php echo $authors['author_name']; ?></input>
                <?php $index++; endforeach;?>
            <!-- </select> -->
            <p>Not listed? <a href="#">Register here</a></p>
        </div>
        <div class="form-add">  
            <button type="submit" name="submit" value="Submit">Add</button>
        </div>
</form>