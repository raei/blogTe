
<?php
// 5min part 5 börjar videon

    include_once('resources/init.php');

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Category List</title>
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
        <h1>Category List</h1>
        
        <?php
            foreach(get_categories() as $category) {
        ?>
        <p>           
            <a href="category.php?id = <?php echo $category['id'];?>"><?php echo $category['name'];?> </a> - <a href="delete_category.php?id=<?php echo $category['id'];?>">Delete</a>     
            
        </p>
        <?php
            }
        ?>
    </body>
</html>
