<?

class classes_PublicationManager{
    private $_suportedFormats = array('image/png','image/jpg','image/jpeg', 'image/gif','image/PNG','image/JPG','image/JPEG', 'image/GIF');
    private $_myDb = null;
    
    public function __construct($dbManager){

        if(!is_a($dbManager,'classes_DbManagerPDO')){
            throw new InvalidArgumentException('Invalid data type object');
        }
        else{
            $this->_myDb = $dbManager;
        }
    }

    public function uploadFile($publication){
        if(!is_a($publication,'classes_Publication')){
            throw new InvalidArgumentException('Invalid Data type object');
        }

        if(isset($publication)){
           
        
            $query = "INSERT INTO publication(id_util,imagem,descricao) VALUES(:id_util, :imagem, :descricao)";
            $parameters = array('id_util' => $publication->getIdUtil(),'imagem'=> $publication->getImage(),'descricao'=> $publication->getDesc());
            $result = $this->_myDb->executeQuery($query, $parameters); 
            
            $query1 = "UPDATE users SET Pontuacao = Pontuacao + 5 WHERE Id =:id_util";
            $parameters1 = array('id_util' => $publication->getIdUtil());
            $result1 = $this->_myDb->executeQuery($query1, $parameters1); 

            if($result){
                
                return(true);
            }else{
                die('tá mal');
            }
        }

    }

    public function listSelfPub($id){

        $query = "SELECT * FROM publication WHERE id_util=(:id_util)";
        $parameters = array('id_util' => $id);
        $result = $this->_myDb->executeQuery($query, $parameters); 
        $values = $result->fetchAll(PDO::FETCH_ASSOC);
        if($result){
          return($values);
    }
}
    
    public function listAllPub(){

        $query = "SELECT * FROM publication";
        $parameters = array();
        $result = $this->_myDb->executeQuery($query, $parameters); 
        $values = $result->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            
          return($values);
        }
    }

    public function listOnePub($id){
        $query = "SELECT * FROM publication WHERE id_pub = (:id)";
        $parameters = array('id' => $id);
        $result = $this->_myDb->executeQuery($query, $parameters); 
        $values = $result->fetch(PDO::FETCH_ASSOC);
        if($result){
            
          return($values);
        }

    }

    public function deletePub($id){
        $query = "DELETE FROM publication WHERE id_pub = (:id)";
        $parameters = array('id' => $id);
        $result = $this->_myDb->executeQuery($query, $parameters);
        if($result){
          return(true);
        }

    }
        



    }

    

?>