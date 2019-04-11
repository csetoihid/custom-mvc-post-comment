<?php
require_once 'Config.php';
$Config = new Config();
$params = $Config->params();
if(!empty($params)){    
    $controller = ucfirst($params['controller']).'Controller';
    $method = $params['method'];
    $args = $params['args'];
    $classPath =   'controller/'.$controller.".php";
    /*
    Auto load for class and method
    */
    if(file_exists($classPath)){
        include_once $classPath;
        $obj = new $controller();
        try {
            $obj->$method($args);
        } catch (exception $e) {
            echo $e->getMessage();
        }   
    }else{
        echo 'Invalid request, Please try again!';
    }
}else{
    /*Define home page*/
    include_once 'controller/PostsController.php';
    $obj = new PostsController();
    $obj->all();
}







