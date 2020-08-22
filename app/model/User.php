<?php
namespace Model;

require_once 'App.php';
use App\DB as DB;

class User
{
    private $db;
    public function __construct()
    {
        $this->db = DB::init();
    }

    public function select_all()
    {
        $query = "SELECT * FROM User";
        $stmt = $this->db->user->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function check_credential($where)
    {
        // return $where;
        $query = "SELECT id FROM user WHERE user_name = ? and password = ? ";
        $stmt = $this->db->user->prepare($query);
        $stmt->execute($where);
        $result = $stmt->fetchAll();
        return $result;
    }
    
}