<?php
namespace Model;

include_once('App.php');
use App\DB as DB;

class BookingSite
{
    private $db;

    public function __construct()
    {
        $this->db = DB::init();
    }

    public function index($user_id)
    {
        $query = "SELECT id, header_large, header_medium, header_small, header_xtra_small, header_bg_color, header_divider_color_1, header_divider_color_2, bg_image, bg_color, footer, footer_bg_color, page_text_color_1, page_text_color_2, button1_color, button1_text_color, button2_color, button2_text_color, button3_color, button3_text_color, text1_above_calendar, website_address, text2_above_calendar, special_instruction, custom_special_instruction, confirmation_email_footer_image FROM booking_site where user_id = ? ";
        $stmt = $this->db->conn->prepare($query);
        $stmt->execute([$user_id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function store($param)
    {
        $result = DB::insert('booking_site',$param);
        return $result;
    }

    public function update($data,$where)
    {
        $result = DB::update('booking_site',$data,$where);
        return $result;
    }    
}
