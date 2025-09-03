<?php
class UsuarioModelo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function verificarCredenciales($email, $password) {
        $query = "SELECT * FROM usuarios WHERE Email = ?";
        $stmt = $this->conexion->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
    
        if ($usuario && password_verify($password, $usuario['HashContrasenia'])) {
            return true; // Credenciales válidas
        } else {
            return false; // Credenciales inválidas
        }
    }
    public function obtenerTipoUsuario($email) {
        $query = "SELECT TipoUsuario FROM usuarios WHERE Email = ?";
        $stmt = $this->conexion->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return $row['TipoUsuario'];
        } else {
            return false; // Si no se encuentra el usuario, puedes manejar esto según tu lógica
        }
    }

    public function verificarVerificado($email) {
        $query = "SELECT verificado FROM usuarios WHERE Email = ?";
        $stmt = $this->conexion->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        if ($row) {
            return (bool) $row['verificado'];
        } else {
            return false; // Si no se encuentra el usuario, puedes manejar esto según tu lógica
        }
    }
    
 
    public function registrarPostulante($nombre, $apellido, $DNI, $email, $hashPassword, $telefono, $ciudad) {
        // Verifica si el correo electrónico ya existe
        $queryVerificarEmail = "SELECT ID FROM usuarios WHERE Email = ?";
        $stmtVerificarEmail = $this->conexion->conn->prepare($queryVerificarEmail);
        $stmtVerificarEmail->bind_param("s", $email);
        $stmtVerificarEmail->execute();
        $stmtVerificarEmail->store_result();
    
        if ($stmtVerificarEmail->num_rows > 0) {
            // El correo electrónico ya existe
            $this->error = "El correo electrónico ya existe.";
            return false;
        }
    
        // Si el correo electrónico no existe, procede con la inserción
        $queryContacto = "INSERT INTO contacto (Email, Telefono, Ciudad) VALUES (?, ?, ?)";
        $stmtContacto = $this->conexion->conn->prepare($queryContacto);
        $stmtContacto->bind_param("sss", $email, $telefono, $ciudad);
    
        if ($stmtContacto->execute()) {
            $contactoID = $stmtContacto->insert_id;
    
            $queryUsuario = "INSERT INTO usuarios (TipoUsuario, Email, HashContrasenia) VALUES (?, ?, ?)";
            $stmtUsuario = $this->conexion->conn->prepare($queryUsuario);
            $tipoUsuario = "postulante";
            $stmtUsuario->bind_param("sss", $tipoUsuario, $email, $hashPassword);
    
            if ($stmtUsuario->execute()) {
                $usuarioID = $stmtUsuario->insert_id;
    
                $queryPostulante = "INSERT INTO postulantes (IDUsuario, Nombre, Apellido, IDContacto, DNI) VALUES (?, ?, ?, ?, ?)";
                $stmtPostulante = $this->conexion->conn->prepare($queryPostulante);
                $stmtPostulante->bind_param("issii", $usuarioID, $nombre, $apellido, $contactoID, $DNI);
    
                if ($stmtPostulante->execute()) {
                    return true; // Registro de postulante exitoso
                } else {
                    return false; // Error en el registro de postulante
                }
            } else {
                return false; // Error en el registro de usuario
            }
        } else {
            return false; // Error en el registro de contacto
        }
    }
    


    public function registrarEmpresa($RazonSocial, $SitioWeb, $CUIT, $email, $hashPassword, $telefono, $ciudad) {
        // Verifica si el correo electrónico ya existe
        $queryVerificarEmail = "SELECT ID FROM usuarios WHERE Email = ?";
        $stmtVerificarEmail = $this->conexion->conn->prepare($queryVerificarEmail);
        $stmtVerificarEmail->bind_param("s", $email);
        $stmtVerificarEmail->execute();
        $stmtVerificarEmail->store_result();
    
        if ($stmtVerificarEmail->num_rows > 0) {
            // El correo electrónico ya existe
            $this->error = "El correo electrónico ya existe.";
            return false;
        }
    
        // Si el correo electrónico no existe, procede con la inserción
        $queryContacto = "INSERT INTO contacto (Email, Telefono, Ciudad) VALUES (?, ?, ?)";
        $stmtContacto = $this->conexion->conn->prepare($queryContacto);
        $stmtContacto->bind_param("sss", $email, $telefono, $ciudad);
    
        if ($stmtContacto->execute()) {
            $contactoID = $stmtContacto->insert_id;
    
            $queryUsuario = "INSERT INTO usuarios (TipoUsuario, Email, HashContrasenia) VALUES (?, ?, ?)";
            $stmtUsuario = $this->conexion->conn->prepare($queryUsuario);
            $tipoUsuario = "empresa";
            $stmtUsuario->bind_param("sss", $tipoUsuario, $email, $hashPassword);
    
            if ($stmtUsuario->execute()) {
                $usuarioID = $stmtUsuario->insert_id;
    
                $queryEmpresa = "INSERT INTO empresas (IDUsuario, RazonSocial, SitioWeb, IDContacto, CUIT) VALUES (?, ?, ?, ?, ?)";
                $stmtEmpresa = $this->conexion->conn->prepare($queryEmpresa);
                $stmtEmpresa->bind_param("issii", $usuarioID, $RazonSocial, $SitioWeb, $contactoID, $CUIT);
    
                if ($stmtEmpresa->execute()) {
                    return true; // Registro de Empresa exitoso
                } else {
                    return false; // Error en el registro de Empresa
                }
            } else {
                return false; // Error en el registro de usuario
            }
        } else {
            return false; // Error en el registro de contacto
        }
    }
    

    
