<?php

namespace app\database;

interface IPostgreSQLDatabase
{
    public function insert($values);
    public function select($class, $where = null, $fields = null,$orderby=null);
    public function update($values, $id);

    public function setTable($table);

}
