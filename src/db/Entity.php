<?php

class Entity
{
    protected $dbc;
    protected $tableName;
    protected $fields;

    public function findBy($fieldName, $fieldValue)
    {

        $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $fieldName . " = :value LIMIT 1";
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute(['value' => $fieldValue]);
        $databaseData = $stmt->fetch();

        if (!$databaseData) {
            return false;
        }

        $this->setValues($databaseData);
        return true;
    }

    public function setValues($values)
    {
        foreach ($this->fields as $fieldName) {
            $this->$fieldName = $values[$fieldName];
        }
    }
}
