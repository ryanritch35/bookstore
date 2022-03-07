<?php 
    include('../config/db_connection.php');
    include('../variables/variables.php');
    $is_found = False;
    if(isset($_GET['search_title']) && isset($_GET['search_author'])){
        $search_title = $_GET['search_title'];
        $search_author = $_GET['search_author'];
        $sql = "";

        if($search_author == "" && $search_title==""){
            // header('Location: ../index.php');
            $is_found = False;
        } else{
            if($search_author != "" && $search_title=="" ){
                /*
                    SELECT * FROM tbl_books WHERE book_id IN (SELECT book_id FROM tbl_author_books WHERE author_id IN (SELECT author_id FROM tbl_is_author WHERE author_name LIKE '%Jo%'));

                */
                $sql = "SELECT * FROM $tbl_books WHERE book_id IN (SELECT book_id FROM $tbl_author_books WHERE author_id IN (SELECT author_id FROM $tbl_is_author WHERE author_name LIKE '%$search_author%'));";

            } else if ($search_author == "" && $search_title!=""){
                $sql = "SELECT * FROM $tbl_books WHERE title LIKE '%$search_title%';";
            } else {
                $sql = "SELECT * FROM $tbl_books WHERE book_id IN (SELECT book_id FROM $tbl_author_books WHERE author_id IN (SELECT author_id FROM $tbl_is_author WHERE author_name LIKE '%$search_author%') AND title LIKE '%$search_title%');";

            }

            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $is_found = True;
                $search_books = mysqli_fetch_all($result, MYSQLI_ASSOC);
                mysqli_free_result($result);
            } else {
                $is_found = False;
            }
        }
    }

?>

<?php 
    include('../templates/header.php');
    include('./search-books.php');
    include('../functions/functions.php');
    function determine_Booktype($type){
        include("../variables/variables.php");
        return $book_types[$type];
    }
    if($is_found){
        $display_books= $search_books;
        include('./display-books.php'); 
    } else{
        echo "<h3> No search result... </h3>";
    }

    include('../templates/footer.php');
?>