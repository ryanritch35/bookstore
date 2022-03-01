<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="book_name">
        <label for="book_name">Title;</label>
        <input type="text" name="book_name" id="" placeholder="Enter Title" 
        value="<?php 
            if(basename($_SERVER['PHP_SELF']) == 'publisher.php'){
                echo $typed_inputs['title']; 
            }
            if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
                echo $current_book['title'];
            }

        ?>" 
        required>
    </div>
    <div class="book_isbn">
        <label for="book_isbn">ISBN:</label>
        <input type="text" name="book_isbn" id="" placeholder="Enter ISBN"
        value="<?php
            if(basename($_SERVER['PHP_SELF']) == 'publisher.php'){
                echo $typed_inputs['isbn']; 
            }
            if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
                echo $current_book['isbn'];
            }
            
        ?>" 
        required>
    </div>
    
    <div class="book_genre" 
    <?php 
        if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
            echo 'hidden';
        }
    ?>>
        <label for="book_genre">Genre:</label>
        <select type="text" name="book_genre" id="" placeholder="Enter Genre">
            <?php  foreach($book_genres as $genre): ?>
                <option 
                <?php 
                    if(basename($_SERVER['PHP_SELF']) == 'publisher.php'){
                        if($genre == $typed_inputs['genre']) {
                            echo 'selected'; 
                        }
                    }
                    if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
                        echo 'disabled';
                    }
                   
                ?> 
                value="<?php echo $genre; ?>"> <?php echo $genre; ?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="book_type" <?php 
        if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
            echo 'hidden';
        }
    ?>>
        <label for="book_type">Type:</label>
        <select type="text" name="book_type" id="" placeholder="Enter Book Type"> 
            <?php $index = 0; foreach($book_types as $type): ?>
                <option 
                <?php 
                    if(basename($_SERVER['PHP_SELF']) == 'publisher.php'){
                        if($index == $typed_inputs['type']) echo 'selected';
                    }
                    if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
                        echo 'disabled';
                    }
                     
                ?> 
                value="<?php echo $index; ?>"> <?php echo $type; ?></option>

            <?php $index++; endforeach;?>
        </select>
    </div>
    <div class="book_price">
        <label for="book_price">Price:</label>
        <input type="number" name="book_price" id="" placeholder="0.00" step="0.01" min="<?php echo $min_price; ?>" max="<?php echo $max_price; ?>" 
        value="
            <?php
                if(basename($_SERVER['PHP_SELF']) == 'publisher.php'){
                    echo $typed_inputs['price']; 
                }
            ?>" 
        required>
    </div>

    <div class="book_author" 
    <?php 
        if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
            echo 'hidden';
        }
    ?> >
        <label for="book_author">Authors:</label>
        <!-- <input type="text" name="book_author" id="" placeholder="Enter Author Name"> -->
        <!-- <select multiple type="text" name="availabe_authors" id="" placeholder="Choose Author names"> -->
        <div class="book_author-checkbox" >
            <?php 
                if(basename($_SERVER['PHP_SELF']) == 'publisher.php'):
                    foreach($available_authors as $authors): 
            ?>
                <input 
                    <?php 
                        if(basename($_SERVER['PHP_SELF']) == 'publisher.php'){
                            if(array_key_exists($authors['author_name'],$typed_inputs['authors'] )) {
                                echo 'checked'; 
                            }
                        }
                        if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
                            echo 'disabled';
                        }
                    ?> 
                
                type="checkbox" name="availabe_authors[]" value="<?php echo $authors['author_name']; ?>"> <?php echo $authors['author_name']; ?></input><br>
            <?php 
                    endforeach; 
                endif;
            ?>
        <!-- </select> -->
        </div>
        <p>Not listed? <a href="#">Register here</a></p>
    </div>
    <div class="form-add">
        <button type="submit" 
        name="<?php
            if(basename($_SERVER['PHP_SELF']) == 'publisher.php'){
                echo 'book_add';
            }
            if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
                echo 'book_edit';
            }

            
        ?>" 
        value="<?php
            if(basename($_SERVER['PHP_SELF']) == 'publisher.php'){
                echo 'Add';
            }
            if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
                echo 'Edit';
            }            
        ?>">
            <?php
            if(basename($_SERVER['PHP_SELF']) == 'publisher.php'){
                echo 'Add';
            }
            if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
                echo 'Edit';
            }  
        ?>
        </button>  
    </div>
    
</form>
<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
    <button type="submit" 
    name="<?php
            if(basename($_SERVER['PHP_SELF']) == 'publisher.php'){
                echo 'log_out';
            }
            if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
                echo 'cancel';
            }            
        ?>" 
    value="<?php
            if(basename($_SERVER['PHP_SELF']) == 'publisher.php'){
                echo 'Log out';
            }
            if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
                echo 'Cancel';
            }            
        ?>">
        <?php
            if(basename($_SERVER['PHP_SELF']) == 'publisher.php'){
                echo 'Logout';
            }
            if(basename($_SERVER['PHP_SELF']) == 'edit-books.php'){
                echo 'Cancel';
            }            
        ?>

    </button>
</form>