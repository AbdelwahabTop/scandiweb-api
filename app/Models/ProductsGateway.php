<?php
namespace App\Models;

use App\Model;

class ProductsGateway extends Model
{
    public function getProducts(): array
    {
        $sqlQuery = "SELECT * FROM `products`";

        $statement = $this->db->query($sqlQuery);

        $data = [];

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        return $data;
    }

    public function create(): string
    {
        try{
            $sqlQuery = "INSERT INTO `products` (sku, name, price, attribute)
                        VALUES (:sku, :name, :price, :attribute)";
            $statement = $this->db->prepare($sqlQuery);


            $statement->bindValue(":sku", $this->sku, \PDO::PARAM_STR);
            $statement->bindValue(":name", $this->name, \PDO::PARAM_STR);
            $statement->bindValue(":price", $this->price, \PDO::PARAM_STR);
            $statement->bindValue(":attribute", $this->attribute, \PDO::PARAM_STR);

            if ($statement->execute()) {
                $this->id = $this->db->lastInsertId();
                return "Product {$this->sku} Added Successfully";
            }
            
            return false;
        } catch (\PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function delete(): string
    {
        try {
            $qMarks = str_repeat('?,', count($this->ids) - 1) . '?';
            $sqlQuery = "DELETE FROM `products` WHERE id IN ($qMarks)";
            $statement = $this->db->prepare($sqlQuery);

            foreach($this->ids as $k => $id){
                $statement->bindValue(($k+1), $id);
            }
            
            $statement->execute();

            return "Deleted Successfully";
        } catch (\PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function __set(string $name, $value)
    {
        return $this->$name = $value;
    }

    public function __get(string $name)
    {
        echo $this->$name;
        return $this->$name;
    }

}