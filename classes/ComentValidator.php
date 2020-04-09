<?

class classes_ComentValidator{

    public function checkComent($coment){
        $comentario = $coment['coment'];

        if(strlen($comentario) > 500){
            throw new InvalidArgumentException('Comentario demasiado grande');
        }else{
            return(true);
        }
    }


}

?>