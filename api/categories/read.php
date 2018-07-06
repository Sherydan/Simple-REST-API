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

    # obtener categorias y el numero de filas devueltas
    $result = $categories->read();
    $num = $result->rowCount();

    if ($num > 0) {
        # crear un arreglo de categorias
        # crear la llave 'data' para luego poner todos las categorias dentro de ella
        $cat_arr = array();
        $cat_arr['data'] = array();

        # iterar los resultados
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            # extraigo las llaves 'id' 'name' etc y las convierto en variables ($id, $name, etc)
            extract($row);

            # paso los datos a un arreglo auxiliar
            $cat_item = array(
                'id' => $id,
                'name' => $name,
                'created_at' => $created_at
            );

            # paso los datos del arreglo auxiliar al arreglo principal, dentro de la llave 'data'
            array_push($cat_arr['data'], $cat_item);
        }

        # convierto el arreglo en json
        echo json_encode($cat_arr);
    }