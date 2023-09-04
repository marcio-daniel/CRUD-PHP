<?php 

namespace app\database;

abstract class DbConnection {
    protected $table;

    protected $connection;
    protected abstract function connect();

}