<?php

include_once('resources/init.php');

$post = get_posts($_GET['id']);
echo mysql_error();
    
$errors = array();
    
if(isset($_POST['title'], $_POST['contents'], $_POST['category'] )){
    $title      = trim($_POST['title']);
    $contents   = trim($_POST['contents']);
    

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
        edit_post($_GET['id'],$title, $contents, $_POST['category']);       

        header("Location: index.php?id={$post[0]['post_id']}");

        die();
    }
}//end if       
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit posts</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
          <style type="text/css">
            ul{list-style: none;}
            li{display: inline; margin-right: 20px;}
            label{display: block;}
        </style> 
    </head>
    <body>
        
         <h1>Edit a Post</h1>
         
           <nav>
            <ul>         
                <li><a href="index.php">Index</a></li>   
                <li><a href="add_post.php">Add a Post</a></li>    
                <li><a href="add_category.php">Add a Category</a></li>    
                <li><a href="category_list.php">Category List</a></li>    
            </ul>           
        </nav>     
         <?php        
        if(isset($errors) && !empty($errors) ){
            echo '<ul><li>', implode ('</li><li>', $errors), '</li></ul>';// liknar en for loop
        }
        
        ?>
        
        
             <form action="" method="post">
            <div>
                <label for="title">Title</label>                                                                                              
                <input type="text" name="title" value="<?php echo $post[0]['title'];?>">
            </div>
            <div>
                <label for="contents">Contents</label>                                                                                              
                <textarea name="contents" rows="15" cols="50"><?php echo $post[0]['contents'];?></textarea>
            </div>
            <div>
                <label for="category">Category</label>                                                                                              
                <select name ="category">
                    <?php
                        foreach(get_categories() as $category) {
                            $selected = ($category['name']== $post[0]['name']) ? ' selected' : '';
                    ?>
                    <option value= "<?php echo $category['id'];?>"<?php echo $selected; ?>> <?php echo $category['name'];?> </option>                                         
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


