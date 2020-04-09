<?php

    require_once('utils/Autoload.php'); //carrega todas as classes pertencentes à aplicação 

session_start();
if(empty($_SESSION) || !array_key_exists('Nome',$_SESSION) || !isset($_SESSION['Nome'])){
   
   $_SESSION['error'] = array ('source' => 'contato.php','type' => 'No Permissions');
   header('Location:formLogin.php');
   die();	
}else{
    
    $myUser = new classes_User($_SESSION,'SessionSet');
    $Nome = $myUser->getUsername();
   $errors = null;
   try{
        if(!empty($_POST)){
            $myValidator = new classes_Validation();

            if($_POST['sim']){
            $myDbManager = new classes_DbManagerPDO();
            $myUserManager = new classes_UserManager($myDbManager);
            $iduser = $myUser->getId();
            $result = $myUserManager->deleteUser($iduser);
        
            if ($result){
                header('location:formRegisto.php');
            }
        } else{
            header('location:index.php');
        }
        }
    }
    catch (InvalidArgumentException $e){
        echo '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?
        include("head.php");
    ?>
    <title>Apagar Utilizador - Socialite</title>
</head>
<body>
<?
    include ("navbar.php");
?>
<main>
    <div class="container">
    <h1>Tem a certeza que quer apagar o utilizador?</h1>

    <form action="" method="POST">
        <input type="submit" class="btn btn-success"value="NÃO" name="nao">
        <input type="submit" class="btn btn-danger" value="SIM" name="sim">
    </form>
    </div>
</main>
<?
    include ("footer.php");
?>
</body>
</html>