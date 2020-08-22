<?php
require_once '../Model/Model.php';
require_once '../Inheritance/Inheritance.php';

use Model\DigitalFileDistribution;

class DigitalFileDistributionController implements CRUD
{
    private $DigitalFileDistribution;

    public function __construct()
    {
        $this->DigitalFileDistribution = new DigitalFileDistribution();
    }

    public function index()
    {
        $user_id = 1;
        return $this->DigitalFileDistribution->index($user_id);
    }

    public function store()
    {
        $data = 
        [
            'user_id'                           => 1,
            'email_graphic'                     => 1,
            'email_subject'                     => 1,
            'linked_website'                    => 1,
            'microsite_banner'                  => 1,
            'background'                        => 1,
            'facebook_button'                   => 1,
            'facebook_text'                     => 1,
            'twitter_button'                    => 1,
            'twitter_text'                      => 1,
            'email_button'                      => 1,
            'layout'                            => 1,
            'layout1_opt1_graphic'              => 1,
            'layout1_opt1_link'                 => 1,
            'layout1_opt1_fb_url'               => 1,
            'layout1_opt2_graphic'              => 1,
            'layout1_opt2_live_feed_graphic'    => 1,
            'layout1_opt2_link'                 => 1,
            'opt_in'                            => 1,
            'opt_in_1'                          => 1,
            'opt_in_2'                          => 1,
            'opt_in_3'                          => 1,
            'opt_in_4'                          => 1,
            'opt_in_5'                          => 1,
            'opt_acceptance_msg'                => 1,
            'opt_custom_acceptance_msg'         => 1,
            'privacy_policy_url'                => 1
        ];
        return $this->DigitalFileDistribution->store($data);
    }

    public function update()
    {
        $data = 
        [
            'privacy_policy_url'    => 2,
        ];

        $where =
        [
            'id ='        => 1
        ];

        return $this->DigitalFileDistribution->update($data,$where);

    }

    public function delete()
    {

    }
    
}

$digital_file_distribution = new DigitalFileDistributionController();

$action = $_GET['action'];

if($action == 'index')
{
    $result = $digital_file_distribution->index();
    echo json_encode($result);
}

else if($action == 'store')
{
    $result = $digital_file_distribution->store();
    echo json_encode($result);
}

else if($action == 'update')
{
    $result = $digital_file_distribution->update();
    echo json_encode($result);
}

else if($action == 'delete')
{
    $result = $digital_file_distribution->delete();
    echo json_encode($result);
}