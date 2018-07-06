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

    # obtener post y el numero de filas devueltas
    $result = $post->read();
    $num = $result->rowCount();

    if ($num > 0) {
        # crear un arreglo de post
        # crear la llave 'data' para luego poner todos los post dentro de ella
        $post_arr = array();
        $post_arr['data'] = array();

        # iterar los resultados
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            # extraigo las llaves 'id' 'name' etc y las convierto en variables ($id, $name, etc)
            extract($row);

            # paso los datos a un arreglo auxiliar
            $post_item = array(
                'id' => $id,
                'title' => $title,
                'body' => htmlspecialchars_decode($body),
                'author' => $author,
                'category_id' => $category_id,
                'category_name' => $category_name
            );

            # paso los datos del arreglo auxiliar al arreglo principal, dentro de la llave 'data'
            array_push($post_arr['data'], $post_item);
        }

        # convierto el arreglo en json
        echo json_encode($post_arr);
    } else {
        # devuelvo una respuesta en json con el msje de error
        echo json_encode(array('message' => 'No Posts Found'));
    }


?>