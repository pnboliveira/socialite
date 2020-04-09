<?php
    
    require_once('utils/Autoload.php'); //carrega todas as classes pertencentes à aplicação

    session_start();
    if(empty($_SESSION) || !array_key_exists('Nome',$_SESSION) || !isset($_SESSION['Nome'])){
   
        $_SESSION['error'] = array ('source' => 'contato.php','type' => 'No Permissions');
        header('Location:formLogin.php');
        die();	
    }else{
        try{
        $myDbManager = new classes_DbManagerPDO();
        $myUserManager = new classes_UserManager($myDbManager);
        $result=$myUserManager->orderScoreUser();
        $myUser = new classes_User($_SESSION,'SessionSet');
        $Nome = $myUser->getUsername();
        $typeUser= $myUser->getAdmin();
        
        
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
    include('head.php');
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    <title>Página Principal - Socialite</title>
    <script type="text/javascript">
    google.charts.load('current',{'packages':['table']});
    google.charts.setOnLoadCallback(drawTable);

    function drawTable(){
        var data=new google.visualization.DataTable();
        data.addColumn ('string', 'Utilizador');
        data.addColumn ('number','Pontuação');
        data.addRows([
            <?
                for ($i=0;$i<count($result);$i++){
                    echo "['".$result[$i]["Nome"]."', ".$result[$i]["Pontuacao"]."],";
                }
            ?>
        ]);
        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
    }
    function updateConta(){
        location.href='formUpdate.php';
    };
    </script>
</head>
<body>
<?
    include('navbar.php');
    ?>
    <main>
        <div class="container">
        <?
        if (empty($_SESSION) || !array_key_exists('Nome',$_SESSION) || !isset($_SESSION['Nome'])){
            ?><h1>Seja bem vindo ao Socialite!</h1><br>
        <p>O Socialite é uma nova plataforma social onde todos os utilizadores podem partilhar oque lhes dá mais gosto, em forma de publicações, e onde ganham pontos por isso!</p>
        <p><h3>Soa-lhe interessante? Então <a href="formRegisto.php">registe-se aqui!</a></p>';
<?
        } else {
            $myDbManager = new classes_DbManagerPDO();
                $myUserManager = new classes_UserManager($myDbManager);
                $myUser = new classes_User($_SESSION,'SessionSet');
                
                $Nome = $myUser->getUsername();
                $typeUser= $myUser->getAdmin();
                ?>
        <h1>Seja bem-vindo, <?echo $Nome;?>!</h1><br>

        <h1>Tabela de Pontuações:</h1>
        <div id="table_div"></div><br><br>
        <h3>Gostaria de realizar modificações na sua conta?</h3>
        <button class="btn btn-primary" onclick="updateConta()">Clique Aqui</button>
        <?
        
        };
        ?> 
        </div>
    </main>
    <?
    include ("footer.php");
?>
</body>
</html>