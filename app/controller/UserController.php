<?php
require_once '../Model/Model.php';
require_once '../Inheritance/Inheritance.php';

use Model\User as User;

class UserController extends User
{
    /**
     * Select user 
     * 
     */
    public function index()
    {

        // --- testing variables --
        // $user_name = 'user1'; // 
        // $password = 'user1'; // 


        // --- VALIDATION ---
        if(!isset($_POST['user_name']) || !isset($_POST['password']))
        {
            return 
            [
                'response' => 0,
                'message' => 'Username/Password not set'
            ];
        }


        // //--- uncomment this if will test in frontend ---
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        


        $where = [$user_name, $password];

        $result = $this->check_credential($where);

        $response = 1;
        $message = $result;

        if(empty($result))
        {
            $response = 0;
            $message = 'User not found';
        }

        return 
        [
            'response'  => $response,
            'message'   => $message
        ];
        
    }

}

$user = new userController();

echo json_encode($user->index());