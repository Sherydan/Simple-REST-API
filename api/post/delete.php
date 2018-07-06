<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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

    $post->id = $data->id;

    if ($post->delete()) {
        echo json_encode(array('message' => 'Post Deleted'));
    } else{
        echo json_encode(array('message' => 'Post NOT Deleted'));
    }


?>