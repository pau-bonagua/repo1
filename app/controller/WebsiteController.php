<?php
require_once '../Model/Model.php';
require_once '../Inheritance/Inheritance.php';
require_once 'Validation.php';

use Model\Website;

class WebsiteController implements CRUD
{
    private $Website;

    public function __construct()
    {
        $this->Website = new Website();
    }

    public function index()
    {
        $user_id =  $_SESSION['user_id']; // 1; //
        $result = $this->Website->index($user_id);

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
        // --- testing variables ---
        $data =
        [ 
            'user_id'                       => 1, 
            'banner'                        => 1, 
            'branding_marketing_graphic'    => 1, 
            'social_feed'                   => 1, 
            'background'                    => 1
        ];

        $Validate = new Validate();

        $Validate->post('banner');
        $Validate->post('branding_marketing_graphic');
        $Validate->post('social_feed');
        $Validate->post('background');

        $data = $Validate->result_data;

        if(empty($data))
        {
            return 
            [
                'response'  => 0,
                'message'   => 'no data found from request'
            ];
        }

        $data['user_id'] = 1; // $_SESSION['user_id']; // 

        return $this->Website->store($data);
    }

    public function update()
    {
        $Validate = new Validate();

        $Validate->post('banner');
        $Validate->post('branding_marketing_graphic');
        $Validate->post('social_feed');
        $Validate->post('background');

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
            'id ='        =>  $_POST['id']
        ];

        return $this->Website->update($data,$where);
    }

    public function delete()
    {

    }
    
}

$website = new WebsiteController();

$action = $_GET['action'];

if($action == 'index')
{
    $result = $website->index();
    echo json_encode($result);
}

else if($action == 'store')
{
    $result = $website->store();
    echo json_encode($result);
}

else if($action == 'update')
{
    $result = $website->update();
    echo json_encode($result);
}

else if($action == 'delete')
{
    $result = $website->delete();
    echo json_encode($result);
}