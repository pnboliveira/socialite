<?
class classes_Publication{
    private $_idPub;
    private $_idUtil;
    private $_image;
    private $_desc;
    

    public function __construct($data,$session,$img){
       
        $this->_idPub = null;     
        $this->_idUtil = $session;
        $this->_desc = $data['descpub'];
        $this->_image = 'upload/'.$img['file']['name'];

        }


    

    public function getIdPub(){
        return $this->_idPub;
    }
    
    public function getIdUtil(){
        return $this->_idUtil;
    }
    
    public function getDesc(){
        return $this->_desc;
    }

    public function getImage(){
        return $this->_image;
    }

    
}

?>