
    <?php
include('includes.php'); 

$m1 = $connect->prepare("SELECT * FROM users");
$m1->execute();
$usercount =$m1->rowCount();

$m2= $connect->prepare("SELECT * FROM categories");
$m2->execute();
$catecount =$m2->rowCount(); 

$m3 = $connect->prepare("SELECT * FROM posts");
$m3->execute();
$postcount =$m3->rowCount(); 

$m4 = $connect->prepare("SELECT * FROM comments");
$m4->execute();
$commentcount =$m4->rowCount(); 
    ?>

<div class="container pt-5 mt-5">
    <div class="row">
        <div class="col-md-3 text-center mt-5">
        <div class="mt-3 ahmed">
        <i class="fa-solid fa-users fa-2xl" style="color: #B197FC;"></i>
<h2>users</h2>
<h3><?php echo $usercount ?></h3>
<a href="users.php" class="btn btn-danger mt-2">show</a>
        </div>
        </div>
        <div class="col-md-3 text-center  mt-5">
        <div class="mt-3 ahmed">
        <i class="fa-solid fa-table-cells fa-2xl" style="color: #B197FC;"></i>
<h2>categories</h2>
<h3><?php echo $catecount ?></h3>
<a href="users.php" class="btn btn-danger mt-2">show</a>
        </div>
        </div>
        <div class="col-md-3 text-center mt-5">
        <div class="mt-3 ahmed">
        <i class="fa-solid fa-signs-post fa-2xl" style="color: #B197FC;"></i>
<h2>posts</h2>
<h3><?php echo $postcount ?></h3>
<a href="users.php" class="btn btn-danger mt-2">show</a>
        </div>
        </div>
        <div class="col-md-3 text-center mt-5">
        <div class="mt-3 ahmed">
        <i class="fa-solid fa-comments fa-2xl" style="color: #B197FC;"></i>
<h2>comments</h2>
<h3><?php echo $commentcount ?></h3>
<a href="users.php" class="btn btn-danger mt-2">show</a>
        </div>
        </div>
    </div>
</div>

<?php
include('includes/temp/footer.php');    
    ?>