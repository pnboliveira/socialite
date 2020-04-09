<?php

if(!empty($_POST)){
    //validação
    $errors = null;
    require_once('utils/Autoload.php'); //carrega todas as classes pertencentes à aplicação

    try{
            $myValidator = new classes_Validation();

            if(array_key_exists('Gobtn',$_POST) && !is_array($errors = $myValidator->checkRegisterForm($_POST))){
                
                    $myUser = new classes_User($_POST,'Register');                    
                    $myDbManager = new classes_DbManagerPDO();
                    $myUserManager = new classes_UserManager($myDbManager);
                    $result = $myUserManager->addUser($myUser);
                    if($result){
                        echo '<div class="alert alert-success" role="alert">Registado com sucesso! Por favor <a href="formLogin">inicie a sessão.</a></div>';
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
    <title>Registar - Socialite</title>
</head>

<body>

    <?
        include('navbar.php');
    ?>
    <main>
        <div class="container">
            <form action="" method="POST" name="register">
                <div class="form-group">
                    <label for="username"> Nome de Utilizador:</label>
                    <input type="text" name="Username" class="form-control" id="username" value="<?php
    if(!empty($_POST) && is_array($errors) && !$errors['username'][0]){
        echo $_POST['Username'];
    }   
    
    ?>">
                    <small class="form-text text-muted"><?php
    if(!empty($_POST) && is_array($errors) && $errors['username'][0]){
        echo $errors['username'][1];
    }
    ?></small></div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="Email" value="<?php
    if(!empty($_POST) && is_array($errors) && !$errors['email'][0]){
        echo $_POST['Email'];
    }   
    
    ?>">
                    <small class="form-text text-muted"><?php
    if(!empty($_POST) && is_array($errors) && $errors['email'][0]){
        echo $errors['email'][1];
    }
    ?></small></div>
                <div class="form-group">
                    <label for="Contato">Contato:</label>
                    <input type="text" name="Contato" class="form-control" id="contato" value="<?php
    if(!empty($_POST) && is_array($errors) && !$errors['contato'][0]){
        echo $_POST['Contato'];
    }   
    
    ?>">
                    <small class="form-text text-muted"><?php
    if(!empty($_POST) && is_array($errors) && $errors['contato'][0]){
        echo $errors['contato'][1];
    }
    ?></small></div>
                <div class="form-group">
                    <label for="password">Palavra-passe:</label>
                    <input type="password" name="Password" id="password" class="form-control"><small
                        class="form-text text-muted"><?php
    if(!empty($_POST) && is_array($errors) && $errors['Password'][0]){
        echo $errors['Password'][1];
    }
    ?></small></div>
                <div class="form-group">
                    <label for="rpassword">Repetir Palavra-passe:</label>
                    <input type="password" id="rpassword" class="form-control" name="rPassword"><small
                        class="form-text text-muted">
                    <?php
    if(!empty($_POST) && is_array($errors) && $errors['rPassword'][0]){
        echo $errors['rPassword'][1];
    }
    ?></small></div>
                <input type="submit" value="Submeter" class="btn btn-primary" name="Gobtn">
            </form>
        </div>
    </main>
    <?
    include ("footer.php");
?>
</body>

</html>