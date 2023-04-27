<?php 

/**
 * Esta clase se encarga de crear la conexion con la Base de datos
 */
class BD {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "programacion_login";
	public  $db;

	public function __construct()
	{
		$this->db = new MySQLi($this->host, $this->user, $this->password, $this->database);
		if ($this->db->connect_errno)
		{
			die("Error de conexión: " . mysqli_connect_error());
		}
	}


}

?>