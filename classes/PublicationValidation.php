<?
class classes_PublicationValidation{

    private $_suportedFormats = array('image/png','image/jpg','image/jpeg','image/gif');
    private $_minsize = 87990000000000000;



    public function checkPub($file){
       
       
        if(is_array($file)){          
            if(in_array($file['file']['type'],$this->_suportedFormats)){
                    if($file['file']['size'] < $this->_minsize){
                    return(true);
                }else{
                    throw new InvalidArgumentException('File too big');
                }
            }else{
                throw new InvalidArgumentException('file not suported, please try again');
            }
            }else{
                throw new InvalidArgumentException('No file was uploaded');
        }

        
    }

    public function checkDesc($desc){

        if($desc['descpub']){
            if( strlen($desc['descpub']) < 500){
                return(true);
            }else{
                throw new InvalidArgumentException('Your description cant be bigger than 500 characters');
            }
        }else{
            throw new InvalidArgumentException('You need to describe your post');
        }


    }
    
}

?>