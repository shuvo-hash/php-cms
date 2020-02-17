<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php"; ?>







    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome To Admin
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>

                    <div class="col-xs-6">

                        <?php insert_categories(); ?>


                        <form action="categories.php" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Categories</label>
                                <input name="cat_title" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>



                        <?php

                                if (isset($_GET['edit'])) {

                                    $cat_id = $_GET['edit'];

                                    include "../includes/update_categories.php ";
                                }

                        ?>

                    </div>

                    <div class="col-xs-6">



                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- //FIND ALL CATEGORY QUERY -->
                                <?php findAllCategories(); ?>



                                <!-- //DELETE QUERY -->
                                <?php deleteCategories(); ?>



                            </tbody>
                        </table>
                    </div>


                </div>
            </div>





            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


<?php include "includes/admin_footer.php"; ?>