<?php

/* Esta clase se encarga de manejar todas las acciones referente a un usuario */
class Usuario extends BD
{

    /**
     * Mensaje de error
     * @var [type]
     */
    public $error;

    /**
     * Datos del usuario
     * @var [type]
     */
    public $d;

    public function __construct()
    {
        parent::__construct();

        $this->d = $this->getSession();
    }

    public function registrar($nombre, $email, $password)
    {
        /* Verificar si el correo electrónico ya existe en la base de datos */
        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = $this->db->query($query);
        if ($result->num_rows > 0)
        {
            $this->error = 'El correo electrónico ya existe';
            return false;
        }

        /* Insertar el nuevo usuario en la base de datos */
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO usuarios (nombre, email, password) VALUES (\''. $this->db->real_escape_string($nombre) .'\', \''. $this->db->real_escape_string($email) .'\', \''. $this->db->real_escape_string($hashed_password) .'\')';
        $result = $this->db->query($query); //
        if ($result)
        {
            $usuario_id = $this->db->insert_id;
            $this->loguear($usuario_id);  
            return true;
        }
        else
        {
            $this->error = 'Error en el registro';
            return false;
        }
    }

    /**
     * Identifica a un usuario
     * 
     * @param int $usuario_id
     * @param string $uuid
     */
    function loguear($usuario_id = 0, $uuid = null)
    {
        /* Generamos un identificador único de 28 carácteres */
        $uuid = empty($uuid) ? generateUUID(28) : $uuid;
        
        /* Asociamos el identificador generado a la sesión del usuario */
        $query = $this->db->query('UPDATE `usuarios` SET `session` = \'' . $uuid . '\' WHERE `id` = \'' .$usuario_id . '\' LIMIT 1');
        
        if($query == true)
        {
            /* Establecemos la cookie */
            setcookie('session', $uuid, time() + 60 * 60 * 24, '/');
            //
            return true;
        }
        //
        return false;
    }

    /**
     * Optiene la session del usuario si existe
     * @return [type] [description]
     */
    public function getSession()
    {
        if(isset($_COOKIE['session']) AND !empty($_COOKIE['session']))
        {
            $query = $this->db->query('SELECT * FROM `usuarios` WHERE `session` = \'' . $this->db->real_escape_string($_COOKIE['session']) . '\' LIMIT 1');

            if($query AND $query->num_rows > 0)
            {
                return (object)$query->fetch_assoc();
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Optiene los datos de un usuario de la Base de datos
     */
    public function getUsuario($email)
    {
        /* Verificar si el correo electrónico ya existe en la base de datos */
        $query = "SELECT * FROM usuarios WHERE email = '". $this->db->real_escape_string($email) ."'";
        $result = $this->db->query($query);
        if ($result->num_rows > 0)
        {
            return $result->fetch_assoc();
        }
        else
        {
            return false;
        }
    }

    /**
     * Cierra la session
     */
    public function logout()
    {
        /* Verificar si el correo electrónico ya existe en la base de datos */
        $query = "UPDATE usuarios SET `session` = '' WHERE `id` = '". $this->db->real_escape_string($this->d->id) ."'";
        $result = $this->db->query($query);
        if ($this->db->affected_rows > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>