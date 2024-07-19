<?php
require_once('../config/conexion.php');
class Clase_Libros
{
    public function todos()
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM `libros`";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }

    public function uno($id_libro)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM `libros` WHERE id_libro=$id_libro";

        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
    public function insertar($titulo, $autor, $genero, $anio)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO `libros`(`titulo`, `autor`, `genero`, `anio_publicacion`, `estado`) 
                    VALUES ('$titulo', '$autor', '$genero', '$anio', 'disponible');";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }

    public function actualizar($id_libro, $titulo, $autor, $genero, $anio)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE `libros` SET `titulo` = '$titulo', `autor` = '$autor', `genero` = '$genero', `anio_publicacion` = '$anio' WHERE `id_libro` = '$id_libro';";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }

    public function actualizarEstado($id_libro)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE `libros` SET `estado` = 'disponible' WHERE `id_libro` = '$id_libro';";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }

    public function eliminar($id_libro)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM `libros` where id_libro=$id_libro";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
}
