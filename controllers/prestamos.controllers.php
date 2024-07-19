<?php
error_reporting(1);
require_once('../config/cors.php');
require_once('../models/prestamos.model.php');

$prestamo = new Clase_Prestamos();
$metodo = $_SERVER['REQUEST_METHOD'];


switch ($metodo) {
    case "GET":
        if (isset($_GET["id"])) {
            $uno = $prestamo->uno($_GET["id"]);
            echo json_encode(mysqli_fetch_assoc($uno));
        } else {
            $datos = $prestamo->todos();
            $todos = array();
            while ($fila = mysqli_fetch_assoc($datos)) {
                array_push($todos, $fila);
            }
            echo json_encode($todos);
        }
        break;
    case "POST":
        $id_libro = $_POST["id_prestamo"];
        $id_miembro = $_POST["id_miembro"];

        if (!empty($id_libro) && !empty($id_miembro)) {
            $insertar = $prestamo->insertar($id_libro, $id_miembro);

            if ($insertar) {
                echo json_encode(array("message" => "Se insertó correctamente"));
            } else {
                echo json_encode(array("message" => "Error, no se insertó"));
            }
        } else {
            echo json_encode(array("message" => "Error, faltan datos"));
        }

        break;
    case "PUT":
        break;
    case "DELETE":
        break;
}
