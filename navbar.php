<?
require_once('utils/Autoload.php'); //carrega todas as classes pertencentes à aplicação



    if(empty($_SESSION)){
        
        echo '<header>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Socialite</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                        <a class="nav-item nav-link" href="formLogin.php">Login</a>
                        <a class="nav-item nav-link" href="formRegisto.php">Registo</a>
                        </div>
                    </div>
                </nav>
        </header>';
       

        } else {
            
                $myDbManager = new classes_DbManagerPDO();
                $myUserManager = new classes_UserManager($myDbManager);
                $myUser = new classes_User($_SESSION,'SessionSet');
                
                $Nome = $myUser->getUsername();
                $typeUser= $myUser->getAdmin();
        
    
            if ($myUser->getAdmin() =="Admin"){
                echo '<header>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <a class="navbar-brand" href="#">Socialite</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                        <a class="nav-item nav-link active" href="index">Home <span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link" href="verAllPub">Publicações</a>
                        <a class="nav-item nav-link" href="verSelfPub">Tuas Publicações</a>
                        <a class="nav-item nav-link" href="publicar">Adicionar Publicação</a>
                        <a class="nav-item nav-link" href="formUpdate">Editar Conta</a>
                        <a class="nav-item nav-link" href="logout">Logout</a>
                        </div>
                    </div>
                </nav>
            </header>';
    
            } else {
            echo '<header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Socialite</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                    <a class="nav-item nav-link" href="index">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="verAllPub">Publicações</a>
                    <a class="nav-item nav-link" href="verSelfPub">Tuas Publicações</a>
                    <a class="nav-item nav-link" href="publicar">Adicionar Publicação</a>
                    <a class="nav-item nav-link" href="formUpdate">Editar Conta</a>
                    
                    <a class="nav-item nav-link" href="logout.php">Logout</a>
                    </div>
                </div>
            </nav>
        </header>';
        }
    }
    
?>