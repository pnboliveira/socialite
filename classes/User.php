<?php

class classes_User{
    private $_id;
    private $_username;
    private $_email;
    private $_password;
    private $_contato;
    private $_registed;
    private $_checkAdmin;
    private $_registerModel = array('Username','Email','Password', 'Contato');
    private $_sessionModel = array('Nome','Email', 'Password','Contato', 'Nivel');
    private $_loginModel = array('Username','Password');
    private $_allowedActions = array('Register', 'Login', 'SessionSet');
    
    public function __construct($data,$action){

        if(!in_array($action,$this->_allowedActions)){
            
            throw new InvalidArgumentException('Check your code!');
        }

        if ($action == 'Register'){
                for($i=0;$i<(sizeof($this->_registerModel));$i++){
                    if(!array_key_exists($this->_registerModel[$i],$data)){
                        throw new InvalidArgumentException('Invalid Register Array Format');
                    }
                }
                $this->_username = $data['Username'];
                $this->_email=$data['Email'];
                $this->_password=$data['Password'];
                $this->_contato=$data['Contato'];
                $this->_id=null;
                $this->_registed=null;
                
            }
        if ($action =='Login'){
                for($i=0;$i<(sizeof($this->_loginModel));$i++){
                    if(!array_key_exists($this->_loginModel[$i],$data)){
                        throw new InvalidArgumentException('Invalid Login array Format');
                    }
                }
                $this->_username = $data['Username'];
                $this->_password=$data['Password'];
                $this->_id=null;
                $this->_registed=null;
            }
            if ($action =='SessionSet'){
                for($i=0;$i<(sizeof($this->_sessionModel));$i++){
                    if(!array_key_exists($this->_sessionModel[$i],$data)){
                        throw new InvalidArgumentException('Invalid ID Format');
                    }
                }
                $this->_username = $data['Nome'];
                $this->_email=$data['Email'];
                $this->_contato=$data['Contato'];
                $this->_id=$data['Id'];
                $this->_checkAdmin=$data['Nivel'];
            }
        
    }//end construct

    //get data
    public function getUsername(){
        return($this->_username);
    }
    public function getEmail(){
        return($this->_email);
    }
    public function getPassword(){
        return($this->_password);
    }
    public function getId(){
        return($this->_id);
    }
    public function getRegisted(){
        return($this->_registed);
    }
    public function getContato(){
        return($this->_contato);
    }
    public function getAdmin(){
        if ($this->_checkAdmin ==1){
            $this->_checkAdmin = 'Admin';
            return($this->_checkAdmin);
        }else{
            $this->_checkAdmin = 'User';
            return($this->_checkAdmin);
        }
    }


//set data

    public function setUsername($username){
        $this->_username = $username;
    }

    public function setEmail($email){
        $this->_email = $email;
    }
    public function setPassword($password){
        $this->_password = $password;
    }


}
?>