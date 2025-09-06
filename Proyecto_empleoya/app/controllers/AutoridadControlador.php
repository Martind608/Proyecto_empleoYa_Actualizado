<?php
class Controlador {
    // Otras funciones del Controlador

    public function consultarBajasPorFecha($fechaInicio, $fechaFin) {
        try {
            $db = new Database();
            $conn = $db->getConnection();

            $query = "SELECT Nombre, Apellido, Fecha_baja FROM postulantes WHERE Fecha_baja BETWEEN ? AND ?";
            $stmt = $conn->prepare($query);

            // Vincular los parámetros
            $stmt->bind_param("ss", $fechaInicio, $fechaFin);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados
            $result = $stmt->get_result();

            // Devolver los resultados como un array
            $resultados = [];
            while ($fila = $result->fetch_assoc()) {
                $resultados[] = $fila;
            }

            return $resultados;
        } catch (mysqli_sql_exception $e) {
            // Manejar errores de conexión a la base de datos aquí
            return [];
        }
    }

    public function consultarBajasPorFechaEmpresas($fechaInicio, $fechaFin) {
        try {
            $db = new Database();
            $conn = $db->getConnection();

            $query = "SELECT RazonSocial, SitioWeb, Fecha_baja FROM empresas WHERE Fecha_baja BETWEEN ? AND ?";
            $stmt = $conn->prepare($query);

            // Vincular los parámetros
            $stmt->bind_param("ss", $fechaInicio, $fechaFin);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados
            $result = $stmt->get_result();

            // Devolver los resultados como un array
            $resultados = [];
            while ($fila = $result->fetch_assoc()) {
                $resultados[] = $fila;
            }

            return $resultados;
        } catch (mysqli_sql_exception $e) {
            // Manejar errores de conexión a la base de datos aquí
            return [];
        }
    }

    public function obtenerTodosLosPostulantes() {
        try {
            $db = new Database();
            $conn = $db->getConnection();
    
            $query = "SELECT IDUsuario,Nombre, Apellido, DNI FROM postulantes";
            $result = $conn->query($query);
    
            // Verificar si se obtuvieron resultados
            if ($result->num_rows > 0) {
                $resultados = [];
                while ($fila = $result->fetch_assoc()) {
                    $resultados[] = $fila;
                }
                return $resultados;
            } else {
                return []; // Devolver un array vacío si no hay resultados
            }
        } catch (mysqli_sql_exception $e) {
            // Manejar errores de conexión a la base de datos aquí
            return [];
        }
    }
    
    public function mostrarPostulantes() {
        // Lógica para obtener todos los postulantes
        $todosLosPostulantes = $this->obtenerTodosLosPostulantes();
    
        // Depuración
        var_dump($todosLosPostulantes);
    
        // Redirigir a la vista de postulantes y pasar los resultados
        include '../views/Autoridad/EstadisticasPostulante.php';
    }
    public function obtenerTodasLasEmpresas() {
        try {
            $db = new Database();
            $conn = $db->getConnection();
    
            $query = "SELECT IDUsuario,RazonSocial, SitioWeb FROM empresas";
            $result = $conn->query($query);
    
            // Verificar si se obtuvieron resultados
            if ($result->num_rows > 0) {
                $resultados = [];
                while ($fila = $result->fetch_assoc()) {
                    $resultados[] = $fila;
                }
                return $resultados;
            } else {
                return []; // Devolver un array vacío si no hay resultados
            }
        } catch (mysqli_sql_exception $e) {
            // Manejar errores de conexión a la base de datos aquí
            return [];
        }
    }
    
    public function mostrarEmpresas() {
        // Lógica para obtener todos los postulantes
        $todasLasEmpresas = $this->obtenerTodasLasEmpresas();
    
        // Depuración
        var_dump($todasLasEmpresas);
    
        // Redirigir a la vista de postulantes y pasar los resultados
        include '../views/Autoridad/EstadisticasEmpresa.php';
    }


