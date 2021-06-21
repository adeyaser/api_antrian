
<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Login extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    function index_post()
    {
     $username = $this->post('username');
     $password = md5($this->post('password'));
     $query="select * from ACL_USER where USERNAME ='$username' and password='$password'";
     $result = $this->db->query($query)->result();
       if ($result) {
           $this->response(array($result,'message'=>'Sukses'), REST_Controller::HTTP_OK);
       } else {
           $this->response(array('status' => 'fail', 502));
       }
    }
    
}
