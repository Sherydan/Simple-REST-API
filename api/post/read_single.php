<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');


    include_once('../../config/Database.php');
    include_once('../../models/Post.php');

    # instancear base de datos y conectarse
    $database = new Database();
    $db = $database->connect();

    # instancear un objeto de posts
    $post = new Post($db);
    # como instance un post, puedo setear sus propiedades
    # seteo la propiedad id, para poder traer el post
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    # llamo a la funcion read single de la clase post para traer el post
    $post->readSingle();

    # crear arreglo con el post
    # seteo los datos con las popiedades ya seteadas de la clase post
    # las propiedades se setean al ejecutar el metodo "readSingle"
    $post_arr = array(
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name
    );

    if (!empty($post_arr['title'])) {
        echo json_encode($post_arr); 
        
    } else {
        echo json_encode(array('Message' => 'No post found'));
    }
    
    


?>