
<?php session_start();
require './include/functions.php';
require_once './include/bdb.php';

require './include/header.php';


logged_only();

$email_profile = $_SESSION['auth']->email;
$default = "";
$size = 100;


$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email_profile)  ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
//$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;


?>
<div class="container" align = "center">
    <h2>HELLO <?= $_SESSION['auth']->username; ?> Welcome to Jepsen-Brite!</h2>

</div>
<div class="container">
    <h3>User informations</h3>
    <h4> Your Pseudo :    <?= $_SESSION['auth']->username; ?></h4>
    <h4>Your Email : <?= $_SESSION['auth']->email; ?></h4><br>
    <img src="<?php echo $grav_url; ?>" alt="" />

</div>

</div><br><br>
<div class = "container">
    <form action="" method="POST" enctype="multipart/form-data" class="form-group">

        <label for="exampleFormControlFile1"> Choose your Avatar : </label>
        <input type="file" name="avatar"   class=" btn btn-warning" ><br><br></>
    <input type="submit" value="register your avatar" name="submit" class="btn btn-primary"></>
</form >
</div>

<img src=" <?= $_SESSION['auth']->avatar; ?>"</img>