<?php
session_start();
require('config.php');
if (isset($_POST['username'])){
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM `users` WHERE username='$username' and password='".hash('sha256', $password)."'";
    $result = mysqli_query($conn,$query) or die();
    $rows = mysqli_num_rows($result);
    if($rows==1){
        $_SESSION['username'] = $username;
        header("Location: index.php");
    }else{
        $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title></title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>

<form class="box" action="" method="post" name="login">
    <h1 class="box-logo box-title">Nachos Rumble</h1>
    <h1 class="box-title">Connexion</h1>
    <label>
        <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
        <input type="password" class="box-input" name="password" placeholder="Mot de passe">
        <input type="submit" value="Connexion " name="submit" class="box-button">
    </label>
    <p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>
    <?php if (! empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
</form>
</body>
</html>