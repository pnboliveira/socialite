<?
    require_once('utils/Autoload.php'); //carrega todas as classes pertencentes à aplicação


   session_start();

   if(empty($_SESSION) || !array_key_exists('Nome',$_SESSION) || !isset($_SESSION['Nome'])){
   
       $_SESSION['error'] = array ('source' => 'contato.php','type' => 'No Permissions');
       header('Location:formLogin.php');
       die();	
   }else{
        $myDbManager = new classes_DbManagerPDO();
        $myUserManager = new classes_UserManager($myDbManager);
        $myUser1 = new classes_User($_SESSION,'SessionSet');
        $Nome = $myUser1->getUsername();
        $email = $myUser1->getEmail();
        $contato = $myUser1->getContato();

        $errors = null;
       try{
        if(!empty($_POST)){
            $myValidator = new classes_Validation();
               
                    if(array_key_exists('upAll', $_POST) && !is_array($myValidator->checkUpdateForm($_POST))){
                        $myUser= new classes_User($_POST, 'Register');
                        $myDbManager = new classes_DbManagerPDO();
                        $myUserManager = new classes_UserManager($myDbManager);
                        $result = $myUserManager->updateData($myUser, $myUser1, 'All');
                    
                    
                        if($result){
                            echo 'Alterado com Sucesso!';
                            header('location:logout');
                        }
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
    <title>Editar Utilizador - Socialite</title>
</head>

<body>
    <?
        include('navbar.php');
    ?>
    <main>
        <div class="container">
            <h1>Atualização de Dados</h1>

            <form action="" method="POST" name="updateAll">
                <div class="form-group"> 
                <label for="username">Nome de Utilizador:</label>
                    <input type="text" class="form-control" id="username" name="Username" value="<?echo $Nome;?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="Email" value="<?echo $email;?>" required>
                </div>
                <div class="form-group">
                    <label for="contato">Contato:</label>
                        <input type="text" class="form-control" id="contato" name="Contato" value="<?echo $contato;?>"
                            required>
                </div>
                <div class="form-group">
                <label for="password">Palavra-passe:</label>
                    <input class="form-control" id="password" type="password" name="Password" required>
                </div>
                <div class="form-group">
                <label for="rpassword">Repetir Palavra-passe:</label>
                    <input class="form-control" id="password" type="password" name="rPassword" required>
                </div>
                <input type="submit" class="btn btn-primary" value="Submeter" name="upAll">
                <button class="btn btn-danger" onclick="window.location='deleteUser.php';">Apagar Utilizador</button>
            </form>
           
        </div>
    </main>
    <?
    include ("footer.php");
?>
</body>

</html>