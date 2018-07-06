<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Autorization, X-Requested-With');


    include_once('../../config/Database.php');
    include_once('../../models/Categories.php');

    # instancear base de datos y conectarse
    $database = new Database();
    $db = $database->connect();

    # instancear un objeto de categorias y le paso la conexion
    $categories = new Categories($db);

    $data = json_decode(file_get_contents("php://input"));

    $categories->id = $data->id;

    if ($categories->delete()) {
        echo json_encode(array('message' => 'Category Deleted'));
    } else{
        echo json_encode(array('message' => 'Category NOT Deleted'));
    }

?>