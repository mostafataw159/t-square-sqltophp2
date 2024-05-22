<?php
    session_start();
include('includes.php');
$page = "all";
if(isset($_GET["page"])){
    $page = $_GET["page"];
}
if($page =="all"){
$statment=$connect->prepare("SELECT * FROM users");
$statment->execute();
$usercount=$statment->rowCount();
$result=$statment->fetchAll();
?>
<div class="container">
    <div class="row">
        <div class="col-md-11 m-auto">
        <?php
         if(isset($_SESSION['messege'])){
    echo "<h3 class='text-center alert alert-danger'>".$_SESSION['messege']."</h3>";
    unset($_SESSION['messege']);
    header("Refresh:4;url=users.php");
         }
    ?>
        <h2 class="text-center mt-5 mb-4">
            All users info 
            <span class="badge badge-danger"><?php echo $usercount ?></span>
        <a href="?page=create" class="btn btn-success border-rounded">create new user</a>
        </h2>
    <table class="table table-primary table-hover">
        <thead>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
            <th>created_at</th> 
            <th>Operation</th>       
        </thead>
        <tbody>
            <?php
     foreach($result as $item){
        ?>
         <tr>
        <td><?php echo $item["user_id"] ?></td>
        <td><?php echo $item["username"] ?></td>    
        <td><?php echo $item["email"] ?></td>
        <td><?php echo $item["status"] ?></td>
        <td><?php echo $item["role"] ?></td>
        <td><?php echo $item["created_at"] ?></td>
        <td>
            <a href="?page=show&user_id=<?php echo $item["user_id"]; ?>" class="btn btn-success">
            <i class="fa-regular fa-eye"></i>
            </a>
            <a href="users.php" class="btn btn-warning">
            <i class="fa-solid fa-user-pen"></i>
            </a>
            <a href="?page=delete&user_id=<?php echo $item["user_id"]; ?>" class="btn btn-danger">
            <i class="fa-solid fa-delete-left"></i>
            </a>
        </td>
         </tr>
       <?php
            }
            ?>
        </tbody>
    </table>

    </div>
    </div>
</div>

<?php
}else if ($page == "show") {
    if(isset($_GET["user_id"])){
        $user_id = $_GET["user_id"];
    }
    $statment=$connect->prepare("SELECT * FROM users WHERE user_id=?");
$statment->execute(array($user_id));
$result=$statment->fetch();
?>
<div class="container">
    <div class="row">
        <div class="col-md-11 m-auto">
    <h2 class="text-center">this user info</h2>
    <table class="table table-primary table-hover">
        <thead>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
            <th>Role</th>
            <th>created_at</th> 
            <th>Operation</th>       
        </thead>
        <tbody>
         <tr>
        <td><?php echo $result["user_id"] ?></td>
        <td><?php echo $result["username"] ?></td>    
        <td><?php echo $result["email"] ?></td>
        <td><?php echo $result["status"] ?></td>
        <td><?php echo $result["role"] ?></td>
        <td><?php echo $result["created_at"] ?></td>
        <td>
            <a href="users.php" class="btn btn-success">
            <i class="fa-regular fa-eye"></i>
            </a>
        </td>
         </tr>
        </tbody>
    </table>

    </div>
    </div>
</div>
<?php
}else if($page == "delete"){
    if(isset($_GET["user_id"])){
        $user_id = $_GET["user_id"];
    }
    $statment=$connect->prepare("DELETE FROM users WHERE user_id=?");
    $statment->execute(array($user_id));
    $_SESSION["messege"]= "deleted successfully";
    header("location:users.php");

}else if($page == "create"){
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-11 mt-5">
                 <form method="post" action="?page=savecreate">
                    <label>Id</label><input type="text" name="id" class="form-control mb-3" placeholder=" 
                  <?php  if(isset($_SESSION['error_id'])){
                  echo $_SESSION['error_id'];
                  unset($_SESSION['error_id']);
                  }?>">
                    <label>username</label>
                    <input type="text" name="name" class="form-control mb-3" value="<?php
                     if(isset($_SESSION['error_name'])){
                        echo $_SESSION['error_name'];
                        unset($_SESSION['error_name']);
                     }?>">   
                     <label>Email</label>
                     <input type="email" name="email" class="form-control mb-3" value="
                     <?php
                     if(isset($_SESSION['error_email'])){
                        echo $_SESSION['error_email'];
                        unset($_SESSION['error_email']);
                    }?>
                     ">
                    <label>password</label>
                    <input type="password" name="pass" class="form-control mb-3">
                    <label>status</label>
                    <select name="status" class="form-control mt-3 mb-3">
                        <option value="1">active</option>
                        <option value="0">block</option>
                    </select>

                    <label>role</label><select name="role" class="form-control mt-3 mb-3">
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                    </select>

                    <input type="submit" value="create new user" class="btn btn-success form-control mt-3 mb-5">
                 </form>   
                </div>
            </div>
        </div>
        <?php   
}else if($page == "savecreate"){
    if($_SERVER['REQUEST_METHOD']=="POST"){
    $id =$_POST["id"];
    $user =$_POST["name"];
    $email =$_POST["email"];
    $pass =$_POST["pass"];
    $status =$_POST["status"];
    $role =$_POST["role"];
    try{
    $statment=$connect->prepare("INSERT INTO users (user_id,username,email,`password`,`status`,`role`,created_at)
VALUES(?,?,?,?,?,?,now())
");
$statment->execute(array($id, $user, $email, $pass, $status, $role));;
$_SESSION["messege"]= "created successfully";
header("location:users.php");
  }catch(PDOException $e){
    $_SESSION["error_id"]= "please enter a new id";
    $_SESSION["error_name"]=  $user;
    $_SESSION["error_email"]= $email;
echo "<h4 class ='alert alert-warning text-center'>duplicate ID</h4>";
header("Refresh:4;url=users.php?page=create");
  }
} 
}
?>
<?php
include('includes/temp/footer.php');
?>