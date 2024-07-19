<?php
error_reporting(1);
require_once('../config/cors.php');
require_once('../models/products.model.php');

$product = new Clase_Products();
$metodo = $_SERVER['REQUEST_METHOD'];


switch ($metodo) {
    case "GET":
        if (isset($_GET["id"])) {
            $uno = $product->uno($_GET["id"]);
            echo json_encode(mysqli_fetch_assoc($uno));
        } else {
            $datos = $product->todos();
            $todos = array();
            while ($fila = mysqli_fetch_assoc($datos)) {
                array_push($todos, $fila);
            }
            echo json_encode($todos);
        }
        break;
    case "POST":
        if (isset($_GET["op"]) && $_GET["op"] == "actualizar") {
            $id = $_POST["ProductId"];
            $Nombre = $_POST["Nombre"];
            $precio = $_POST["precio"];
            $stock = $_POST["stock"];

            // Verificar que los datos necesarios no estén vacíos
            if (!empty($id) && !empty($Nombre) && !empty($precio) && !empty($stock)) {
                $actualizar = $product->actualizar($id, $Nombre, $precio, $stock);

                if ($actualizar) {
                    echo json_encode(array("message" => "Se actualizó correctamente"));
                } else {
                    echo json_encode(array("message" => "Error, no se actualizó"));
                }
            } else {
                echo json_encode(array("message" => "Error, faltan datos"));
            }
        } else {
            // Para la inserción de nuevos productos
            $Nombre = $_POST["Nombre"];
            $precio = $_POST["precio"];
            $stock = $_POST["stock"];

            // Verificar que los datos necesarios no estén vacíos
            if (!empty($Nombre) && !empty($precio) && !empty($stock)) {
                $insertar = $product->insertar($Nombre, $precio, $stock);

                if ($insertar) {
                    echo json_encode(array("message" => "Se insertó correctamente"));
                } else {
                    echo json_encode(array("message" => "Error, no se insertó"));
                }
            } else {
                echo json_encode(array("message" => "Error, faltan datos"));
            }
        }
        break;
    case "PUT":
        break;
    case "DELETE":
        // Leer datos del cuerpo de la solicitud (formato JSON)
        $data = json_decode(file_get_contents("php://input"));

        // Verificar que se recibió un ID válido
        if (!empty($data->id)) {
            try {
                // Intentar eliminar el producto usando el ID recibido
                $eliminar = $product->eliminar($data->id);
                echo json_encode(array("success" => true, "message" => "Se eliminó correctamente"));
            } catch (Exception $th) {
                echo json_encode(array("success" => false, "message" => "Error, no se pudo eliminar"));
            }
        } else {
            echo json_encode(array("success" => false, "message" => "Error, no se envió el ID"));
        }
        break;
}