// Desde aca comienza Editar Perfil empresa : 

public function obtenerDatosUsuario($email) {
    $query = "SELECT * FROM usuarios WHERE Email = ?";
    $stmt = $this->conexion->conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    return $usuario;
}

// Obtener datos de empresa por ID de usuario
public function obtenerDatosEmpresa($idUsuario) {
    $query = "SELECT * FROM empresas WHERE IDUsuario = ?";
    $stmt = $this->conexion->conn->prepare($query);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();

    $result = $stmt->get_result();
    $empresa = $result->fetch_assoc();

    return $empresa;
}

// Obtener datos de contacto por ID
public function obtenerDatosContacto($idContacto) {
    $query = "SELECT * FROM contacto WHERE ID = ?";
    $stmt = $this->conexion->conn->prepare($query);
    $stmt->bind_param("i", $idContacto);
    $stmt->execute();

    $result = $stmt->get_result();
    $contacto = $result->fetch_assoc();

    return $contacto;
}


public function actualizarDatosEmpresaContacto($email, $razonSocial, $sitioWeb, $cuit, $emailContacto, $telefono, $ciudad, $nuevaPassword) {
    try {
        // Paso 1: Obtener el IDUsuario asociado al Email del usuario
        $queryGetIDUsuario = "SELECT ID FROM usuarios WHERE Email = ?";
        $stmtGetIDUsuario = $this->conexion->conn->prepare($queryGetIDUsuario);
        $stmtGetIDUsuario->bind_param("s", $email);
        $stmtGetIDUsuario->execute();
        $result = $stmtGetIDUsuario->get_result();

        if (!$result || $result->num_rows !== 1) {
            throw new Exception("El usuario no existe o hay un problema con los datos.");
        }

        $row = $result->fetch_assoc();
        $idUsuario = $row['ID']; // esto lo hago para entrar a la tabla empresa...

        // Paso 2: Obtener el IDEmpresa asociado al IDUsuario
        $queryGetIDEmpresa = "SELECT IDContacto FROM empresas WHERE IDUsuario = ?";
        $stmtGetIDEmpresa = $this->conexion->conn->prepare($queryGetIDEmpresa);
        $stmtGetIDEmpresa->bind_param("i", $idUsuario);
        $stmtGetIDEmpresa->execute();
        $resultEmpresa = $stmtGetIDEmpresa->get_result();

        if (!$resultEmpresa || $resultEmpresa->num_rows !== 1) {
            throw new Exception("La empresa no existe o hay un problema con los datos.");
        }

        $rowEmpresa = $resultEmpresa->fetch_assoc();
        $idContacto = $rowEmpresa['IDContacto'];

        // Paso 3: Actualizar los datos en la tabla "empresas"
        $queryUpdateEmpresa = "UPDATE empresas SET RazonSocial = ?, SitioWeb = ?, CUIT = ? WHERE IDUsuario = ?";
        $stmtUpdateEmpresa = $this->conexion->conn->prepare($queryUpdateEmpresa);
        $stmtUpdateEmpresa->bind_param("ssii", $razonSocial, $sitioWeb, $cuit, $idUsuario);

        if (!$stmtUpdateEmpresa->execute()) {
            throw new Exception("Error al actualizar los datos de la empresa: " . $stmtUpdateEmpresa->error);
        }

        // Paso 4: Actualizar los datos en la tabla "contacto"
        $queryUpdateContacto = "UPDATE contacto SET Email = ?, Telefono = ?, Ciudad = ? WHERE ID = ?";
        $stmtUpdateContacto = $this->conexion->conn->prepare($queryUpdateContacto);
        $stmtUpdateContacto->bind_param("sssi", $emailContacto, $telefono, $ciudad, $idContacto);

        if (!$stmtUpdateContacto->execute()) {
            throw new Exception("Error al actualizar los datos de contacto: " . $stmtUpdateContacto->error);

        }

        // Paso 5: Actualizar la contraseña del usuario si se proporciona una nueva
        if (!empty($nuevaPassword)) {
            // Hashear la nueva contraseña
            $hashPassword = password_hash($nuevaPassword, PASSWORD_DEFAULT);

            // Actualizar la contraseña en la tabla usuarios
            $queryUpdateUsuario = "UPDATE usuarios SET Email = ? , HashContrasenia = ? WHERE ID = ?";
            $stmtUpdateUsuario = $this->conexion->conn->prepare($queryUpdateUsuario);
            $stmtUpdateUsuario->bind_param("ssi",$emailContacto,$hashPassword, $idUsuario);

            if (!$stmtUpdateUsuario->execute()) {
                throw new Exception("Error al actualizar la contraseña del usuario: " . $stmtUpdateUsuario->error);
            }
        }

        return true;
    } catch (Exception $e) {
        error_log("Error en la actualización de datos: " . $e->getMessage());
        return false;
    }
}




