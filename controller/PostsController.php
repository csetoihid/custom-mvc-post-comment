<?php
require_once 'model/Posts.php';
require_once 'Config.php';

class PostsController {
    
    private $posts = NULL;
    private $model = Null;
    private $config = Null;
    public function __construct() {
        $this->posts = new Posts();
        $this->model = 'posts';
        $this->config = new Config();
    }
    /* manage undefined method*/
    public function __call($method, $arguments) {
        if (!method_exists($this, $method)) {
            $this->showError("Method not found", "Method for operation ".$method." was not found!");
        }
    }
    public function redirect($location) {
        header('Location: '.$location);
    }

    public function all() {
        $posts = $this->posts->getAll($this->model);
        include 'view/posts.php';
    }
    
    public function save($postId) {
        $title = '';
        $content = '';
        $id = isset($postId) ?  $postId  :NULL;
        $errors = array();
        $post = $this->posts->getPost($id,$this->model);

        if ( isset($_POST['form-submitted']) ) {
            $id          = isset($_POST['id']) ?   $_POST['id']  :NULL;
            $title       = isset($_POST['title']) ?   $_POST['title']  :NULL;
            $content     = isset($_POST['content'])?   htmlentities($_POST['content']) :NULL;
            try {
                $this->posts->save($id,$title, $content,$this->model);
                $this->redirect($_SESSION['baseUrl'].'/posts/all');
                return;
            }catch (ValidationException $e) {
                $errors = $e->getErrors();
            }
        }
        
        include 'view/post-form.php';
    }
    
    
    public function showError($title, $message) {
        include 'view/error.php';
    }
    
}
?>
