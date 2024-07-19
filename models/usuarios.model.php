<?php
// php es un lenguaje de programacion interpretado, por lo que no se compila, se ejecuta en el servidor
require_once('../config/conexion.php');
class Clase_Usuarios
{
    //TODO: procedimiento para obtener todos los usuarios de la base de datos
    public function todos()  ///select * from usuarios;
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT usuarios.`UsuarioId`, usuarios.`Nombre`, usuarios.correo, usuarios.estado, GROUP_CONCAT(roles.Detalle SEPARATOR ' - ') as rol FROM `usuarios` INNER JOIN usuarios_roles on usuarios.UsuarioId = usuarios_roles.UsuarioId INNER JOIN roles on usuarios_roles.RolesId = roles.RolesId GROUP by usuarios.`UsuarioId`, usuarios.`Nombre`, usuarios.correo, usuarios.estado";
        $todos = mysqli_query($con, $cadena);
        $con->close();
        return $todos;
    }

    public function loginParametros($correo, $password) //mayor seguridad
    {
        $con = new Clase_Conectar();
        $con = $con->Procedimiento_Conectar();
        $cadena = "SELECT * FROM `usuarios` WHERE `correo`=? AND `password`=?";
        $stmt = $con->prepare($cadena);
        $stmt->bind_param('ss', $correo, $password);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result;
        }
    }
}