// ACA EMPIEZO CON EL PERFIL POSTULANTE

// Obtener datos de Postulante por ID 
public function obtenerDatosPostulante($idUsuario) {
    $query = "SELECT * FROM postulantes WHERE IDUsuario = ?";
    $stmt = $this->conexion->conn->prepare($query);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();

    $result = $stmt->get_result();
    $postulante = $result->fetch_assoc();

    return $postulante;
}



public function actualizarDatosPostulanteContacto($email, $nombre, $apellido, $telefono, $dni, $ciudad, $emailContacto, $cv, $nuevaPassword) {
    try {
        // Paso 1: Obtener el IDUsuario asociado al Email del usuario
        $queryGetIDUsuario = "SELECT ID FROM usuarios WHERE Email = ?";
        $stmtGetIDUsuario = $this->conexion->conn->prepare($queryGetIDUsuario);
        $stmtGetIDUsuario->bind_param("s", $email);
        $stmtGetIDUsuario->execute();
        $result = $stmtGetIDUsuario->get_result();

        if (!$result || $result->num_rows !== 1) {
            throw new Exception("El usuario no existe o hay un problema con los datos.");
        }

        $row = $result->fetch_assoc();
        $idUsuario = $row['ID']; // esto lo hago para entrar a la tabla Postulante...

        // Paso 2: Obtener el IDcontacto asociado al IDUsuario
        $queryGetIDPostulante = "SELECT IDContacto FROM postulantes WHERE IDUsuario = ?";
        $stmtGetIDPostulante = $this->conexion->conn->prepare($queryGetIDPostulante);
        $stmtGetIDPostulante->bind_param("i", $idUsuario);
        $stmtGetIDPostulante->execute();
        $resultPostulante = $stmtGetIDPostulante->get_result();

        if (!$resultPostulante || $resultPostulante->num_rows !== 1) {
            throw new Exception("El postulante no existe o hay un problema con los datos.");
        }

        $rowPostulante = $resultPostulante->fetch_assoc();
        $idContacto = $rowPostulante['IDContacto'];

        // Paso 3: Actualizar los datos en la tabla "Postulante"
        $queryUpdatePostulante = "UPDATE postulantes SET Nombre = ?, Apellido = ?, DNI = ?, CV = ? WHERE IDUsuario = ?";
        $stmtUpdatePostulante = $this->conexion->conn->prepare($queryUpdatePostulante);

       
        $stmtUpdatePostulante->bind_param("ssisi", $nombre, $apellido, $dni, $cv , $idUsuario);

        if (!$stmtUpdatePostulante->execute()) {
            throw new Exception("Error al actualizar los datos del Postulante: " . $stmtUpdatePostulante->error);
        }

        // Paso 4: Actualizar los datos en la tabla "contacto"
        $queryUpdateContacto = "UPDATE contacto SET Email = ?, Telefono = ?, Ciudad = ? WHERE ID = ?";
        $stmtUpdateContacto = $this->conexion->conn->prepare($queryUpdateContacto);
        $stmtUpdateContacto->bind_param("sssi", $emailContacto, $telefono, $ciudad, $idContacto);

        if (!$stmtUpdateContacto->execute()) {
            throw new Exception("Error al actualizar los datos de contacto: " . $stmtUpdateContacto->error);

        }

        // Paso 5: Actualizar la contraseña del usuario si se proporciona una nueva
        if (!empty($nuevaPassword)) {
            // Hashear la nueva contraseña
            $hashPassword = password_hash($nuevaPassword, PASSWORD_DEFAULT);

            // Actualizar la contraseña en la tabla usuarios
            $queryUpdateUsuario = "UPDATE usuarios SET Email = ? , HashContrasenia = ? WHERE ID = ?";
            $stmtUpdateUsuario = $this->conexion->conn->prepare($queryUpdateUsuario);
            $stmtUpdateUsuario->bind_param("ssi",$emailContacto,$hashPassword, $idUsuario);

            if (!$stmtUpdateUsuario->execute()) {
                throw new Exception("Error al actualizar la contraseña del usuario: " . $stmtUpdateUsuario->error);
            }
        }

        return true;
    } catch (Exception $e) {
        error_log("Error en la actualización de datos: " . $e->getMessage());
        return false;
    }
}

