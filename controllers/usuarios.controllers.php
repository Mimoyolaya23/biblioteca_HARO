<?php
error_reporting(1);
require_once('../config/cors.php');
require_once('../models/usuarios.model.php');

$usuario = new Clase_Usuarios();
$metodo = $_SERVER['REQUEST_METHOD'];

switch ($metodo) {
    case "GET":

        break;
    case "POST":
        if (isset($_GET["op"]) == "login") {
            if (empty(trim($_POST["correo"]))  || empty(trim($_POST["contrasenia"]))) {
                header('Location: ../index.php?op=2');
                exit();
            }
            $correo = $_POST["correo"];
            $contrasena = $_POST["contrasenia"];

            $login = $usuario->loginParametros($correo, $contrasena);
            $res = mysqli_fetch_assoc($login);
            if ($res) {

                if ($res['password'] == $contrasena) {
                    header('Location:../views/dashboard.php');
                    exit();
                } else {
                    header('Location:../index.php?op=3');
                    exit();
                }
            } else {
                header('Location:../index.php?op=1');
                exit();
            }
        } elseif (isset($_GET["op"]) == "actualizar") {
        } else {
        }

        break;
    case "PUT":

        break;
    case "DELETE":

        break;
}
