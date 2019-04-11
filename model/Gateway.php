<?php
/**
 * Table data gateway.
 * 
 */
class Gateway {
    
    public function selectAll($model,$pdo) {
        $posts = $pdo->query("SELECT * FROM $model ORDER BY id DESC");
        return $posts->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPost($id,$model,$pdo) {
        $dbId = $id;
        $stmt = $pdo->prepare("SELECT * FROM $model WHERE id=?");
        $stmt->execute([$dbId]); 
        $post = $stmt->fetch(PDO::FETCH_ASSOC);        
        return $post;
		
    }
    
    public function save( $id,$title,$content,$model,$pdo) {

        $dbId= ($id != NULL)? $id:NULL;
        $dbTitle= ($title != NULL)? $title:NULL;
        $dbContent = ($content != NULL)? $content:NULL;      
        $sql = "INSERT INTO $model
                    (`id`, `title`, `content`) 
                  VALUES
                    (:id, :title, :content) 
                  ON DUPLICATE KEY
                    UPDATE title = :title, content = :content";
        /* $conn is a PDO object */
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':id' => $id, ':title' => "$dbTitle", ':content' => "$dbContent"));

        return $pdo->lastInsertId();
    }
    
}

?>