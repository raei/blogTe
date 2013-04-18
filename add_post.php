<?php

include_once('resources/init.php');
    
$errors = array();
    
if(isset($_POST['title'], $_POST['contents'], $_POST['category'] )){
    $title      = trim($_POST['title']);
    $contents   = trim($_POST['contents']);
    $category   = trim($_POST['category']);//id from listbox

    if(empty($title)){
    $errors[] = "You need to supply a title<br>";
    }else if(strlen($title) > 255){
        $errors[] = "The title cannot be longer than 255 characters. ";
    }  
    
    if(empty($contents)){
        $errors[] = "You need to supply some text";
    }   
    
    if(!category_exists('id', $_POST['category'])) {
        $errors[] = 'That category does not exist.';
    }
    
    if ( empty($errors)) {
        add_post($title, $contents, $category);

        $id = mysql_insert_id();// hämtar det senaste id värdet som lagrats på servern

        header("Location: index.php?id={$id}");// öppna idex efter inlagd data

        die();
    }
}//end if       
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add a Post</title>
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
        <h1>Add a Post</h1>
        
        <?php        
        if(isset($errors) && !empty($errors) )
            echo '<ul><li>', implode ('</li><li>', $errors), '</li></ul>';// liknar en for loop
        ?>
        
        <form action="add_post.php" method="post">
            <div>
                <label for="title">Title</label>                                                                                              
                <input type="text" name="title" value="<?php if(isset($_POST['title'])) echo $_POST['title'];?>">
            </div>
            <div>
                <label for="contents">Contents</label>                                                                                              
                <textarea name="contents" rows="15" cols="50"><?php if(isset($_POST['contents'])) echo $_POST['contents'];?></textarea>
            </div>
            <div>
                <label for="category">Category</label>                                                                                              
                <select name ="category">
                    <?php
                        foreach(get_categories() as $category) {
                    ?>
                            <option value= "<?php echo $category['id'];?>"> <?php echo $category['name'];?> </option>                                         
                    <?php                     
                        }
                    ?>
                </select>                
            </div>
            <div>
                <input type="submit" value="Add Post">
            </div>
        </form>    
    </body>
</html>