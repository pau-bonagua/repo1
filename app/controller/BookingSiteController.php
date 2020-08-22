<?php
require_once '../Model/Model.php';
require_once '../Inheritance/Inheritance.php';
require_once 'Validation.php';

use Model\BookingSite;

class BookingSiteController implements CRUD
{
    private $BookingSite;

    public function __construct()
    {
        $this->BookingSite = new BookingSite();
    }

    public function index()
    {
        $user_id = $_SESSION['user_id']; // 1; // 
        return $this->BookingSite->index($user_id);

        // --- VALIDATION ---
        if(!is_array($result))
        {
            return
            [
                'response'  => 0,
                'message'   => $result
            ];
        }
        else if(empty($result))
        {
            return
            [
                'response'  => 0,
                'message'   => 'no data found'
            ];
        }
        // --- END VALIDATION ---

        return 
        [
            'response'  => 1,
            'message'   => $result
        ];
    }

    public function store()
    {
        // $data = [
        //     'user_id'                              => 1,
        //     'header_large'                         => 1,
        //     'header_medium'                        => 1,
        //     'header_small'                         => 1,
        //     'header_xtra_small'                    => 1,
        //     'header_bg_color'                      => 1,
        //     'header_divider_color_1'               => 1,
        //     'header_divider_color_2'               => 1,
        //     'bg_image'                             => 1,
        //     'bg_color'                             => 1,
        //     'footer'                               => 1,
        //     'footer_bg_color'                      => 1,
        //     'page_text_color_1'                    => 1,
        //     'page_text_color_2'                    => 1,
        //     'button1_color'                        => 1,
        //     'button1_text_color'                   => 1,
        //     'button2_color'                        => 1,
        //     'button2_text_color'                   => 1,
        //     'button3_color'                        => 1,
        //     'button3_text_color'                   => 1,
        //     'text1_above_calendar'                 => 1,
        //     'website_address'                      => 1,
        //     'text2_above_calendar'                 => 1,
        //     'special_instruction'                  => 1,
        //     'custom_special_instruction'           => 1,
        //     'confirmation_email_footer_image'      => 1
        // ];

        
        $Validate = new Validate();

        $Validate->post('header_large');
        $Validate->post('header_medium');
        $Validate->post('header_small');
        $Validate->post('header_xtra_small');
        $Validate->post('header_bg_color');
        $Validate->post('header_divider_color_1');
        $Validate->post('header_divider_color_2');
        $Validate->post('bg_image');
        $Validate->post('bg_color');
        $Validate->post('footer');
        $Validate->post('footer_bg_color');
        $Validate->post('page_text_color_1');
        $Validate->post('page_text_color_2');
        $Validate->post('button1_color');
        $Validate->post('button1_text_color');
        $Validate->post('button2_color');
        $Validate->post('button2_text_color');
        $Validate->post('button3_color');
        $Validate->post('button3_text_color');
        $Validate->post('text1_above_calendar');
        $Validate->post('website_address');
        $Validate->post('text2_above_calendar');
        $Validate->post('special_instruction');
        $Validate->post('custom_special_instruction');
        $Validate->post('confirmation_email_footer_image');

        $data = $Validate->result_data;

        if(empty($data))
        {
            return 
            [
                'response'  => 0,
                'message'   => 'no data found from request'
            ];
        }

        $data['user_id'] = $_SESSION['user_id']; // 1; //   

        return $this->BookingSite->store($data);
    }

    public function update()
    {
        $Validate = new Validate();

        $Validate->post('header_large');
        $Validate->post('header_medium');
        $Validate->post('header_small');
        $Validate->post('header_xtra_small');
        $Validate->post('header_bg_color');
        $Validate->post('header_divider_color_1');
        $Validate->post('header_divider_color_2');
        $Validate->post('bg_image');
        $Validate->post('bg_color');
        $Validate->post('footer');
        $Validate->post('footer_bg_color');
        $Validate->post('page_text_color_1');
        $Validate->post('page_text_color_2');
        $Validate->post('button1_color');
        $Validate->post('button1_text_color');
        $Validate->post('button2_color');
        $Validate->post('button2_text_color');
        $Validate->post('button3_color');
        $Validate->post('button3_text_color');
        $Validate->post('text1_above_calendar');
        $Validate->post('website_address');
        $Validate->post('text2_above_calendar');
        $Validate->post('special_instruction');
        $Validate->post('custom_special_instruction');
        $Validate->post('confirmation_email_footer_image');

        $data = $Validate->result_data;

        if(empty($data))
        {
            return 
            [
                'response'  => 0,
                'message'   => 'no data found from request'
            ];
        }

        $where =
        [
            'id ='        => $_POST['id']
        ];

        return $this->BookingSite->update($data,$where);

    }

    public function delete()
    {

    }
    
}

$booking_site = new BookingSiteController();

$action = $_GET['action'];

if($action == 'index')
{
    $result = $booking_site->index();
    echo json_encode($result);
}

else if($action == 'store')
{
    $result = $booking_site->store();
    echo json_encode($result);
}

else if($action == 'update')
{
    $result = $booking_site->update();
    echo json_encode($result);
}

else if($action == 'delete')
{
    $result = $booking_site->delete();
    echo json_encode($result);
}