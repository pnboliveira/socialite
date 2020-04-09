<?

class classes_Coment{
    private $_idComent;
    private $_idPublication;
    private $_idUser;
    private $_content;
    private $_evaluation;



public function __construct($idUser,$content,$idPublication,$avaliacao){
    $this->_idUser = $idUser;
    $this->_content = $content;
    $this->_idPublication = $idPublication;
    $this->_evaluation = $avaliacao;

}

public function getIdComent(){
    return($this->_idComent);
}
public function getIdPublication(){
    return($this->_idPublication);
}
public function getContent(){
    return($this->_content);
}
public function getIdUser(){
    return($this->_idUser);
}
public function getEvaluation(){
    return($this->_evaluation);
}
}
?>