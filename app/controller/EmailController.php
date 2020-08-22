<?php
require_once '../Model/Model.php';
require_once '../Inheritance/Inheritance.php';
require_once 'Validation.php';

use Model\Email;

class EmailController implements CRUD
{

    private $Email;
    public function __construct()
    {
        $this->Email = new Email();
    }

    public function index()
    {
        $user_id = $_SESSION['user_id']; // 1; // 
        $result = $this->Email->index($user_id);

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
        // $data = 
        // [
        //     'user_id'       => 1,
        //     'graphic'       => 1,
        //     'message'       => 1,
        //     'web_address'   => 1,
        //     'subject'       => 1,
        // ];

        $Validate = new Validate();

        $Validate->post('graphic');
        $Validate->post('message');
        $Validate->post('web_address');
        $Validate->post('subject');

        $data = $Validate->result_data;

        if(empty($data))
        {
            return 
            [
                'response'  => 0,
                'message'   => 'no data found from request'
            ];
        }

        $data['user_id'] = $_SESSION['user_id'];
        
        $result = $this->Email->store($data);
        
    }

    public function update()
    {
        // $data = 
        // [
        //     'graphic'       => 1,
        //     'message'       => 1,
        //     'web_address'   => 1,
        //     'subject'       => 2,
        // ];

        $Validate = new Validate();

        $Validate->post('graphic');
        $Validate->post('message');
        $Validate->post('web_address');
        $Validate->post('subject');

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
            'id ='          => $_POST['id']
        ];

        return $this->Email->update($data,$where);
    }

    public function delete()
    {

    }

}

$email = new EmailController();

$action = $_GET['action'];

if($action == 'index')
{
    $result = $email->index();
    echo json_encode($result);
}

else if($action == 'store')
{
    $result = $email->store();
    echo json_encode($result);
}

else if($action == 'update')
{
    $result = $email->update();
    echo json_encode($result);
}

else if($action == 'delete')
{
    $result = $email->delete();
    echo json_encode($result);
}