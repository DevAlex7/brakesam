<?php
class Sales extends Validator
{
    //propiedades
    private $id = null;
    private $idProduct = null;
    private $count = null;
    private $idStock = null;
    private $idUser = null;
    private $saleDate = null;

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

    public function setIdProduct($value)
    {
        if ($this->validateId($value)) {
            $this->idProduct = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getIdProduct()
    {
        return $this->idProduct;
    }

    public function setIdUser($value)
    {
        if ($this->validateId($value)) {
            $this->idUser = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdStock($value)
    {
        if ($this->validateId($value)) {
            $this->idStock = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getIdStock()
    {
        return $this->idStock;
    }

    public function setCount($value)
    {
            $this->count = $value;
            return true;

    }

    public function getCount()
    {
        return $this->count;
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

    public function createSale()
    {
        $sql = 'INSERT INTO sales(product_id, count, stock_action_id, user_id, date_sale) VALUES (?, ?, ?, ?, ?)';
        $params = array($this->id);
        return Database::executeRow($sql, $params);   
    }

    public function updateSale()
    {
        $sql = 'UPDATE sales SET product_id = ?, count = ?, stock_action_id = ?, user_id = ?, date_sale = ? WHERE id = ?';
        $params = array($this->idProduct, $this->count, $this->idStock, $this->idUser, $this->date);
        return Database::executeRow($sql, $params);   
    }

    public function deleteSale()
    {
        $sql = 'DELETE FROM sales WHERE id = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);   
    }

    public function readSale()
    {
        $sql = 'SELECT id, product_id, count, stock_action_id, user_id, date_sale FROM sales ORDER BY id';
        $params = array(null);
        return Database::getRows($sql, $params);
    }

    public function getSale()
    {
        $sql = 'SELECT id, product_id, count, stock_action_id, user_id, date_sale FROM sales WHERE id = ?';
        $params = array($this->id);
        return Database::getRows($sql, $params);
    }
}