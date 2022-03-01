<?php

    // not using anymore
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

    // not using anymore
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

    // new function added to support author input from checkbox
    function build_multi_sql_authors_id_included($latest_index, $available_authors, $names){
        include('../variables/variables.php');

        $map = array();
        foreach ($available_authors  as $a){
            $map[$a['author_name']] = $a['author_id'];
        }

        $multi_authors = "INSERT INTO $tbl_author_books(author_id, book_id) VALUES ";
        $index = 0;
        
        
        foreach ($names as $author){ 
            $id = $map[$author];
 
            if ($index == count($names)-1){
                $multi_authors .= "($id, $latest_index); ";
                break;
            }
            $multi_authors .= "($id, $latest_index), ";
            $index = $index + 1;
        }
        return $multi_authors;
    }

    function get_author_for_each_book($related_book_id, $conn){
        if(basename($_SERVER['PHP_SELF'])== 'publisher.php'){
            include('../variables/variables.php');
        } else if (basename($_SERVER['PHP_SELF'])== 'index.php'){
            include('./variables/variables.php');
        }
        /*
            SELECT author_name
            FROM tbl_is_author
            WHERE author_id IN ( SELECT author_id FROM tbl_author_books WHERE book_id = 1);
        */

        // $sql_fetch = "SELECT tbl_authors.author_name FROM tbl_authors WHERE tbl_authors.book_id = '$related_book_id';";

        $sql_fetch = "SELECT $tbl_is_author.author_name FROM $tbl_is_author WHERE $tbl_is_author.author_id IN ( SELECT $tbl_author_books.author_id FROM $tbl_author_books WHERE book_id = '$related_book_id');";

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
        include('../variables/variables.php');
        
        $check_sql = "SELECT book_id FROM $tbl_books WHERE isbn ='$isbn' AND book_type =$type";
        $result = mysqli_query($conn, $check_sql);
        $b_ct = mysqli_num_rows($result);
        mysqli_free_result($result);            

        return ($b_ct > 0) ? FALSE : TRUE;
    }
    
    // publisher add book validation function
    function publisher_book_info_validation($typed_inputs){
        if ($typed_inputs['genre']=='Select' || $typed_inputs['type']=='Select' || count($typed_inputs['authors'])==0){
            return False;
        }
        return True;
    }

    function create_author_array_to_return_checked_status($names){
        $map =array();
        foreach($names as $name){
            $map[$name] = 1;
        }

        return $map;
    }

?>