// Si el usuario está autenticado como empresa, puede crear una oferta de trabajo
 function CargarTrabajoEmpresa($email, $titulo, $descripcion, $ubicacion, $modalidad, $tipo_empleo, $salario, $fecha_public)
    {
        // Paso 1: Obtener el IDUsuario asociado al Email del usuario
        $queryGetIDUsuario = "SELECT ID FROM usuarios WHERE Email = ?";
        $stmtGetIDUsuario = $this->conexion->conn->prepare($queryGetIDUsuario);
        $stmtGetIDUsuario->bind_param("s", $email);
        $stmtGetIDUsuario->execute();
        $result = $stmtGetIDUsuario->get_result();

        if (!$result || $result->num_rows !== 1) {
            throw new Exception("El usuario no existe o hay un problema con los datos.");
        }

        $row = $result->fetch_assoc();
        $idUsuario = $row['ID']; // esto lo hago para entrar a la tabla empresa...

        // Insertar los datos en la base de datos
        $queryCargarTrabajo = "INSERT INTO empleos (IDEmpresa, Titulo, Descripcion, Ubicacion, Modalidad, TipoEmpleo, Salario, FechaPublicacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        // Preparar la consulta
        $stmtCargarTrabajo = $this->conexion->conn->prepare($queryCargarTrabajo);
        $stmtCargarTrabajo->bind_param("ssssssds", $idUsuario, $titulo, $descripcion, $ubicacion, $modalidad, $tipo_empleo, $salario, $fecha_public);

        // Ejecutar la consulta
        if ($stmtCargarTrabajo->execute()) {
            return "Oferta de trabajo creada con éxito.";
        } else {
            return "Error al crear la oferta: " . $stmtCargarTrabajo->error; // Cambiado de $stmt->error a $stmtCargarTrabajo->error
        }
    }

    
    public function obtenerDatosDeOfertas() {
        $query = "SELECT * FROM empleos";
        $stmt = $this->conexion->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
        $ofertas = array();

        while ($row = $result->fetch_assoc()) {
            $ofertas[] = $row;
        }

        return $ofertas;
    }

    public function obtenerNombreEmpresaPorID($idEmpresa) {
        $query = "SELECT RazonSocial FROM empresas WHERE IDUsuario = ?";
        $stmt = $this->conexion->conn->prepare($query);
        $stmt->bind_param("i", $idEmpresa);
        $stmt->execute();
        $result = $stmt->get_result();
        $nombreEmpresa = $result->fetch_assoc()['RazonSocial'];
        return $nombreEmpresa;
    }


    public function obtenerIDUsuario($email) {
        $query = "SELECT ID FROM usuarios WHERE Email = ?";
        $stmt = $this->conexion->conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        if ($row) {
            return $row['ID'];
        } else {
            return null; // Devuelve null si el usuario no se encuentra en la base de datos
        }
    }

   //ACA EMPIEZO HACER EL BOTON DE ENVIAR LOS DATOS DE LA POSTULACION
    public function insertarPostulacion($IDEmpleo, $IDPostulante) {
        $query = "INSERT INTO postulaciones (IDEmpleo, IDPostulante) VALUES (?, ?)";
        $stmt = $this->conexion->conn->prepare($query);
        $stmt->bind_param("ii", $IDEmpleo, $IDPostulante);
    
        if ($stmt->execute()) {
            return true; // La inserción fue exitosa
        } else {
            return false; // Hubo un error en la inserción
        }
    }

