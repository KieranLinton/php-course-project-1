<?php

abstract class AbstractEntity
{
    protected $dbc;
    protected $tableName;
    protected $fields;

    abstract protected function initFields();


    public function __construct($dbc, string $tableName)
    {
        $this->dbc = $dbc;
        $this->tableName = $tableName;
        $this->initFields();
    }

    private function find(string $fieldName = "", $fieldValue = "")
    {
        $preparedFields = [];
        $sql = "SELECT * FROM " . $this->tableName;
        if ($fieldName) {
            $sql .= " WHERE " . $fieldName . " = :value";
            $preparedFields = ['value' => $fieldValue];
        }
        $stmt = $this->dbc->prepare($sql);
        $stmt->execute($preparedFields);

        $databaseData = $stmt->fetchAll();
        return $databaseData;
    }


    public function findBy(string $fieldName, $fieldValue)
    {
        $databaseData = $this->find($fieldName, $fieldValue);

        if (!$databaseData || !$databaseData[0]) {
            return false;
        }

        $this->setValues($databaseData[0]);
        return true;
    }


    public function findAll()
    {
        $databaseData =  $this->find();

        if (!$databaseData) {
            return [];
        }

        $className = get_class($this);

        $results = array_map(function ($row) use ($className) {
            $obj = new $className($this->dbc, $this->tableName);
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
