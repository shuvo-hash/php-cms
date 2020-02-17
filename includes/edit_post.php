<?php


if (isset($_GET['p_id'])) {

    $the_post_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
$select_posts_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts_by_id)) {

    //Server

    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tag = $row['post_tag'];
    $post_content = $row['post_content'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
}

if (isset($_POST['update_post'])) {


    //Form Data

    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tag = $_POST['post_tag'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";

        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_image)) {
            $post_image = $row['post_image'];
        }
    }

    // Update into Server

    // $query = " UPDATE posts SET post_title = '$post_title', post_category_id = $post_category_id,post_author = '$post_author', post_date = now() , post_status = '$post_status', post_tag = '$post_tag', post_content = '$post_content', post_image = '$post_image' WHERE post_id =  $the_post_id ";

    //Same Query Down There  

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_date = now(), ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tag = '{$post_tag}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= " WHERE post_id = '{$the_post_id}' ";



    $update_post = mysqli_query($connection, $query);

    confirmQuery($update_post);

    echo "<p class='bg-success'> Post Updated. <a href='../post.php?p_id= {$the_post_id}'>View Post <a/> Or <a href='posts.php'>Edit More Post</a> </p>";
}





?>





<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">

        <select name="post_category" id="post_category">

            <?php

                        $query = "SELECT * FROM catagories";
                        $select_categories = mysqli_query($connection, $query);

                        confirmQuery($select_categories);

                        while ($row = mysqli_fetch_assoc($select_categories)) {

                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            echo "<option value='$cat_id'>{$cat_title}</option>";
                        }

            ?>



        </select>

    </div>

    <div class="form-group">
        <label for="author">Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>



    <div class="form-group">

        <label for="post_status">Post Status</label>

        <select name="post_status" id="">

            <option value="<?php echo $post_status; ?>"> <?php echo $post_status; ?></option>

            <?php
                                                            if ($post_status == 'published') {

                                                                echo "<option value='draft'>Draft</option>";
                                                            } else {
                                                                echo "<option value='published'>Publish</option>";
                                                            }

            ?>


        </select>


    </div>




    <!-- <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div> -->

    <div class="form-group">

        <img width="100" src="images/<?php echo $post_image; ?>">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tag; ?>" type="text" class="form-control" name="post_tag">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10"><?php echo $post_content; ?>
        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>

</form>