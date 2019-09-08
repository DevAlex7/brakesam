<?php
class Suppliers extends Validator
{
    //propiedades
    private $id = null;
    private $enterpriseName = null;
    private $ubication = null;
    private $cellphone = null;
    private $nit = null;
    private $nrc = null;
    private $date = null;

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

    public function setEnterpriseName($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->enterpriseName = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getEntepriseName()
    {
        return $this->enterpriseName;
    }

    public function setUbication($value)
    {
        if ($this->validateAlphabetic($value, 1, 100)) {
            $this->ubication = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getUbication()
    {
        return $this->ubication;
    }

    public function setPhone($value)
    {
        if ($this->validateAlphanumeric($value, 1, 8)){
            $this->cellphone = $value; 
            return true;
        } else {
            return false;
        }
    }

    public function getPhone()
    {
        return $this->cellphone;
    }

    public function setNit($value)
    {
        if ($this->validateAlphanumeric($value, 1, 17)) {
            $this->nit= $value;
            return true;
        } else {
            return false;
        }
    }

    public function getNit()
    {
        return $this->nit;
    }

    public function setNrc($value)
    {
        if ($this->validateAlphanumeric($value, 1, 25)) {
            $this->nrc= $value;
            return true;
        } else {
            return false;
        }
    }

    public function getNrc()
    {
        return $this->nrc;
    }

    public function setDate($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->saleDate = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getDate()
    {
        return $this->saleDate;
    }

    //operaciones crud

    public function createSupplier()
    {
        $sql = 'INSERT INTO suppliers(enterprise_name, ubication, cellphone, NIT, NRC, date_created) VALUES (?, ?, ?, ?, ?, ?)';
        $params = array($this->enterpriseName, $this->ubication, $this->cellphone, $this->nit, $this->nrc, date('Y-m-d') );
        return Database::executeRow($sql, $params);   
    }

    public function updateSupplier()
    {
        $sql = 'UPDATE suppliers SET enterprise_name = ?, ubication = ?, cellphone = ?, NIT = ?, NRC = ?  WHERE id = ?';
        $params = array($this->enterpriseName, $this->ubication, $this->cellphone, $this->nit, $this->nrc, $this->id);
        return Database::executeRow($sql, $params);   
    }

    public function deleteSupplier()
    {
        $sql = 'DELETE FROM suppliers WHERE id = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);   
    }

    public function readSuppliers()
    {
        $sql = 'SELECT * FROM suppliers ORDER BY id';
        $params = array(null);
        return Database::getRows($sql, $params);
    }

    public function getSupplierbyId()
    {
        $sql = 'SELECT id, enterprise_name, ubication, cellphone, NIT, NRC, date_created FROM suppliers WHERE id = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }
}