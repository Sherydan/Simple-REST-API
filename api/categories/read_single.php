<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');


    include_once('../../config/Database.php');
    include_once('../../models/Categories.php');

    # instancear base de datos y conectarse
    $database = new Database();
    $db = $database->connect();

    # instancear un objeto de categorias y le paso la conexion
    $categories = new Categories($db);

    $categories->id = isset($_GET['id']) ? $_GET['id'] : die();
    $categories->readSingle();

    $cat_arr = array(
        'id' => $categories->id,
        'name' => $categories->name,
        'created_at' => $categories->created_at
    );

    if (!empty($cat_arr['name'])) {
        echo json_encode($cat_arr); 
        
    } else {
        echo json_encode(array('Message' => 'Category not found'));
    }

   ?>