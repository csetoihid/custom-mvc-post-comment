<?php

class Config {

    private $pdo = Null;
    private $rootFolder = 'starweb_live';
    private $baseUrl = "http://localhost/sweden-job-challenges/starweb_live";
    /* Database access */
    private $serverName = "localhost";
    private $userName = "root";
    private $password = "";
    private $dbName = "starweb_mvc";

    public function __construct() {
        if(!isset($_SESSION)) 
        { 
            session_start(); 
            $_SESSION["baseUrl"] = $this->baseUrl;
        } 
    }
    public function baseUrl(){
        return $this->baseUrl;
    }
    /*
        Get parameters from URL
        Return params array
    */
    public function params(){
        $params = array(); 
        if(isset($_SERVER['REDIRECT_URL'])){
            $getParam = substr($_SERVER['REDIRECT_URL'], strpos($_SERVER['REDIRECT_URL'], $this->rootFolder) + strlen($this->rootFolder));
            $paramSplit = explode('/', ltrim($getParam));
             $params['controller'] = (isset($paramSplit[1])) ? $paramSplit[1] : null;
             $params['method'] = (isset($paramSplit[2])) ? $paramSplit[2] : null;
             $params['args'] = (isset($paramSplit[3])) ? $paramSplit[3] : null;
             $params['conditions'] = (isset($paramSplit[4])) ? $paramSplit[4] : null;
        }
         return $params;

    }
    /* Open Database connection*/
    public function openDb() {
        try {
            $this->pdo = new PDO("mysql:host=$this->serverName;dbname=$this->dbName", $this->userName, $this->password);
            /* set the PDO error mode to exception */
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();
            }
            return $this->pdo; 

    }
    /* Close Database connection*/
    public function closeDb() {
        $this->pdo = null;
    }
}

