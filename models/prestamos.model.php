<?php
require_once('../config/conexion.php');
class Clase_Prestamos
{
    public function todos()
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT 
                        CONCAT(m.nombre, ' ', m.apellido) AS nombre_completo, 
                        l.titulo, 
                        p.fecha 
                    FROM 
                        prestamos p
                    JOIN 
                        miembros m ON p.id_miembro = m.id_miembro
                    JOIN 
                        libros l ON p.id_libro = l.id_libro;
                    ";
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
    public function insertar($id_libro, $id_miembro)
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $fecha = date("Y-m-d H:i:s");

        // Iniciar una transacción
        mysqli_begin_transaction($con);

        try {
            // Insertar el nuevo préstamo
            $cadenaInsertar = "INSERT INTO `prestamos`(`id_libro`, `id_miembro`, `fecha`) 
                           VALUES ('$id_libro', '$id_miembro', '$fecha');";
            $insertar = mysqli_query($con, $cadenaInsertar);

            // Actualizar el estado del libro a "prestado"
            $cadenaActualizar = "UPDATE `libros` SET `estado` = 'prestado' WHERE `id_libro` = '$id_libro';";
            $actualizar = mysqli_query($con, $cadenaActualizar);

            // Confirmar la transacción si ambas operaciones tuvieron éxito
            if ($insertar && $actualizar) {
                mysqli_commit($con);
                $con->close();
                return true;
            } else {
                // Revertir la transacción si alguna operación falla
                mysqli_rollback($con);
                $con->close();
                return false;
            }
        } catch (Exception $e) {
            // Manejar excepciones y revertir la transacción
            mysqli_rollback($con);
            $con->close();
            return false;
        }
    }
}
