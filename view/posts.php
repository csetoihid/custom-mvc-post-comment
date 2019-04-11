<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Posts</title>
        <link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['baseUrl']?>/view/css/style.css">
    </head>
    <body>
        <br/>
        <div class='addPost'><a class='button' href="<?php echo $_SESSION['baseUrl']?>/posts/save">Add new</a></div>
        <br/>
        <table class="posts">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td><?php echo htmlentities($post['title']); ?></td>
                    <td><?php echo stripslashes(html_entity_decode($post['content'])); ?></td>
                    <td><a class='button' href="<?php echo $_SESSION['baseUrl']?>/posts/save/<?php echo $post['id']; ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>
