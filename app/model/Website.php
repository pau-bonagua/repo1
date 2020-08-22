<?php
namespace Model;

require_once('App.php');
use App\DB as DB;

class Website
{

    private $db;

    public function __construct()
    {
        $this->db = DB::init();
    }

    public function index($user_id)
    {
        $query = "SELECT id, banner, branding_marketing_graphic, social_feed, background FROM website where user_id = ? ";
        $stmt = $this->db->conn->prepare($query);
        $stmt->execute([$user_id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function store($param)
    {
        $result = DB::insert('website',$param);
        return $result;
    }

    public function update($data,$where)
    {
        $result = DB::update('website',$data,$where);
        return $result;
    }

    
    
}
