<?php
    
    $min_book_count = 1;
    $max_book_count = 999;
    $min_price = 0;
    $max_price = 10000;
    $book_types = array("Select", "Hardcover","Paperback", "Electronic","Audio");
    $book_genres = array("Select","Action, Adventures", "Alternate History", "Anthology", "Biography", "Chick Lit", "Children's", "Classic", "Comic", "Coming-of-age", "Computer Science","Crime", "Data Science","Drama", "Economics","Fairytale", "Fiction","Graphic novel", "History","Horror", "Mathematics","Mystery", "Nonfiction","Paranormal romance", "Philosophy","Picture book", "Poetry", "Political thriller", "Programming", "Psychology","Romance", "Science","Science fiction", "Short Story", "Signal Processing","Suspense", "Thriller", "Wester", "Yound adult", "Other");


    # table names
    $tbl_is_author = 'tbl_is_author';
    $tbl_author_books = 'tbl_author_books';
    $tbl_bookinventory = 'tbl_bookinventory';
    $tbl_books = 'tbl_books';
    $tbl_discount = 'tbl_discount';
    $tbl_order_history = 'tbl_order_history';
    $tbl_publishers = 'tbl_publishers';
    $tbl_shipping_methods = 'tbl_shipping_methods';
    $tbl_shopping_cart = 'tbl_shopping_cart';
    $tbl_users = 'tbl_users';
    $tbl_user_address = 'tbl_user_address';
    $tbl_user_payment = 'tbl_user_payment';
    $tbl_user_premium = 'tbl_user_premium';
?>