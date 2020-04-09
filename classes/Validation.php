<?php
class classes_Validation{

    private $_registerFields = array('Username','Email','Password','rPassword', 'Contato', 'Gobtn');

    private $_loginFields = array('Username', 'Password', 'loginbtn');

    private $_emailFields = array('Email', 'upEmail');
    private $_userFields = array('Username', 'upUsername');
    private $_passFields = array('Password','rPassword', 'upEmail');

    private $_updateFields = array('Username','Email','Password', 'Contato', 'upAll');

    public function checkRegisterForm($data){
        for($i=0;$i<sizeof($this->_registerFields);$i++){

            if(!array_key_exists($this->_registerFields[$i],$data)){

                throw new InvalidArgumentException('Invalid Form data');

            }
        }

    

        $minUsername = 6;
        $maxUsername = 16;

        $minPass = 8;
        $maxPass = 64;

        $errors = array('username' => array(false,'Username inválido!'),
                        'email' => array(false,'Endereço de email inválido!'),
                        'Password' => array(false,'A palavra-passe está inválida! Terá de ter entre $minPass a $maxPass caracteres, com números ou sobrelinhas. ( _ )'),
                        'rPassword' => array(false,'As palavras-passes não coincidem!'),
                        'contato' => array(false, 'Contato inválido! Terá de ter até 9 caracteres.')   
                        );


        $flag = false;

        if( !$this->checkUsername($data['Username'],$minUsername,$maxUsername)){

            $errors['username'][0] = true;
            $flag = true;

        }
        
        if(!$this->checkEmail($data['Email'])){
            $errors['email'][0] = true;
            $flag = true;

        }

        if(!$this->checkPassword($data['Password'],$minPass,$maxPass)){

            $errors['password'][0] = true;
            $flag = true;

        }elseif($data['Password'] != $data['rPassword']){

            $errors['rPassword'][0] = true;
            $flag = true;

            }


        if(!$flag){
            return(true);
        }else{
            return($errors);
        }
    } //end method register

    public function checkLoginForm($data){

        for($i=0;$i<sizeof($this->_loginFields);$i++){

            if(!array_key_exists($this->_loginFields[$i],$data)){

                throw new InvalidArgumentException('Invalid Login data');

            }
        }

    

        $minUsername = 6;
        $maxUsername = 16;

        $minPass = 8;
        $maxPass = 64;

        $errors = array('username' => array(false,'Username inválido.'),
                        'Password' => array(false,'Palavra-passe incorreta.') 
                        );


        $flag = false;

        if( !$this->checkUsername($data['Username'],$minUsername,$maxUsername)){

            $errors['username'][0] = true;
            $flag = true;

        }
        

        if(!$this->checkPassword($data['Password'],$minPass,$maxPass)){

            $errors['Password'][0] = true;
            $flag = true;

        }        

        if(!$flag){
            return(true);
        }else{
            return($errors);
        }



    }
    
    public function checkUpdateForm($data){
        $minUsername = 6;
        $maxUsername = 16;

        $minPass = 8;
        $maxPass = 64;

        $errors = array('username' => array(false,'Username inválido!'),
                        'email' => array(false,'Endereço de email inválido!'),
                        'Password' => array(false,'A palavra-passe está inválida! Terá de ter entre $minPass a $maxPass caracteres, com números ou sobrelinhas. ( _ )'),
                        'rPassword' => array(false,'As palavras-passes não coincidem!'),
                        'contato' => array(false, 'Contato inválido! Terá de ter até 9 caracteres.')   
                        );


        $flag = false;
        if (array_key_exists('Email', $data)){
            
                        for($i=0;$i<sizeof($this->_emailFields);$i++){

                            if(!array_key_exists($this->_emailFields[$i],$data)){
                                throw new InvalidArgumentException('Invalid Email data');
                            }
                            if(!$this->checkEmail($data['Email'])){

                                $errors['email'][0] = true;
                                throw new InvalidArgumentException($errors['email'][0]);
                    
                            }
                    
                            if(!$flag){
                                return(true);
                            }else{
                                return($errors);
                            }
                        }
                    }
                    if (array_key_exists('Username',$data)){
                        for($i=0;$i<sizeof($this->_userFields);$i++){

                            if(!array_key_exists($this->_userFields[$i],$data)){
                                throw new InvalidArgumentException('Invalid Username data');
                            }
                            if(!$this->checkUsername($data['Username'],$minUsername,$maxUsername)){

                                $errors['Username'][0] = true;
                                throw new InvalidArgumentException($errors['Username'][0]);
                    
                            }
                    
                            if(!$flag){
                                return(true);
                            }else{
                                return($errors);
                            }
                        }
                    }
                    if (array_key_exists('Password',$data)){
                        for($i=0;$i<sizeof($this->_passFields);$i++){

                            if(!array_key_exists($this->_passFields[$i],$data)){
                                throw new InvalidArgumentException('Invalid Password data');
                            }
                            if(!$this->checkPassword($data['Password'],$minPass,$maxPass)){

                                $errors['password'][0] = true;
                                $flag = true;
                    
                            }elseif($data['Password'] != $data['rPassword']){
                    
                                $errors['rPassword'][0] = true;
                                $flag = true;
                    
                            }
                    
                            if(!$flag){
                                return(true);
                            }else{
                                return($errors);
                            }
                        }
                    }
                    
                    if (array_key_exists('UpdateAll',$data)){
                        for($i=0;$i<sizeof($this->_updateFields);$i++){

                            if(!array_key_exists($this->_updateFields[$i],$data)){
                                throw new InvalidArgumentException('Invalid Form data');
                            }
                            if( !$this->checkUsername($data['Username'],$minUsername,$maxUsername)){
                                $errors['username'][0] = true;
                                $flag = true;
                            }
                            
                            if(!$this->checkEmail($data['Email'])){
                    
                                $errors['email'][0] = true;
                                $flag = true;
                    
                            }
                    
                            if(!$this->checkPassword($data['Password'],$minPass,$maxPass)){

                                $errors['password'][0] = true;
                                $flag = true;
                    
                            }elseif($data['Password'] != $data['rPassword']){
                    
                                $errors['rPassword'][0] = true;
                                $flag = true;
                    
                                }
                            
                            
                            if(!$this->checkContato($data['Contato'])){
                    
                                $errors['contato'][0] = true;
                                $flag = true;
                        
                            }
                    
                    
                            if(!$flag){
                                return(true);
                            }else{
                                return($errors);
                            }
                        }
                    }
            }
       


    private function checkUsername($field,$min,$max){
        $exp = '/^[A-z0-9]{'.$min.','.$max.'}$/';

        if(!preg_match($exp,$field)){
            return(false);
        }
        else{
            return(true);
        }
        
    }

    private function checkEmail($email){
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return(false);
        }
        else{
            return(true);
        }
        
    }

    private function checkPassword($field,$min,$max){
	
        $exp = '/^[A-z-_0-9]{'.$min.','.$max.'}$/';
        
        if(!preg_match($exp,$field)){
            return(false);
        }
        else{
            return(true);
            }
    }

    private function checkContato($contato){

        if(strlen($contato)<9){
            return(false);
        }else{
            return(true);
        }

    }

}


?>