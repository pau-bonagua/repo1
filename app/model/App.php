<?php
namespace App;

require_once '../../config/database.php';
// require_once '../config/db_init.php';

use PDO;
use stdClass;

class DB 
{

    private static $database;

    public function __construct()
    {
        // global $database;
        // $this->db = $database;
        // $this->init();
    }

    public function init()
    {
        global $db;

        self::$database = new stdClass();


        foreach($db as $key => $row)
        {
            $dsn = $row['dbdriver'].':host='.$row['hostname'].';dbname='.$row['database'];
            $opt = [
                PDO::ATTR_ERRMODE				=> PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE 	=> PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES 		=> false,
            ];

            try
            {
                ${$key} = new PDO($dsn,$row['username'],$row['password'],$opt);
                self::$database->{$key} = ${$key};
            }
            catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$database;
    }

    /**
     * Seperate values from controller
     * 
     * param array $obj 
     * param string $method 
     * 
     * return array
     * [
     *      'string_key'    => 
     *      'string_val'    =>
     *      'array_val'     =>
     * ]
     */
    public static function seperate_values($obj)
    {
        $data_key = array_keys($obj);
        $data_val = array_keys($obj);

        $string_key = implode(",", $data_key);

        $string_val = "";
        foreach ($obj as $key => $value) 
        {
            $string_val .= "?,";
        }
        $string_val = rtrim($string_val, ",");

        return [
            'string_key' => $data_key,
            'string_val' => $string_key,
            'array_val'  => $data_val
        ];
    }

    public function insert($table,$data)
    {
        try {
            $data_key = array_keys($data);
            $data_val = array_values($data);

            $key = implode(",", $data_key);

            $values = "";
            foreach ($data_val as $row => $value) {
                $values = $values . "?,";
            }
            $values = rtrim($values, ",");

            $query = "INSERT INTO $table ($key) VALUES ($values);";
            $stmt = self::$database->conn->prepare($query);
            $stmt->execute($data_val);

            return TRUE;
        } catch (Exception $e) 
        {
            return $e;
        }

    }

    public function update($table,$data,$where)
    {
        try {
            $data_key = array_keys($data);
            $where_key = array_keys($where);
            $where_val = "";
            $set_val = "";

            // query concatination
            for ($x = 0; $x < count($data_key); $x++) {
                $set_val = $set_val . $data_key[$x] . "= ?,";
            }
            $set_val = rtrim($set_val, ",");

            // where concatination
            for ($x = 0; $x < count($where_key); $x++) {
                $where_val = $where_val . $where_key[$x] . " ? AND";
            }
            $where_val = rtrim($where_val, "AND");


            // pushing values to array
            $values = [];
            foreach ($data as $row => $value) {
                array_push($values, $value);
            }
            // pushing where values to array
            foreach ($where as $key => $value) {
                array_push($values, $value);
            }


            $query = "UPDATE {$table} set {$set_val} where {$where_val}";
            $stmt = self::$database->conn->prepare($query);
            $stmt->execute($values);

            return TRUE;
        } catch (Exception $e) {
            echo $e;
        }
    }




}