<?php

class classes_UserManager{

    private $_myDb = null;
    
    public function __construct($dbManager){

        if(!is_a($dbManager,'classes_DbManagerPDO')){
            throw new InvalidArgumentException('Invalid data type object');
        }
        else{
            $this->_myDb = $dbManager;
        }
    }

    public function addUser($user){

        if(!is_a($user,'classes_User')){
            throw new InvalidArgumentException('Invalid Data type object');
        }

        $query = "SELECT * FROM users WHERE Nome = :username";
        $parameters = array('username' => $user->getUsername());
        $result = $this->_myDb->executeQuery($query, $parameters);

        $query1 = "SELECT * FROM users WHERE Email = :email";
        $parameters1 = array('email' => $user->getEmail());
        $result1 = $this->_myDb->executeQuery($query, $parameters);
    
        if($result->rowCount() > 0){
            throw new InvalidArgumentException('Username already exists!');
        } if ($result1->rowCount() > 0) {
            throw new InvalidArgumentException('Email already exists!');
        }else{
            $password=md5($user->getPassword());
            $query = "INSERT INTO users(Nome,Email,Password,Contato,DataRegisto) VALUES(:username, :email, :password, :contato, :data)";
            $parameters = array('username' => $user->getUsername(), 'email' => $user->getEmail(), 'password' => $password, 'contato' =>$user->getContato(), 'data'=>date('Y-m-d H:i:s'));
            $result = $this->_myDb->executeQuery($query, $parameters); 
    
            return(true);
        }

        
    }

    public function loginUser($user){
        if(!is_a($user,'classes_User')){
            throw new InvalidArgumentException('Invalid Data type object');
        }
        $password=md5($user->getPassword());
        $query = "SELECT * FROM users WHERE Nome = :username AND Password = :password";
        $parameters = array('username' => $user->getUsername(),'password'=>$password);
        $result = $this->_myDb->executeQuery($query, $parameters);
        $values = $result->fetch(PDO::FETCH_ASSOC);
        

        if ($values){
            session_start();
            $_SESSION = $values;
            return(true);
            } else {
                throw new InvalidArgumentException('O utilizador ou password está incorreta! Tente de novo.');
            }
        
    }

    public function updateData($user, $id, $action){
                if ($action== 'All'){
                    
                    $query = "SELECT * FROM users WHERE Nome = :username";
                    $parameters = array('username' => $user->getUsername());
                    $result = $this->_myDb->executeQuery($query, $parameters);

                    $query1 = "SELECT * FROM users WHERE Email = :email";
                    $parameters1 = array('email' => $user->getEmail());
                    $result1 = $this->_myDb->executeQuery($query, $parameters);
                
                    if($result->rowCount() > 0){
                        throw new InvalidArgumentException('Username already exists!');
                    } if ($result1->rowCount() > 0) {
                        throw new InvalidArgumentException('Email already exists!');
                    }else{
                        $password=md5($user->getPassword());
                        $query = "UPDATE users SET Nome = :nome, Email = :email, Password = :password, Contato =:contato WHERE Id=:id";
                        $parameters = array('nome' => $user->getUsername(), 'email' => $user->getEmail(), 'password' => $password, 'contato' =>$user->getContato(), 'id'=>$id->getId());
                       
                        $result = $this->_myDb->executeQuery($query, $parameters);
                        if ($result){
                            return(true);
                        }else{
                            return(false);
                        }
                    }
                
             }
        }

        public function deleteUser($id_user){
            
            $query = "DELETE FROM users WHERE Id = :id";
            $parameters = array('id' => $id_user);
            $result = $this->_myDb->executeQuery($query, $parameters);
            if ($result){
                return(true);
                } else{
                    return(false);
                }
            
        }

        public function orderScoreUser(){
            
            $query = "SELECT Nome, Pontuacao FROM users GROUP BY Pontuacao ORDER BY 2 DESC";
            $parameters = array();
            $result = $this->_myDb->executeQuery($query, $parameters);
            $values = $result->fetchAll(PDO::FETCH_ASSOC);
    
            if ($result){
                return($values);
                } else {
                    throw new InvalidArgumentException('Não existe nada na tabela de Pontuação.');
                }
            
        }

    }
?>