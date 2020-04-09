<?
require_once('utils/Autoload.php');
    session_start();

    if(empty($_SESSION) || !array_key_exists('Nome',$_SESSION) || !isset($_SESSION['Nome'])){
	
        $_SESSION['error'] = array ('source' => 'contato.php','type' => 'No Permissions');
        header('Location:formLogin');
        die();	
    }else{
        $myDbManager = new classes_DbManagerPDO();
            $myUser = new classes_User($_SESSION,'SessionSet');
        $Nome = $myUser->getUsername();
        try{
        $myDbManager = new classes_DbManagerPDO();
        $pubAllSelf = new classes_PublicationManager($myDbManager);
        $result = $pubAllSelf->listAllPub();
        
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
    <title>Todas as Publicações - Socialite</title>
    
</head>
<body>
<?
        include('navbar.php');
        ?>
        <main>
            <div class="container">
    <?  for($i=0; $i<count($result);$i++){
                echo "<a href=\"pub?id=".$result[$i]['id_pub']."\"><img src= ".$result[$i]['imagem']." alt=".$result[$i]['descricao'].">".$result[$i]['descricao']."</a><br>";
            }?>

<a href="index.php" title="Ir para a página anterior">Voltar</a>
</div>
        </main>
        <?
    include ("footer.php");
?>
</body>
</html> 