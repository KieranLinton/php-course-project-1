<?php

namespace core\db;

#[\AllowDynamicProperties]
abstract class AbstractEntity
{
    public int $id;

    protected $dbc;
    protected $tableName;
    protected $fields;
    protected $primaryKeys = ['id'];

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

    public function save()
    {

        $fieldBindings = [];
        $keyBindings = [];
        $preparedFields = [];

        foreach ($this->primaryKeys as $fieldName) {
            $keyBindings[$fieldName] = $fieldName . ' = :' . $fieldName;
            $preparedFields[$fieldName] = $this->$fieldName;
        }

        foreach ($this->fields as $fieldName) {
            $fieldBindings[$fieldName] = $fieldName . ' = :' . $fieldName;
            $preparedFields[$fieldName] = $this->$fieldName;
        }

        $fieldBindingsSql = join(', ', $fieldBindings);
        $keyBindingsSql = join(', ', $keyBindings);


        $sql = "UPDATE " . $this->tableName . " SET " . $fieldBindingsSql
            . " WHERE " . $keyBindingsSql;

        //echo $sql;

        $stmt = $this->dbc->prepare($sql);
        $stmt->execute($preparedFields);
    }

    public function setValues($values)
    {

        foreach ($this->primaryKeys as $keyName) {
            if (isset($values[$keyName])) {
                $this->$keyName = $values[$keyName];
            }
        }

        foreach ($this->fields as $fieldName) {
            if (isset($values[$fieldName])) {
                $this->$fieldName = $values[$fieldName];
            }
        }
    }
}
