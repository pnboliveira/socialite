<?php
if(!empty($_POST)){
    //validação
    $errors = null;
    require_once('utils/Autoload.php'); //carrega todas as classes pertencentes à aplicação

    try{

        $myValidator = new classes_Validation();

        if(array_key_exists('loginbtn',$_POST) && !is_array($errors = $myValidator->checkLoginForm($_POST))){
            
            $myDbManager = new classes_DbManagerPDO();
            $myUserManager = new classes_UserManager($myDbManager);
            $myUser = new classes_User($_POST,'Login');
            $result = $myUserManager->loginUser($myUser);

            if ($result){
                session_start();
                header('location:index');
            }
        }
    }

    catch (InvalidArgumentException $e){
            echo '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';
    }
    catch (Exception $e){
        echo '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?
    include('head.php');
    ?>
    <title>Login - Socialite</title>
</head>
<body>
<?
    include('navbar.php');
    ?>
    <main>
        <div class="container">
            <form action="" name="login" method="POST">
            <div class="form-group">
            <label for="Username">Nome de Utilizador:</label>
                <input type="text" class="form-control" id="Username" name="Username">
                <small><?
                    if(!empty($_POST) && is_array($errors) && $errors['username'][0]){
                            echo $errors['username'][1];
                        }?></small>
                        </div>
                        <div class="form-group">
            <label for="Password">Palavra-passe:</label>
                    <input type="password" class="form-control" id="Password" name="Password">
                    <small><?php
                        if(!empty($_POST) && is_array($errors) && $errors['Password'][0]){
                            echo $errors['Password'][1];
                        }
                        ?></small>
                        </div>
                    <input type="submit" value="Login" class="btn btn-primary" name="loginbtn">
            </form>
            </div>
    </main>
    <?
    include ("footer.php");
?>
</body>
</html>