<?
require_once('utils/Autoload.php');
    session_start();

    if(empty($_SESSION) || !array_key_exists('Nome',$_SESSION) || !isset($_SESSION['Nome'])){
	
        $_SESSION['error'] = array ('source' => 'contato.php','type' => 'No Permissions');
        header('Location:formLogin.php');
        die();	
    }else{
        $myDbManager = new classes_DbManagerPDO();
            $myUserManager = new classes_UserManager($myDbManager);
            $myUser = new classes_User($_SESSION,'SessionSet');
        $Nome = $myUser->getUsername();
        try{
        $myDbManager = new classes_DbManagerPDO();
        $pubAllSelf = new classes_PublicationManager($myDbManager);
        $result = $pubAllSelf->listSelfPub($myUser->getId());
                 
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
    <title>Suas Publicações - Socialite</title>
    <style>
        img {
            height: 100px;
            width: 100px;
        }
    </style>
</head>

<body>
    <?

        include('navbar.php');
        ?>
    <main>
        <div class="container">
            <?
        if(empty($result)){
            echo 'Não tem publicações suas <br>';
        }
      for($i=0; $i<count($result);$i++){
                echo '<img src= "'.$result[$i]['imagem'].'" alt="'.$result[$i]['descricao'].'">"'.$result[$i]['descricao'].'"<br>';
                echo '<a href="deletePub?id='.$result[$i]['id_pub'].'" name="apagar">Apagar</a><br>';
            }?>

            <a href="index.php" title="Ir para a página anterior">Voltar</a>
        </div>
    </main>

    <?
    include ("footer.php");
?>
</body>

</html>