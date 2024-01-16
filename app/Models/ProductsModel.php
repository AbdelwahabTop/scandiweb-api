<?php

// This is the abstract class that all products will extend from and will contain the common properties and methods
/* note: this class dosen't include get() and delete() methods as they are not necessary for every product type. 
Instead, we utilize these methods from a more generic class.*/

namespace App\Models;

use Exception;

abstract class ProductsModel extends Model
{
    private $id;
    private $sku;
    private $name;
    private $price;
    private $attribute;

    public function create(): string
    {
        try {
            $sqlQuery = "INSERT INTO `products` (sku, name, price, attribute)
                        VALUES (:sku, :name, :price, :attribute)";
            $statement = $this->db->prepare($sqlQuery);

            $statement->bindValue(":sku", $this->sku, \PDO::PARAM_STR);
            $statement->bindValue(":name", $this->name, \PDO::PARAM_STR);
            $statement->bindValue(":price", $this->price, \PDO::PARAM_STR);
            $statement->bindValue(":attribute", $this->attribute, \PDO::PARAM_STR);

            if ($statement->execute()) {
                $this->setId($this->db->lastInsertId());

                return true;
            }

            return false;
        } catch (\PDOException $e) {
            return false;
        }
    }



    // Setters
    public function setId($id)
    {
        return $this->id = $id;
    }

    public function setSku(string $sku): void
    {
        if (strlen($sku) > 255 || strlen($sku) < 1 || !ctype_alnum($sku)) {
            throw new Exception(
                "Invalid SKU value. SKU must be alphanumeric and between 1 and 255 characters long."
            );
        }

        $this->sku = $sku;
    }

    public function setName(string $name): void
    {
        if (strlen($name) > 255 || strlen($name) < 1) {
            throw new Exception(
                "Invalid Name value. Name must be between 1 and 255 characters long."
            );
        }

        $this->name = $name;
    }

    public function setPrice(float|string $price): void
    {
        if ($price < 0) {
            throw new Exception(
                "Invalid Price value. Price must be a positive number."
            );
        }
        $this->price = $price;
    }

    public function setAttribute(string $attribute): void
    {
        if (strlen($attribute) > 255 || strlen($attribute) < 1) {
            throw new Exception(
                "Invalid Attribute value. Attribute must be between 1 and 255 characters long."
            );
        }
        $this->attribute = $attribute;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getSku()
    {
        return $this->sku;
    }
}