// Método en el modelo para verificar si el usuario ya está postulado para un trabajo
public function usuarioYaPostulado($IDPostulante, $IDEmpleo) {
    $query = "SELECT * FROM postulaciones WHERE IDPostulante = ? AND IDEmpleo = ?";
    $stmt = $this->conexion->conn->prepare($query);
    $stmt->bind_param("ii", $IDPostulante, $IDEmpleo);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->num_rows > 0; // Si hay al menos una fila, el usuario ya está postulado
}



public function obtenerMisPropuestas($IDEmpresa) {
    $query = "SELECT * FROM empleos WHERE IDEmpresa = ?";
    $stmt = $this->conexion->conn->prepare($query);
    $stmt->bind_param("i", $IDEmpresa);
    $stmt->execute();

    $result = $stmt->get_result();
    $ofertas = array();

    while ($row = $result->fetch_assoc()) {
        $ofertas[] = $row;
    }

    return $ofertas;
}

//  PERFIL DE ADMINSITRADOR
    
public function registrarAdministrador($email, $hashPassword, $verificado) {
    // Verifica si el correo electrónico ya existe
    $queryVerificarEmail = "SELECT ID FROM usuarios WHERE Email = ?";
    $stmtVerificarEmail = $this->conexion->conn->prepare($queryVerificarEmail);
    $stmtVerificarEmail->bind_param("s", $email);
    $stmtVerificarEmail->execute();
    $stmtVerificarEmail->store_result();

    if ($stmtVerificarEmail->num_rows > 0) {
        // El correo electrónico ya existe
        $this->error = "El correo electrónico ya existe.";
        return false;
    }

    // Si el correo electrónico no existe, procede con la inserción
     $queryUsuario = "INSERT INTO usuarios (TipoUsuario, Email, HashContrasenia, Verificado) VALUES (?, ?, ?, ?)";
     $stmtUsuario = $this->conexion->conn->prepare($queryUsuario);
     $tipoUsuario = "administrador";
     $stmtUsuario->bind_param("sssi", $tipoUsuario, $email, $hashPassword, $verificado);
     if ($stmtUsuario->execute()) {
        return true; // Registro de administrador exitoso
        } else {
            return false; // Error en el registro de administrador
        }
    }
    
public function obtenerListaEmpresas() {
    $query = "SELECT * FROM empresas";
    $stmt = $this->conexion->conn->prepare($query);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $empresas = array();
    
    while ($empresa = $result->fetch_assoc()) {
         $empresas[] = $empresa;
    }
      return $empresas;
    }
