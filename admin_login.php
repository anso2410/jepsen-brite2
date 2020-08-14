
<?php
session_start();

require './include/bdb.php';
?>
<?php
if (isset($_POST['connexion_admin'])){
    if (!empty($_POST['admin'])  AND !empty($_POST['mdp'])){
        $mdp = 'salut';
        $admin = 'jepsen';
        if ($_POST['admin'] == $admin){
            if ($_POST['mdp'] == $mdp){
                $_SESSION['mdp'] = $mdp;
                header('Location:admin.php');
            }else{
                $_SESSION['flash']['danger']= 'Mot de passe ou pseudo incorrect';

            }
        }else{
            $_SESSION['flash']['danger']= 'Mot de passe ou pseudo incorrect';
        }
    }else{
        $_SESSION['flash']['danger']= 'Veuillez compléter tous les champs';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php require './include/header.php' ?>
    <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <title></title>
</head>
<body>
<div class="container">
<h1>Admin login</h1><br><br><br>
<form method="POST">
    <div class="form-group" action="">
        <label for="">admin/name  </label>
        <input type="text" name="admin" class="form-control" />
    </div>
    <div class="form-group">
        <label for="">Password : </label>
        <input type="password" name="mdp" class="form-control" />
    </div>
    <br><br><br>

    <button type="submit" class="btn btn-primary" name="connexion_admin">Submit</button>
</form>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
