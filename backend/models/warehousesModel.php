<?php
class Warehouses extends Validator
{
    //Declarando propiedades
    private $id = null;
    private $warehouse = null;

    //Métodos para sobrecargar propiedades
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

    public function setHouse($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->warehouse = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getHouse()
    {
        return $this->warehouse;
    }

    //Metodos para manejar el CRUD u operaciones básicas, agregar, leer, eliminar y modificar

    public function createWarehouse()
    {
        $sql = 'INSERT INTO warehouses(warehouse) VALUES (?)';
        $params = array($this->id);
        return Database::executeRow($sql, $params);   
    }

    public function updateWarehouse()
    {
        $sql = 'UPDATE warehouses SET warehouse = ? WHERE id = ?';
        $params = array($this->warehouse);
        return Database::executeRow($sql, $params);   
    }

    public function deleteWarehouse()
    {
        $sql = 'DELETE FROM warehouses WHERE id = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);   
    }

    public function readWarehouse()
    {
        $sql = 'SELECT id, warehouse FROM warehouses ORDER BY id';
        $params = array(null);
        return Database::getRows($sql, $params);
    }

    public function getWarehouse()
    {
        $sql = 'SELECT id, warehouse FROM warehouses WHERE id = ?';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }
}