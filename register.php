
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

 <?php require_once './include/functions.php';
require './include/bdb.php';
?>




<!-- verification formulaire -->
<?php
if(!empty($_POST))
{
    $errors = array();




    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username']))
    {
        $errors['username'] = "your username/pseudo is not valid. ";
    } else {
        $requete = $pdo->prepare('SELECT id FROM users WHERE username = ?');
        $requete->execute([$_POST['username']]);
        $user =$requete->fetch();
        if($user){
            $errors['username'] = 'This pseudo already used please enter a new one!';
        }
    }



    if(empty($_POST['email']) ||!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
    {
        $errors['email'] = "Please enter a valid email.";
    } else {
        $requete = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $requete->execute([$_POST['email']]);
        $user = $requete->fetch();
        if ($user) {
            $errors['email'] = 'This email is already used please enter a new one!';
        }
    }

    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm'])
    {
        $errors['password'] = "Please enter the same password.";
    }

    if(empty($errors))
    {

        $requete = $pdo-> prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token= ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT );
        $token = str_random(60);
        // debug($token);
        //die();

        $requete->execute([$_POST['username'], $password, $_POST['email'], $token]);
        $user_id = $pdo->lastInsertId();
        $email = $_POST['email'];
        mail($email, 'confirmation de votre compte',"cliquez sur ce lien pour valider\n\nhttp://127.0.0.1/projects/jepsen-brite/confirm.php?id=$user_id&token=$token");
        die('account created !');
        header('Location:confirm.php');
        exit();

    }
    //debug($errors);





}

?>









 <?php require './include/header.php' ?>

<div class="container">
    <head>
        <h1> Registration</h1>
    </head>



    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            <p>You did not fill the form correctly</p>
            <?php foreach($errors as $error): ?>
                <ul>
                    <li><?= $error; ?></li>
                </ul>
            <? endforeach; ?>
        </div>
    <?php endif; ?>

    <form  action="" method="POST" enctype="multipart/form-data"  >

        <div class="form-group">
            <label for="">Pseudo/ username : </label>
            <input type="text" name="username" class="form-control" />
        </div>

        <div class="form-group">
            <label for="">Email : </label>
            <input type="text" name="email" class="form-control" />
        </div>

        <div class="form-group">
            <label for="">Password : </label>
            <input type="password" name="password" class="form-control" />
        </div>

        <div class="form-group">
            <label for="">confirm Password : </label>
            <input type="password" name="password_confirm" class="form-control" />
        </div>

        <form action="fileUpload/fileUpload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlFile1">Avatar : </label>
                <input type="file" name="avatar"   class="form-control" ><br>
                <input type="submit" name="submit" value="Upload the file" class="btn btn-primary">



                <div class="size">

                    <img src="<?php echo $grav_url; ?>" alt="gravatar" />
                </div>
            </div>
        </form >

        <button type="submit" class="btn btn-primary">Register your account</button>

    </form><br><br>





</div>


<?php require 'include/footer.php' ?>
</body>
</html>