    public function mostrarDetalleEmpresa($IDUsuario) {
        // Obtener información de la empresa
        $empresa = $this->obtenerInformacionEmpresa($IDUsuario);

        // Obtener ofertas activas
        $ofertas = $this->obtenerOfertasActivas($IDUsuario);

        // Lógica para cargar la vista de detalle de empresa
        include '../views/Autoridad/DetalleEmpresa.php';
    }

    public function obtenerInformacionEmpresa($IDUsuario) {
        try {
            $db = new Database();
            $conn = $db->getConnection();

            // Realizar la consulta SQL de manera segura usando una consulta preparada
            $sql = "SELECT RazonSocial, SitioWeb FROM Empresas WHERE IDUsuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $IDUsuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return []; // Devolver un array vacío si no hay resultados
            }
        } catch (mysqli_sql_exception $e) {
            // Manejar errores de conexión a la base de datos aquí
            return [];
        }
    }

    public function obtenerOfertasActivas($IDUsuario) {
        try {
            $db = new Database();
            $conn = $db->getConnection();

            // Realizar la consulta SQL de manera segura usando una consulta preparada
            $sql = "SELECT COUNT(*) as CantidadOfertas FROM Empleos WHERE IDEmpresa = ? AND Activo = 0";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $IDUsuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return ['CantidadOfertas' => 0];
            }
        } catch (mysqli_sql_exception $e) {
            // Manejar errores de conexión a la base de datos aquí
            return [];
        }
    }

    public function obtenerOfertas($IDUsuario) {
    try {
        $db = new Database();
        $conn = $db->getConnection();

        // Realizar la consulta SQL de manera segura usando una consulta preparada
        $sql = "SELECT Titulo, Descripcion, Ubicacion, Modalidad, TipoEmpleo, Salario, FechaPublicacion FROM Empleos WHERE IDEmpresa = ? AND Activo = 0";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $IDUsuario);
        $stmt->execute();
        $result = $stmt->get_result();

        $ofertas = [];
        while ($row = $result->fetch_assoc()) {
            $ofertas[] = $row;
        }

        return $ofertas;
    } catch (mysqli_sql_exception $e) {
        // Manejar errores de conexión a la base de datos aquí
        return [];
    }
}
    //-------------------------------------------------------------------------

    public function mostrarDetallePostulante($IDUsuario) {
        // Obtener información de la empresa
        $postulante = $this->obtenerInformacionPostulante($IDUsuario);

        // Obtener ofertas activas
        $ofertas = $this->obtenerPostulacionesActivas($IDUsuario);

        // Lógica para cargar la vista de detalle de postulante
        include '../views/Autoridad/DetallePostulante.php';
    }

    public function obtenerInformacionPostulante($IDUsuario) {
        try {
            $db = new Database();
            $conn = $db->getConnection();

            // Realizar la consulta SQL de manera segura usando una consulta preparada
            $sql = "SELECT Nombre, Apellido,DNI FROM postulantes WHERE IDUsuario = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $IDUsuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return []; // Devolver un array vacío si no hay resultados
            }
        } catch (mysqli_sql_exception $e) {
            // Manejar errores de conexión a la base de datos aquí
            return [];
        }
    }

    public function obtenerPostulacionesActivas($IDUsuario) {
        try {
            $db = new Database();
            $conn = $db->getConnection();

            // Realizar la consulta SQL de manera segura usando una consulta preparada
            $sql = "SELECT COUNT(*) as CantidadPostulaciones FROM postulaciones WHERE IDPostulante = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $IDUsuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return ['CantidadPostulaciones' => 0];
            }
        } catch (mysqli_sql_exception $e) {
            // Manejar errores de conexión a la base de datos aquí
            return [];
        }
    }

    public function obtenerPostulaciones($IDUsuario, $conn) {
        $sql = "SELECT e.Titulo, e.Descripcion, e.Ubicacion, e.Modalidad, e.TipoEmpleo, e.Salario, e.FechaPublicacion
                FROM empleos e
                INNER JOIN postulaciones p ON e.IDEmpleo = p.IDEmpleo
                WHERE p.IDPostulante = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $IDUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result;
    }
}
    

     

    

    
    
    
    





?>
