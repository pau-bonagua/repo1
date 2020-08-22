<?php
namespace Model;

include_once('App.php');
use App\DB as DB;

class DigitalFileDistribution
{
    private $db;

    public function __construct()
    {
        $this->db = DB::init();
    }

    public function index($user_id)
    {
        $query = "SELECT id, email_graphic, email_subject, linked_website, microsite_banner, background, facebook_button, facebook_text, twitter_button, twitter_text, email_button, layout, layout1_opt1_graphic, layout1_opt1_link, layout1_opt1_fb_url, layout1_opt2_graphic, layout1_opt2_live_feed_graphic, layout1_opt2_link, opt_in, opt_in_1, opt_in_2, opt_in_3, opt_in_4, opt_in_5, opt_acceptance_msg, opt_custom_acceptance_msg, privacy_policy_url FROM digital_file_distribution where user_id = ? ";
        $stmt = $this->db->conn->prepare($query);
        $stmt->execute([$user_id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function store($param)
    {
        $result = DB::insert('digital_file_distribution',$param);
        return $result;
    }

    public function update($data,$where)
    {
        $result = DB::update('digital_file_distribution',$data,$where);
        return $result;
    }    
}
