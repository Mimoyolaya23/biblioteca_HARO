<?php
require_once('../config/conexion.php');
class Clase_Products
{
    //TODO: procedimiento para obtener todos los productos de la base de datos
    public function todos()
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM `productos`";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }

    public function uno($ProductId)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM `productos` WHERE id=$ProductId";

        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
    public function insertar($nombre, $precio, $stock)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "INSERT INTO `productos`(`nombre`, `precio`, `stock`) VALUES ('$nombre', '$precio', '$stock')";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }

    public function actualizar($productId, $nombre, $precio, $stock)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "UPDATE `productos` SET `nombre`='$nombre', `precio`='$precio', `stock`='$stock' WHERE id=$productId";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }

    public function eliminar($productId)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "DELETE FROM `productos` where id=$productId";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }
}
