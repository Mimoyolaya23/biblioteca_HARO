<?php
error_reporting(1);
require_once('../config/cors.php');
require_once('../models/libros.model.php');

$libro = new Clase_Libros();
$metodo = $_SERVER['REQUEST_METHOD'];


switch ($metodo) {
    case "GET":
        if (isset($_GET["id"])) {
            $uno = $libro->uno($_GET["id"]);
            echo json_encode(mysqli_fetch_assoc($uno));
        } else {
            $datos = $libro->todos();
            $todos = array();
            while ($fila = mysqli_fetch_assoc($datos)) {
                array_push($todos, $fila);
            }
            echo json_encode($todos);
        }
        break;
    case "POST":
        if (isset($_GET["op"]) && $_GET["op"] == "actualizar") {
            $id = $_POST["id_libro"];
            $titulo = $_POST["titulo"];
            $autor = $_POST["autor"];
            $genero = $_POST["genero"];
            $anio = $_POST["anio"];

            if (!empty($id) && !empty($titulo) && !empty($autor) && !empty($genero) && !empty($anio)) {
                $actualizar = $libro->actualizar($id, $titulo, $autor, $genero, $anio);

                if ($actualizar) {
                    echo json_encode(array("message" => "Se actualizó correctamente"));
                } else {
                    echo json_encode(array("message" => "Error, no se actualizó"));
                }
            } else {
                echo json_encode(array("message" => "Error, faltan datos"));
            }
        } else {
            $titulo = $_POST["titulo"];
            $autor = $_POST["autor"];
            $genero = $_POST["genero"];
            $anio = $_POST["anio"];

            if (!empty($titulo) && !empty($autor) && !empty($genero) && !empty($anio)) {
                $insertar = $libro->insertar($titulo, $autor, $genero, $anio);

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
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id)) {
            try {
                $eliminar = $libro->eliminar($data->id);
                echo json_encode(array("success" => true, "message" => "Se eliminó correctamente"));
            } catch (Exception $th) {
                echo json_encode(array("success" => false, "message" => "Error, no se pudo eliminar"));
            }
        } else {
            echo json_encode(array("success" => false, "message" => "Error, no se envió el ID"));
        }
        break;
    case "DEVOLVER":
        $data = json_decode(file_get_contents("php://input"));
        if (!empty($data->id_libro)) {
            $actualizar = $libro->actualizarEstado($data->id_libro);

            if ($actualizar) {
                echo json_encode(array("success" => true, "message" => "El libro se ha devuelto correctamente."));
            } else {
                echo json_encode(array("success" => false, "message" => "Error, no se pudo actualizar el estado del libro."));
            }
        } else {
            echo json_encode(array("success" => false, "message" => "Error, faltan datos."));
        }
        break;
}
