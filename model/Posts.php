<?php
require_once 'Config.php';
require_once 'model/Gateway.php';
require_once 'model/ValidationException.php';

class Posts {
    
    private $Gateway    = NULL;
    private $Config    = NULL;
    private $pdo    = NULL;
    private $pdoClose    = NULL;
  
    public function __construct() {
        $this->Gateway = new Gateway();
        $this->Config = new Config();
        $this->pdo = $this->Config->openDb();
        $this->pdoClose = $this->Config->closeDb();
    }
    
    public function getAll($model) {
        try {
            $res = $this->Gateway->selectAll($model,$this->pdo);
            $this->Config->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->Config->closeDb();
            throw $e;
        }
    }
    
    public function getPost($id,$model) {
        try {

            $res = $this->Gateway->getPost($id,$model,$this->pdo);
            $this->Config->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->Config->closeDb();
            throw $e;
        }
        return $this->Gateway->find($id);
    }
    
    private function validatePost( $title, $content) {

        $errors = array();
        if($title =='' && !strlen(trim($content))) {
            $errors[] = 'Title is required';
            $errors[] = 'Content is required';
        }else if($title =='' ) {
            $errors[] = 'Title is required';
        }else if(!strlen(trim($content))) {
            $errors[] = 'Content is required';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }    
    public function save($id,$title, $content,$model) {
        try {
            $this->Config->openDb();
            $this->validatePost($title, $content);
            $res = $this->Gateway->save($id,$title,$content,$model,$this->pdo);
            $this->Config->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->Config->closeDb();
            throw $e;
        }
    }   
}
?>
