<?php 
/* Clase para ejecutar las consultas a la Base de Datos */
class ejecutarSQL {
    public static function conectar() {
        if (!$con = mysqli_connect(SERVER, USER, PASS)) {
            die("Error en el servidor, verifique sus datos");
        }
        if (!mysqli_select_db($con, BD)) {
            die("Error al conectar con la base de datos, verifique el nombre de la base de datos");
        }
        /* Codificar la información de la base de datos a UTF8 */
        mysqli_set_charset($con, 'utf8');
        return $con;  
    }

    public static function consultar($query) {
        $con = ejecutarSQL::conectar();
        if (!$consul = mysqli_query(ejecutarSQL::conectar(), $query)) {
            die(mysqli_error($con) . 'Error en la consulta SQL ejecutada');
        }
        return $consul;
    }  
}

/* Clase para hacer las consultas Insertar, Eliminar y Actualizar */
class consultasSQL {
    public static function InsertSQL($tabla, $campos, $valores) {
        if (!$consul = ejecutarSQL::consultar("INSERT INTO $tabla ($campos) VALUES ($valores)")) {
            die("Ha ocurrido un error al insertar los datos en la tabla $tabla");
        }
        return $consul;
    }

    public static function DeleteSQL($tabla, $condicion) {
        if (!$consul = ejecutarSQL::consultar("DELETE FROM $tabla WHERE $condicion")) {
            die("Ha ocurrido un error al eliminar los registros en la tabla $tabla");
        }
        return $consul;
    }

    public static function UpdateSQL($tabla, $campos, $condicion) {
        if (!$consul = ejecutarSQL::consultar("UPDATE $tabla SET $campos WHERE $condicion")) {
            die("Ha ocurrido un error al actualizar los datos en la tabla $tabla");
        }
        return $consul;
    }
}
