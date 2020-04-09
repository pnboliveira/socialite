<?

class classes_ComentManager{

    private $_myDb = null;
    
    public function __construct($dbManager){

        if(!is_a($dbManager,'classes_DbManagerPDO')){
            throw new InvalidArgumentException('Invalid data type object');
        }
        else{
            $this->_myDb = $dbManager;
        }
    }

    public function insertComent($content, $idPub){
        if(isset($content)){

            $query0="SELECT id_util FROM publication WHERE id_pub = :id";
            $parameters0 = array('id'=>$idPub);
            $result0 = $this->_myDb->executeQuery($query0, $parameters0);
            $idUtilizador = $result0->fetch(PDO::FETCH_ASSOC);
            

            $query2="SELECT Nome FROM users WHERE Id = :id1";
            $parameters2 = array('id1'=>$idUtilizador['id_util']);
            $result2 = $this->_myDb->executeQuery($query2, $parameters2);
            $NomePub = $result2->fetch(PDO::FETCH_ASSOC);
           

           
            $query = "INSERT INTO Coments(Id_pub,Id_util,Content,Avaliacao) VALUES(:idpub,:idutil,:content,:avaliacao)";
            $parameters = array('idpub'=>$content->getIdPublication(),'idutil'=>$content->getIdUser(),'content'=>$content->getContent(),'avaliacao'=>$content->getEvaluation());
            $result = $this->_myDb->executeQuery($query, $parameters);

            $query1 = "UPDATE users SET Pontuacao = Pontuacao + (:avaliacao) WHERE Nome = (:nome)";
            $parameters1 = array('avaliacao'=>$content->getEvaluation(),'nome'=>$NomePub['Nome']);
            $result1 = $this->_myDb->executeQuery($query1, $parameters1);
            
        }

    }

    public function getComents($idpub){
        $query = "SELECT * FROM Coments WHERE Id_pub = (:id)";
        $parameters = array('id'=>$idpub);
        $result = $this->_myDb->executeQuery($query, $parameters);
        $values = $result->fetchAll(PDO::FETCH_ASSOC);
 


        if($result){
            
            return($values);
            
        }


    }

    public function getNameComent($idutil){  

        $query = "SELECT Nome FROM users WHERE Id = (:id)";
        $parameters = array('id'=>$idutil);
        $result = $this->_myDb->executeQuery($query, $parameters);
        $NomeUtil = $result->fetch(PDO::FETCH_ASSOC);

        if($result){
            return($NomeUtil);
        }
    }

}



?>