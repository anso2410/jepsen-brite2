<?php

session_start();
$pdo =
    new PDO('mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_f2e7be08f8f82c4;charset=utf8','b5a83bf957a94e','e7c157ba');
if (!$_SESSION['mdp']){

    header('Location:admin_login.php');

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Membres-Administration</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php
    require './include/header.php';
    ?>
</head>
<body>
<h3 class="container">Gestion Membres</h3><br><br>
<?php
$select_users = $pdo->query('SELECT * FROM users');
if ($select_users->rowCount() > 0){
    while($m = $select_users->fetch()){
        ?>
        <div class="container">
        <b><p>PSEUDO: <span></span><?= $m['username']; ?></p><p> EMAIL: <span></span>  <?=  $m['email']; ?></p> <span></span>INSCRIT DEPUIS LE : <span></span>  <?=  $m['confirmed_at']; ?></b><br><br><p> <a href="admin_modify.php?id=<?= $m['id']; ?>" style="text-decoration: none;">Modifier</a></p>

<p><a href="admin_delete_members.php?id=<?= $m['id']; ?>" style="color: red;text-decoration: none;">Supprimer</a></p><hr/>
        </div>
        <?php

    }
}else{
    echo "aucun membre";
}

?>
<div class="container">
    <button type="button" class="btn btn-danger">
        <a href="admin_login.php" style="color: white;text-decoration: none;">log out</a>
    </button>
</div>
<div class="container">
<nav aria-label="...">
  <ul class="pagination">

    <li class="page-item"><a class="page-link" href="admin.php">previous </a></li>
    <li >
      <a class="page-link" href="">1 </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
</div>
</body>
</html>
