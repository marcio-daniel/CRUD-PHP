<?php

namespace app\database;

use PDO;
use PDOException;


class PostgreSQLDatabase extends DbConnection implements IPostgreSQLDatabase
{


    public function __construct() {
        $this->connect();
    }

    
    public function setTable($table)
    {
        $this->table = $table;
    }

    protected function connect()
    {
        try {
            $this->connection = new PDO("pgsql:host=db_postgres;port=5432;dbname=db_projetoII;user=root;password=root");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $th) {
            throw $th;
        }
    }
    private function execute($sql, $params = [])
    {
        try {
            $statement = $this->connection->prepare($sql);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $th) {
            throw $th;
        }
    }

    public function insert($values)
    {
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');
        $sql = 'INSERT INTO public.' . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';
        $this->execute($sql, array_values($values));
        return $this->connection->lastInsertId();
    }

    public function select($class, $where = null, $fields = null,$orderby=null)
    {
        $where = isset($where) ? ' WHERE ' . $where : '';
        $fields = isset($fields) ? $fields : ' * ';
        $orderbY = isset($orderby) ? 'ORDER BY '.$orderby : '';
        $sql = 'SELECT ' . $fields . ' FROM public.' . $this->table . ' ' . $where.''.$orderbY;
        return $this->execute($sql)->fetchAll(PDO::FETCH_CLASS, $class);
    }

    public function update($values, $id)
    {
        $fields = array_keys($values);
        $val = array_values($values);
        $sql = 'UPDATE public.' . $this->table . ' SET ';
        for ($i = 0; $i < count($values); $i++) {
            if ($i == count($values) - 1) {
                $sql = $sql . '' . $fields[$i] . ' = ? ';
            } else {
                $sql = $sql . '' . $fields[$i] . ' = ?, ';
            }
        }
        $sql = $sql . ' WHERE id = ' . $id;
        $this->execute($sql, $val);
    }
}