public function obtenerEmpresasPendientes() {
    try {
        $query = "SELECT e.* FROM empresas e
        JOIN usuarios u ON e.IDUsuario = u.ID
        WHERE u.verificado = 0";

        
            $stmt = $this->conexion->conn->prepare($query);
            $stmt->execute();
        
            $result = $stmt->get_result();
            $empresasPendientes = array();
        
            while ($empresa = $result->fetch_assoc()) {
                $empresasPendientes[] = $empresa;
            }
        
            return $empresasPendientes;
        } catch (Exception $e) {
            // Manejo de errores, puedes imprimir o registrar el mensaje de error aquí.
            echo "Error: " . $e->getMessage();
            return array(); // Retorna un array vacío en caso de error.
        }
    }
    
       
public function actualizarVerificado($IDUsuario) {
        // Validación del ID del usuario
        if (!is_numeric($IDUsuario)) {
            return false;
        }
    
        // Consulta SQL
        $query = "UPDATE usuarios SET verificado = 1 WHERE id = {$IDUsuario}";
        $stmt = $this->conexion->conn->prepare($query);
    
        // Ejecución de la consulta SQL
        if ($stmt->execute()) {
            return true; // Éxito en la actualización del estado verificado
        } else {
            // Devolución de un mensaje de error
            return false;
        }
    }
    
public function registrarAutoridad($nombre, $email, $hashPassword,$telefono, $apellido,$verificado) {
    // Verifica si el correo electrónico ya existe
    $queryVerificarEmail = "SELECT ID FROM usuarios WHERE Email = ?";
    $stmtVerificarEmail = $this->conexion->conn->prepare($queryVerificarEmail);
    $stmtVerificarEmail->bind_param("s", $email);
    $stmtVerificarEmail->execute();
    $stmtVerificarEmail->store_result();

    if ($stmtVerificarEmail->num_rows > 0) {
        // El correo electrónico ya existe
        $this->error = "El correo electrónico ya existe.";
        return false;
    }

    // Si el correo electrónico no existe, procede con la inserción
    $queryContacto = "INSERT INTO contacto (Email, Telefono ) VALUES (?, ?)";
    $stmtContacto = $this->conexion->conn->prepare($queryContacto);
    $stmtContacto->bind_param("si", $email, $telefono );

    if ($stmtContacto->execute()) {
        $contactoID = $stmtContacto->insert_id;

        $queryUsuario = "INSERT INTO usuarios (TipoUsuario, Email, HashContrasenia, Verificado) VALUES (?, ?, ?,?)";
        $stmtUsuario = $this->conexion->conn->prepare($queryUsuario);
        $tipoUsuario = "autoridad";
        $stmtUsuario->bind_param("sssi", $tipoUsuario, $email, $hashPassword, $verificado);

        if ($stmtUsuario->execute()) {
            $usuarioID = $stmtUsuario->insert_id;

            $queryAutoridad = "INSERT INTO autoridades (IDUsuario, Nombre, Apellido, IDContacto) VALUES (?, ?, ?, ?)";
            $queryAutoridad = $this->conexion->conn->prepare($queryAutoridad);
            $queryAutoridad->bind_param("issi", $usuarioID, $nombre,$apellido, $contactoID);

            if ($queryAutoridad->execute()) {
                return true; // Registro de Aut exitoso
            } else {
                return false; // Error en el registro de Aut
            }
        } else {
            return false; // Error en el registro de usuario
        }
    } else {
        return false; // Error en el registro de contacto
    }
}
// Método para eliminar un usuario por su ID

