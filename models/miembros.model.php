<?php
require_once('../config/conexion.php');
class Clase_Miembros
{
    public function todos()
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM `miembros`";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }

    public function uno($id_miembro)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM `miembros` WHERE id_miembro=$id_miembro";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }

    public function insertar($nombre, $apellido, $email, $fecha_suscripcion)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO `miembros`(`nombre`, `apellido`, `email`, `fecha_suscripcion`) 
                    VALUES ('$nombre', '$apellido', '$email', '$fecha_suscripcion');";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }

    public function actualizar($id_miembro, $nombre, $apellido, $email, $fecha_suscripcion)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE `miembros` SET `nombre` = '$nombre', `apellido` = '$apellido', `email` = '$email', `fecha_suscripcion` = '$fecha_suscripcion' WHERE `id_miembro` = '$id_miembro';";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }

    public function eliminar($id_miembro)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM `miembros` WHERE id_miembro=$id_miembro";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
}
