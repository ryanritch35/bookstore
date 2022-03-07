<?php 

?>

<style>
    .search-author, .search-title{   
        height:30px;
        padding: 5px;
        border-radius: 5px;
    }
    .search-author {margin-left: 20px;}
    .search-submit {margin-left: 20px; height: 30px; border: 1px solid black; border-radius: 5px;}
    .search-submit:hover {cursor: pointer;}
</style>

<form action="<?php if(basename($_SERVER['PHP_SELF']) == 'index.php') {echo './books/search-results.php'; } else {echo $_SERVER['PHP_SELF'];}?>" method="GET">

    <label for="search_title">Search: </label>
    <input class="search-title" type="text" name="search_title" id="" placeholder="Enter Title to Search">
    <input class="search-author" type="text" name="search_author" id="" placeholder="Enter Author to Search">
    <input class="search-submit" type="submit" value="Search">
</form>