public function Eliminaruser($IDUsuario) {
    try {

        $id = $IDUsuario;

        // Paso 2: Obtener el IDEmpresa asociado al IDUsuario
        $queryGetIDEmpresa = "SELECT IDContacto FROM empresas WHERE IDUsuario = ?";
        $stmtGetIDEmpresa = $this->conexion->conn->prepare($queryGetIDEmpresa);
        $stmtGetIDEmpresa->bind_param("i", $IDUsuario);
        $stmtGetIDEmpresa->execute();
        $resultEmpresa = $stmtGetIDEmpresa->get_result();

        if (!$resultEmpresa || $resultEmpresa->num_rows !== 1) {
            throw new Exception("La empresa no existe o hay un problema con los datos.");
        }

        $rowEmpresa = $resultEmpresa->fetch_assoc();
        $idContacto = $rowEmpresa['IDContacto'];

        // Paso 3: Actualizar los datos en la tabla "empresas"
        $queryUpdateEmpresa = "DELETE FROM empresas WHERE IDUsuario = {$IDUsuario}";
        $stmtUpdateEmpresa = $this->conexion->conn->prepare($queryUpdateEmpresa);

        if (!$stmtUpdateEmpresa->execute()) {
            throw new Exception("Error al actualizar los datos de la empresa: " . $stmtUpdateEmpresa->error);
        }

        // Paso 4: Actualizar los datos en la tabla "contacto"
        $queryUpdateContacto = "DELETE FROM contacto WHERE ID = {$idContacto}";
        $stmtUpdateContacto = $this->conexion->conn->prepare($queryUpdateContacto);

        if (!$stmtUpdateContacto->execute()) {
            throw new Exception("Error al actualizar los datos de contacto: " . $stmtUpdateContacto->error);
        }

        // Validación del ID del usuario
        if (!is_numeric($IDUsuario)) {
            throw new Exception("El ID del usuario debe ser un número.");
        }

        // Actualizar la contraseña en la tabla usuarios
        $queryUpdateUsuario = "DELETE FROM usuarios WHERE ID = {$id}";
        $stmtUpdateUsuario = $this->conexion->conn->prepare($queryUpdateUsuario);

        if (!$stmtUpdateUsuario->execute()) {
            throw new Exception("Error al actualizar la contraseña del usuario: " . $stmtUpdateUsuario->error);
        }

        return true;
    } catch (Exception $e) {
        error_log("Error en la actualización de datos: " . $e->getMessage());
        return false;
    }
}

public function obtenerEmpresasVerificadas() {
    try {
        $query = "SELECT e.* FROM empresas e
        JOIN usuarios u ON e.IDUsuario = u.ID
        WHERE u.verificado = 1";

        
            $stmt = $this->conexion->conn->prepare($query);
            $stmt->execute();
        
            $result = $stmt->get_result();
            $empresasVerificadas = array();
        
            while ($empresa = $result->fetch_assoc()) {
                $empresasVerificadas[] = $empresa;
            }
        
            return $empresasVerificadas;
        } catch (Exception $e) {
            // Manejo de errores, puedes imprimir o registrar el mensaje de error aquí.
            echo "Error: " . $e->getMessage();
            return array(); // Retorna un array vacío en caso de error.
        }
    }

public function BajaVerificado($IDUsuario) {
        // Validación del ID del usuario
        if (!is_numeric($IDUsuario)) {
            return false;
        }
        // Consulta SQL
        $query = "UPDATE usuarios SET verificado = 2 WHERE id = {$IDUsuario}";
        $stmt = $this->conexion->conn->prepare($query);
    
        // Ejecución de la consulta SQL
        if ($stmt->execute()) {
            return true; // Éxito en la actualización del estado verificado
        } else {
            // Devolución de un mensaje de error
            return false;
        }
    }
public function obtenerPostulantesPendientes() {
        try {
            $query = "SELECT p.* FROM postulantes p
            JOIN usuarios u ON p.IDUsuario = u.ID
            WHERE u.verificado = 0";


                $stmt = $this->conexion->conn->prepare($query);
                $stmt->execute();

                $result = $stmt->get_result();
                $postulantesPendientes = array();

                while ($postulante = $result->fetch_assoc()) {
                    $postulantesPendientes[] = $postulante;
                }

                return $postulantesPendientes;
            } catch (Exception $p) {
                // Manejo de errores, puedes imprimir o registrar el mensaje de error aquí.
                echo "Error: " . $p->getMessage();
                return array(); // Retorna un array vacío en caso de error.
            }
        }
