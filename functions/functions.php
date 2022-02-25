<?php

    function get_author_user_id($author_arr, $conn){
        $return_ids = array();
        foreach($author_arr as $author){
            $full_name = explode(' ', $author);
            $f_name = preg_replace("/\s+/", "", $full_name[0]);
            $l_name = preg_replace("/\s+/", "", $full_name[1]);

            $sql = "SELECT user_id FROM tbl_users WHERE f_name = '$f_name' AND l_name= '$l_name';";
            $result = mysqli_query($conn, $sql);
            $ids = mysqli_fetch_row($result);
            array_push($return_ids, $ids[0]);
            mysqli_free_result($result);
        }
        print_r($return_ids);
    }

    function build_multi_sql_authors($latest_index){
        include('../config/db_connection.php');
        // doesn't support user_id yet
        $multi_authors = "";
        $b_author = htmlspecialchars($_POST['book_author']);
        $author_arr = explode(',', $b_author);
        $ids = get_author_user_id($author_arr, $conn);
        $index = 0;
        foreach($author_arr as $author){
            $multi_authors .= "INSERT INTO tbl_authors VALUES ('$author', '$latest_index', $ids[$index]); ";
            $index = $index + 1;
        }
        return $multi_authors;
    }

    function get_author_for_each_book($related_book_id, $conn){
        $sql_fetch = "SELECT tbl_authors.author_name FROM tbl_authors WHERE tbl_authors.book_id = '$related_book_id';";

        $related_author = mysqli_query($conn, $sql_fetch);
        $auth_list = mysqli_fetch_all($related_author, MYSQLI_ASSOC);
        $auth_ct = mysqli_num_rows($related_author);
        $return_auth_string  = "";
        mysqli_free_result($related_author);

        // print_r($auth_list);
        if($auth_ct > 0){
            if(count($auth_list) == 1){
                $return_auth_string = $auth_list[0]['author_name'];
            } else{
                $N = count($auth_list);
                $i = 0;
                for($i = 0; $i < $N-1; $i++){
                    $temp = $auth_list[$i]['author_name'];
                    $return_auth_string .= "$temp, ";
                
                }
                $last_name = $auth_list[$i]['author_name'];
                $return_auth_string .= "$last_name";
            }
        }
        
        return $return_auth_string;
    }

    function check_if_book_exist($isbn, $type, $conn){
        
        $check_sql = "SELECT book_id FROM tbl_books WHERE isbn ='$isbn' AND book_type =$type";
        $result = mysqli_query($conn, $check_sql);
        $b_ct = mysqli_num_rows($result);
        mysqli_free_result($result);            

        return ($b_ct > 0) ? FALSE : TRUE;
    }
 

?>