<?php
require_once('utils/Autoload.php');

session_start();

if(empty($_SESSION) || !array_key_exists('Nome',$_SESSION) || !isset($_SESSION['Nome'])){

    $_SESSION['error'] = array ('source' => 'contato.php','type' => 'No Permissions');
    header('Location:formLogin.php');
    die();	
    }else{
        try{
            $myDbManager = new classes_DbManagerPDO();
            $myUser = new classes_User($_SESSION,'SessionSet');
            $myValidator = new classes_PublicationValidation;
            $errors = null; 
        if(!empty($_POST)){
           if(!is_array($errors = $myValidator->checkPub($_FILES)) && !is_array($errors = $myValidator->checkDesc($_POST))){ 
              
            $publicacao = new classes_Publication($_POST, $myUser->getId(),$_FILES);
            
           
            $fileUpload = new classes_PublicationManager($myDbManager); 
            $result = $fileUpload->uploadFile($publicacao);
            move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'.$_FILES['file']['name']);
            }
        }
    }
    catch(InvalidArgumentException $e){
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
    <script type="text/javascript">
    </script>
    <title>Adicionar Publicação - Socialite</title>
</head>
<body>

    <?
        include ('navbar.php');
    ?>
    <main>
        <div class="container">
            <form action="" id="imagemPublicar" method="POST" enctype="multipart/form-data" name="Imagem">
            <div class="form-group">
            <label for="file">Imagem:</label>
            <input type="file" class="form-control" name="file" id="file" value="Imagem"><br>
            </div>
            <div class="form-group">
            <label for="descpub">Descrição:</label>
            <textarea name ="descpub" class="form-control" id="descpub" rows="10" cols="30"></textarea>
            </div>
                <input type="submit" class="btn btn-primary" value="Upload" name="upPub">
                <a href="index.php" class="btn btn-primary">Retroceder</a>
            </form>

            
            </div>
    </main>
    <?
    include ("footer.php");
?>
</body>
</html>