<?php

namespace E5\Shared;

use Exception;
use PDO;

class MysqlRepository
{
    public $connection;

    public function __construct()
    {
        $file_path = realpath($_SERVER['DOCUMENT_ROOT'] . '/tienda_e5/config/database.ini');

        if (!$db_settings = parse_ini_file($file_path)) throw new Exception('Unable to open ' . $file_path . '.');

        $dsn = sprintf(
            '%s:dbname=%s;host=%s:%s',
            $db_settings['driver'],
            $db_settings['schema'],
            $db_settings['host'],
            $db_settings['port'],
        );

        $_connection = new PDO(
            $dsn,
            $db_settings['username'],
            $db_settings['password']
        );
        $_connection->exec('SET CHARACTER SET UTF8');
        $this->connection = $_connection;
    }

    public function insert(string $table_name, array $params)
    {
        $query = 'INSERT INTO ' . $table_name . ' VALUES(';
        foreach ($params as $i) {
            $query .= '?,';
        }
        $query = substr_replace($query, ')', -1, 1);
        $request = $this->connection->prepare($query);

        if ($request->execute(array_values($params))) {
            if (!is_null($params['id'])) {
                return $this->select($table_name, null, 'id=:id', ['id' => $params['id']])[0];
            }
            return $this->select($table_name, null, 'id=:id', ['id' => $this->connection->lastInsertId()])[0];
        };
        return false;
    }

    public function update(string $table_name, array $params, string $condition)
    {
        $query = 'UPDATE ' . $table_name . ' SET ';
        foreach ($params as $key => $value) {
            if ($key == 'id' || $key == ':id') {
                continue;
            }
            $query .= $key[0] == ':' ? str_replace(':', '', $key) . '=' . $key : $key . '=:' . $key;
            $query .= ',';
        }
        $query = substr_replace($query, ' WHERE ' . $condition, -1, 1);

        $request = $this->connection->prepare($query);
        if ($request->execute($params)) {

            return $this->select($table_name, null, 'id=:id', ['id' => $params['id']])[0];
        };
        return false;
    }

    public function delete(string $table_name, string $condition, array $params, bool $permanent = false)
    {
        $rows_delete = $this->select($table_name, null, $condition, $params);

        if ($permanent) {
            $query = 'DELETE FROM ' . $table_name . ' WHERE ' . $condition;
        } else {
            $query = 'UPDATE ' . $table_name . ' SET enable=0 WHERE ' . $condition;
        }
        $request = $this->connection->prepare($query);
        if ($request->execute($params)) {

            return $rows_delete;
        };
        return false;
    }



    public function select(string $table_name, string $class_schema = null, string $condition = '', ?array $params = null, string $columns = '*')
    {
        $query = 'SELECT ' . $columns . ' FROM ' . $table_name;
        $query .= $condition == '' ? '' : ' WHERE ' . $condition;
        $request = $this->connection->prepare($query);
        $request->execute($params);
        if ($class_schema == null) {
            return $request->fetchAll(PDO::FETCH_ASSOC);
        }

        return $request->fetchAll(PDO::FETCH_CLASS, $class_schema);
    }
}
