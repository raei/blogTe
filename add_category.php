<?php

include_once('resources/init.php');


if(isset($_POST['name'])){
    $name = trim($_POST['name']);
    
    if(empty($name)){
        $error = 'You must submit a category name';
    }else if(category_exists('name', $name)){
        $error = 'That category already exists.';        
    }else if(strlen($name) > 24){
        $error = 'Category name can only be up to 24 characters.';
    }
    
    if(!isset($error)){
        add_category($name);
        $error = 'Success.';
        header('Location: add_post.php');
        die();
    }
}//end if isset()

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add a Category</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">
            ul{list-style: none;}
            li{display: inline; margin-right: 20px;}
            label{display: block;}
        </style> 
    </head>
    <body>
        <nav>
            <ul>         
                <li><a href="index.php">Index</a></li>   
                <li><a href="add_post.php">Add a Post</a></li>    
                <li><a href="add_category.php">Add a Category</a></li>    
                <li><a href="category_list.php">Category List</a></li>    
            </ul>           
        </nav>     
        
        <h1>Add a Category</h1>
        
        <?php
            if(isset($error)){
                echo "<p>{$error}</p>\n";
            }        
        ?>     
        
        <form action="add_category.php" method="post">
            <p>Name: <input type="text" name="name" /></p>            
            <input type="submit" name="submit" value="AddCategory" />
        </form>
        
    </body>
</html>
