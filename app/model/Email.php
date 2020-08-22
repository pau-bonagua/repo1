<?php
namespace Model;

require_once('App.php');
use App\DB as DB;

class Email
{

    private $db;

    public function __construct()
    {
        $this->db = DB::init();
    }

    public function index($user_id)
    {
        $query = "SELECT id, graphic, message, web_address, subject FROM email where user_id = ? ";
        $stmt = $this->db->conn->prepare($query);
        $stmt->execute([$user_id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function store($param)
    {
        $result = DB::insert('email',$param);
        return $result;
    }

    public function update($data,$where)
    {
        $result = DB::update('email',$data,$where);
        return $result;
    }
}
