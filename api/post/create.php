<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Autorization, X-Requested-With');


    include_once('../../config/Database.php');
    include_once('../../models/Post.php');

    # instancear base de datos y conectarse
    $database = new Database();
    $db = $database->connect();

    # instancear un objeto de posts
    $post = new Post($db);

    # get raw data
    # como enviare datos a traves de json, los dato que envío 
    # debo decodificarlos para pasarlos a un arreglo de php
    # para luego asignar las propiedades e instertar un post
    $data = json_decode(file_get_contents("php://input"));

    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;

    if ($post->create()) {
        echo json_encode(array('message' => 'Post Created'));
    } else{
        echo json_encode(array('message' => 'Post NOT Created'));
    }


?>