public function EliminarPostulante($IDUsuario) {
    try {
        
        $id = $IDUsuario;
      
                // Paso 2: Obtener el IDEmpresa asociado al IDUsuario
                $queryGetIDPostulante = "SELECT IDContacto FROM postulantes WHERE IDUsuario = ?";
                $stmtGetIDPostulante = $this->conexion->conn->prepare($queryGetIDPostulante);
                $stmtGetIDPostulante->bind_param("i", $IDUsuario);
                $stmtGetIDPostulante->execute();
                $resultPostulante = $stmtGetIDPostulante->get_result();
        
                if (!$resultPostulante || $resultPostulante->num_rows !== 1) {
                    throw new Exception("El postulante no existe o hay un problema con los datos.");
                }
        
                $rowPostulante = $resultPostulante->fetch_assoc();
                $idContacto = $rowPostulante['IDContacto'];
        
                // Paso 3: Actualizar los datos en la tabla "empresas"
                $queryUpdatePostulante = "DELETE FROM postulantes WHERE IDUsuario = {$IDUsuario}";
                $stmtUpdatePostulante = $this->conexion->conn->prepare($queryUpdatePostulante);
        
                if (!$stmtUpdatePostulante->execute()) {
                    throw new Exception("Error al actualizar los datos del postulante: " . $stmtUpdatePostulante->error);
                }
        
                // Paso 4: Actualizar los datos en la tabla "contacto"
                $queryUpdateContacto = "DELETE FROM contacto WHERE ID = {$idContacto}";
                $stmtUpdateContacto = $this->conexion->conn->prepare($queryUpdateContacto);
        
                if (!$stmtUpdateContacto->execute()) {
                    throw new Exception("Error al actualizar los datos de contacto: " . $stmtUpdateContacto->error);
                }
        
                // Validación del ID del usuario
                if (!is_numeric($IDUsuario)) {
                    throw new Exception("El ID del usuario debe ser un número.");
                }
        
                // Actualizar la contraseña en la tabla usuarios
                $queryUpdateUsuario = "DELETE FROM usuarios WHERE ID = {$id}";
                $stmtUpdateUsuario = $this->conexion->conn->prepare($queryUpdateUsuario);
        
                if (!$stmtUpdateUsuario->execute()) {
                    throw new Exception("Error al actualizar la contraseña del usuario: " . $stmtUpdateUsuario->error);
                }
        
                return true;
            } catch (Exception $e) {
                error_log("Error en la actualización de datos: " . $e->getMessage());
                return false;
            }
        }
    
public function obternerAutoridadVerificada() {
    try {
         $query = "SELECT a.* FROM autoridades a
         JOIN usuarios u ON a.IDUsuario = u.ID
         WHERE u.verificado = 0";
             $stmt = $this->conexion->conn->prepare($query);
         $stmt->execute();
           $result = $stmt->get_result();
         $AutVerificada = array();
                   while ($postulante = $result->fetch_assoc()) {
                     $AutVerificada[] = $postulante;
                 }
                   return $AutVerificada;
             } catch (Exception $p) {
                 // Manejo de errores, puedes imprimir o registrar el mensaje de error aquí.
                 echo "Error: " . $p->getMessage();
                 return array(); // Retorna un array vacío en caso de error.
             }
         }

public function obtenerPostulantesAlta() {
   try {
       $query = "SELECT p.* FROM postulantes p
       JOIN usuarios u ON p.IDUsuario = u.ID
       WHERE u.verificado = 1";
       
           $stmt = $this->conexion->conn->prepare($query);
           $stmt->execute();
       
           $result = $stmt->get_result();
           $postulantesPendientes = array();
       
           while ($postulante = $result->fetch_assoc()) {
               $postulantesPendientes[] = $postulante;
           }
       
           return $postulantesPendientes;
       } catch (Exception $p) {
           // Manejo de errores, puedes imprimir o registrar el mensaje de error aquí.
           echo "Error: " . $p->getMessage();
           return array(); // Retorna un array vacío en caso de error.
       }
   }
public function actualizarVerificadoados($IDUsuario) {
    // Validación del ID del usuario
    if (!is_numeric($IDUsuario)) {
        return false;
    }

    // Consulta SQL
    $query = "UPDATE usuarios SET verificado = 2 WHERE id = {$IDUsuario}";
    $stmt = $this->conexion->conn->prepare($query);

    // Ejecución de la consulta SQL
    if ($stmt->execute()) {
        return true; // Éxito en la actualización del estado verificado
    } else {
        // Devolución de un mensaje de error
        return false;
    }
   }


public $error;  





}
?>