<?php

abstract class AbstractEntity
{
    protected $dbc;
    protected $tableName;
    protected $fields;

    abstract protected function initFields();


    public function __construct(PDO $dbc, string $tableName)
    {
        $this->dbc = $dbc;
        $this->tableName = $tableName;
        $this->initFields();
    }


    public function findBy(string $fieldName, $fieldValue)
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

    public function getAll()
    {

        $sql = "SELECT * FROM $this->tableName";
        echo $sql;
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute();
        $databaseData = $stmt->fetchAll();

        if (!$databaseData) {
            return [];
        }

        $results = array_map(function ($row) {
            $obj = new $this($this->dbc, $this->tableName);
            $obj->setValues($row);
            return $obj;
        }, $databaseData);

        return $results;
    }

    public function setValues($values)
    {
        foreach ($this->fields as $fieldName) {
            $this->$fieldName = $values[$fieldName];
        }
    }
}
