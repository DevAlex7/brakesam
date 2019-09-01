<?php
class Users extends Validator
{
    //Declaración de propiedades
    private $id = null;
    private $name = null;
    private $lastname = null;
    private $email = null;
    private $password = null;
    private $role = null;
    private $date = null;

    //Métodos para sobrecarga de propiedades
    public function setId($value)
    {
        if ($this->validateId($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->name = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function setLastName($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->lastname = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function setEmail($value)
    {
        if ($this->validateEmail($value)) {
            $this->email = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($value)
    {
        if ($this->validatePassword($value)) {
            $this->password = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setDate($value)
	{
		if ($this->validateAlphabetic($value, 1, 100)) {
			$this->date = $value;
			return true;
		} else {
			return false;
		}
	}

	public function getDate()
	{
		return $this->date;
	}

    //Metodos para manejar el CRUD u operaciones básicas, agregar, leer, eliminar y modificar

    public function insertBitacora($accion)
    {
        $sql = 'call insertBitacora ( ? , ?)';
        $params = array($_SESSION['idEmpleado'], $accion);
        return Database::executeRow($sql, $params);
    }

    public function createCliente()
    {
        $hash = password_hash($this->contrasena, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO cliente(nombreCliente, apellidoCliente, correo, contrasena, direccion, img)
						VALUES(?, ?, ?, ?, ?, ?)';
        $params = array(
            $this->nombres, $this->apellidos, $this->correo, $hash, $this->direccion,
            $this->img
        );
        return Database::executeRow($sql, $params);
    }

    public function readClientes()
    {
        $sql = 'SELECT idCliente, estado, nombreCliente, apellidoCliente, correo, direccion, img 
						FROM cliente ORDER BY idCliente';
        $params = array(null);
        return Database::getRows($sql, $params);
    }

    public function checkEstado()
    {
        $sql = 'SELECT estado FROM cliente WHERE correo = ?';
        $params = array($this->correo);
        $data = Database::getRow($sql, $params);
        if ((int)$data['estado'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function checkCorreo()
    {
        $sql = 'SELECT idCliente FROM cliente WHERE correo = ?';
        $params = array($this->correo);
        $data = Database::getRow($sql, $params);
        if ($data) {
            $this->id = $data['idCliente'];
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword()
    {
        $sql = 'SELECT contrasena FROM cliente WHERE idCliente = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        if (password_verify($this->contrasena, $data['contrasena'])) {
            return true;
        } else {
            return false;
        }
    }


    public function deshabilitarCliente()
    {
        $sql = 'UPDATE cliente SET estado = 0 WHERE idCliente = ?';
        $params = array($this->id);
        if (Database::executeRow($sql, $params)) {
            $this->insertBitacora('Deshabilito un cliente');
            return true;
        } else {
            return false;
        }
    }

    public function habilitarCliente()
    {
        $sql = 'UPDATE cliente SET estado = 1 WHERE idCliente = ?';
        $params = array($this->id);
        if (Database::executeRow($sql, $params)) {
            $this->insertBitacora('Habilito un cliente');
            return true;
        } else {
            return false;
        }
    }


    public function getCliente()
    {
        $sql = 'SELECT idCliente, estado, nombreCliente, apellidoCliente, correo, direccion, img 
						FROM cliente WHERE idCliente = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function getNombreCliente()
    {
        $sql = 'SELECT nombreCliente, apellidoCliente, direccion 
        FROM cliente WHERE correo = ?';
        $params = array($this->correo);
        return Database::getRow($sql, $params);
    }

    public function updateCliente()
    {
        $sql = 'UPDATE cliente SET nombreCliente = ?, apellidoCliente = ?, correo = ?,
						direccion = ?, img = ? WHERE idCliente = ?';
        $params = array(
            $this->nombres, $this->apellidos, $this->correo, $this->direccion,
            $this->img, $_SESSION['idCliente']
        );
        return Database::executeRow($sql, $params);
    }

    public function updateContrasena()
    {
        $hash = password_hash($this->contrasena, PASSWORD_DEFAULT);
        $sql = 'UPDATE cliente SET contrasena = ? WHERE idCliente = ?';
        $params = array($hash, $_SESSION['idCliente']);
        return Database::executeRow($sql, $params);
    }

    public function updateContrasenaCorreo()
    {
        $hash = password_hash($this->contrasena, PASSWORD_DEFAULT);
        $sql = 'UPDATE cliente SET contrasena = ? WHERE correo = ?';
        $params = array($hash, $this->correo);
        return Database::executeRow($sql, $params);
    }

    public function getImagenCliente()
    {
        $sql = 'SELECT img FROM cliente WHERE correo = ?';
        $params = array($this->correo);
        return Database::getRow($sql, $params);
    }

    public function leerAutenticacion($correo)
	{
		if ($correo) {
			$sql = 'SELECT autenticacion FROM cliente WHERE correo = ?';
			$param = $this->correo;
		} else {
			$sql = 'SELECT autenticacion FROM cliente WHERE idCliente = ?';
			$param = $this->id;
		}
		$params = array($param);
		$auth = Database::getRow($sql, $params);
		return  json_decode($auth['autenticacion'], true);
	}

	public function updateAutenticacion() {
		$sql = 'UPDATE cliente SET autenticacion = ? WHERE correo = ?';
		$params = array($this->autenticacion,$this->correo);
		return Database::executeRow($sql, $params);
	}
}
