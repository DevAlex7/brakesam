<?php
class Binnacle extends Validator
{
    private $id = null;
    private $stockId = null;
    private $productId = null;
    private $count = null;
    private $idUser = null;
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

    public function setIdStock($value)
    {
        if ($this->validateId($value)) {
            $this->stockId = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getIdStock()
    {
        return $this->stockId;
    }

      public function setIdProduct($value)
      {
          if ($this->validateId($value)) {
              $this->productId = $value;
              return true;
          } else {
              return false;
          }
      }
  
      public function getIdProduct()
      {
          return $this->productId;
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

    public function createBin()
    {
        $sql = 'INSERT INTO binnacle(stock_action_id, product_id,  count, user_id, date_action) VALUES (?, ?, ?, ?, ?)';
        $params = array($this->id);
        return Database::executeRow($sql, $params);   
    }

    public function updateBin()
    {
        $sql = 'UPDATE binnacle SET stock_action_id = ?, product_id = ?, count = ?, user_id = ?, date_action = ? WHERE id = ?';
        $params = array($this->stockId, $this->productId, $this->count, $this->idUser, $this->date);
        return Database::executeRow($sql, $params);   
    }

    public function deleteBin()
    {
        $sql = 'DELETE FROM binnacle WHERE id = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);   
    }
}
