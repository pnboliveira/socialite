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
        $typeUser = $myUser->getAdmin();

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            try{
                
                $pub = new classes_PublicationManager($myDbManager);
                $resultado = $pub->listOnePub($id);
                
                }
                catch(InvalidArgumentException $e){
                    echo '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';
                }
        }

        if(!empty($_POST)){
            try{
               
                $myDbManager = new classes_DbManagerPDO();
                $myValidator = new classes_ComentValidator();
                $erros = null;
                if(!is_array($errors = $myValidator->checkComent($_POST))){

                    $myComent = new classes_coment($myUser->getId(),$_POST['coment'],$_GET['id'],$_POST['avaliacao']);
                    $myComentManager = new classes_ComentManager($myDbManager);
                    $result = $myComentManager->insertComent($myComent, $_GET['id']);
                  

                }
                
            }
            catch(InvalidArgumentException $e){
                echo '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';
            }
        }
    }
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?
        include('head.php');
    ?>
    <title>Publicação - Socialite</title>
    <style>
        img{
            height:100px;
            width:100px;
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
            
            echo "<img src= ".$resultado['imagem']." alt=".$resultado['descricao']."><br>".$resultado['descricao']."<br><br>";
                      
        if($typeUser == 'Admin'){
            echo '<a class="btn btn-danger" href="deletePub?id='.$resultado['id_pub'].'" name="apagar">Apagar</a><br><br>';
        }
?>
        <form action="" method="POST">
        <div class="form-group">
        <label for="coment">Insira um comentário:</label>
        <input type="text" class="form-control" name ="coment" id="coment">
        </div>
        <div class="form-group">
        <label for="avaliacao">Dê uma avaliação:</label>
            <select name="avaliacao" class="form-control" id="avaliacao">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </div>        
        </select><br>
        <input type="submit" id="" class="btn btn-primary" value="Comente">

        </form>
        <br>
        <br>
    

<?
try{
    $myDbManager = new classes_DbManagerPDO();
    $allComents = new classes_ComentManager($myDbManager);
    $elesTodos = $allComents->getComents($_GET['id']); 

    }
        catch(InvalidArgumentException $e){
            echo '<div class="alert alert-danger" role="alert">'.$e->getMessage().'</div>';
        }

        for($i=count($elesTodos)-1;$i>=0;$i--){

            $Nomes = $allComents->getNameComent($elesTodos[$i]['Id_util']);
            echo $Nomes['Nome']. ' comentou: <br> ';
            echo $elesTodos[$i]['Content'].'<br>';
            echo $elesTodos[$i]['Avaliacao'].'/4 <br>';
        }


?>

<a href="index" title="Ir para a página anterior">Voltar</a>
</div>
    </main>
    <?
    include ("footer.php");
?>
</body>
</html>