<?php
error_reporting(1);
require_once('../config/cors.php');
require_once('../models/miembros.model.php');

$miembro = new Clase_Miembros();
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case "GET":
        if (isset($_GET["id"])) {
            $uno = $miembro->uno($_GET["id"]);
            echo json_encode(mysqli_fetch_assoc($uno));
        } else {
            $datos = $miembro->todos();
            $todos = array();
            while ($fila = mysqli_fetch_assoc($datos)) {
                array_push($todos, $fila);
            }
            echo json_encode($todos);
        }
        break;
    case "POST":
        if (isset($_GET["op"]) && $_GET["op"] == "actualizar") {
            $id = $_POST["id_miembro"];
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $email = $_POST["email"];
            $fecha_suscripcion = $_POST["fecha_suscripcion"];

            if (!empty($id) && !empty($nombre) && !empty($apellido) && !empty($email) && !empty($fecha_suscripcion)) {
                $actualizar = $miembro->actualizar($id, $nombre, $apellido, $email, $fecha_suscripcion);

                if ($actualizar) {
                    echo json_encode(array("message" => "Se actualizó correctamente"));
                } else {
                    echo json_encode(array("message" => "Error, no se actualizó"));
                }
            } else {
                echo json_encode(array("message" => "Error, faltan datos"));
            }
        } else {
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $email = $_POST["email"];
            $fecha_suscripcion = $_POST["fecha_suscripcion"];

            if (!empty($nombre) && !empty($apellido) && !empty($email) && !empty($fecha_suscripcion)) {
                $insertar = $miembro->insertar($nombre, $apellido, $email, $fecha_suscripcion);

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
        // Puedes implementar la lógica de actualización usando PUT aquí si lo deseas.
        break;
    case "DELETE":
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id)) {
            try {
                $eliminar = $miembro->eliminar($data->id);
                echo json_encode(array("success" => true, "message" => "Se eliminó correctamente"));
            } catch (Exception $th) {
                echo json_encode(array("success" => false, "message" => "Error, no se pudo eliminar"));
            }
        } else {
            echo json_encode(array("success" => false, "message" => "Error, no se envió el ID"));
        }
        break;
}
