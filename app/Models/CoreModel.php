<?php

// this model holds the methods that may be used by all models

namespace App\Models;

use Exception;

class CoreModel extends Model
{
    private $ids = [];

    public function get($table): array
    {
        $sqlQuery = "SELECT * FROM `$table`";

        $statement = $this->db->query($sqlQuery);

        $data = [];

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }

    public function massDelete($table): bool
    {
        try {
            $qMarks = str_repeat('?,', count($this->ids) - 1) . '?';
            $sqlQuery = "DELETE FROM `$table` WHERE id IN ($qMarks)";
            $statement = $this->db->prepare($sqlQuery);

            foreach ($this->ids as $k => $id) {
                $statement->bindValue(($k + 1), $id);
            }

            $statement->execute();

            if ($statement->rowCount() > 0) {
                return true;
            }

            return false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function setIds(array $ids)
    {
        foreach ($ids as $id) {
            if ($id <= 0) {
                throw new Exception(
                    "Invalid ID value. IDs must be positive integers."
                );
            }
        }
        $this->ids = $ids;
        var_dump($this->ids);
    }

    public function getIds()
    {
        return $this->ids;
    }
}
