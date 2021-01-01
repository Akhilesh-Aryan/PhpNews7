<?php include "include/config.php"; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset="utf-8">
        <title>news7</title> 
          <link href="bootstrap.css" rel="stylesheet">
           </head>
           <body>
               <?php include("include/header.php");?>
               <div class="container mt-3">
                   <div class="row">
                   <div class="col-lg-6 mx-auto">
                       <div class="card">
                           <div class="card-body">
                               <form action="insert_post.php" method="post" enctype="multipart/form-data">
                                   <div class="form-group">
                                     <label for="title">title</label>
                                     <input type="text" name="title" class="form-control" id="title">
                                   </div>
                                    <div class="form-group">
                                     <label for="author">author</label>
                                     <input type="text" name="author" class="form-control" id="author">
                                   </div> 
                                    <div class="form-group">
                                     <label for="category">category</label>
                                        <select name="category" class="form-control" id="category">
                                     <?php
                                        $callingCat = mysqli_query($connect, "select * from category");
                                            while($cat = mysqli_fetch_array($callingCat)):
                                        ?>
                                        <option value="<?= $cat['cat_id'];?>"><?= $cat['cat_title'];?></option>
                                        <?php endwhile;?>
                                        </select>
                                        <a href="#rocking" data-toggle="modal" class="small">Create Category</a>
                                      
                                   </div>
                                     <div class="form-group">
                                     <label for="image">image</label>
                                     <input type="file" name="image" class="form-control" id="image">
                                   </div>
                                   <div class="form-group">
                                     <label for="content">content</label>
                                       <textarea rows="10" name="content" class="form-control" id="content"></textarea>
                                    </div>
                                   <div class="form-group">
                                       <input type="submit" name="send" class="btn btn-success btn-block">
                                </div>
                               </form>
                           </div>           
                       </div>
                   </div>
                   </div>
               </div>
               <div class="modal fade" role="dialog" id="rocking">
                           <div class="modal-dialog">
                               <div class="modal-content">
                                   <div class="modal-header bg-info text-white">Insert Category</div>
                                   <div class="modal-body">
                                   <form action="insert_post.php" method="post">
                                   <div class="form-group">
                                       <label for="">Cat_title</label>
                                      <input type="text" name="cat_title" class="form-control">
                                   </div>
                                   <div class="form-group">
                                       <input type="submit" name="send_cat" class="btn btn-block btn-success">
                                   </div>
                                </form>
                               </div>
                               </div>
                           </div>
                       </div>
                               
              <?php include("include/footer.php");?>
           </body>
           
</html>
<?php
if(isset($_POST['send'])){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    
    $image = $_FILES['image']['name'];
    $tmp_image = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp_image,"images/$image");
    
    $query = mysqli_query($connect, "insert into posts(post_title,post_author,post_category,post_content,post_image)
    value('$title','$author','$category','$content','$image')");
                        
    if($query){
        
        echo "<script>window.open('insert_post.php','_self')</script>";
    }
    else{
        echo "insertion failed";
    }
}
    if(isset($_POST['send_cat'])){
        $cat_title = $_POST['cat_title'];
        $query= mysqli_query($connect, "insert into category(cat_title) value('$cat_title')");
        echo "<script>window.open('insert_post.php','_self')</script>";
    }
?>
