
<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Acl_user extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function index_get()
    {
       $id = $this->get('id_acl');
       // print_r($this->get());die;
        if ($id == '') {
            $acl_user = $this->db->get('acl_user')->result();
        } else {
            $this->db->where('id_acl', $id);
            $acl_user = $this->db->get('acl_user')->result();
        }
        $this->response($acl_user, REST_Controller::HTTP_OK);
    }
    
    function index_post()
    {
        $group_id = '';
        if($this->post('role')=='admin'){
            $group_id = 1;
        }elseif($this->post('role')=='pegawai'){
            $group_id = 2;
        }else{
             $group_id = 3;
        }

        $data = array(
            'id_pegawai_pasien'  => $this->post('id_pegawai_pasien'),
            'username'           => $this->post('username'),
            'password'           => md5($this->post('password')),
            'role'               => $this->post('role'),
            'group_id'           =>  $group_id,
        );
        $insert = $this->db->insert('acl_user', $data);
        if ($insert) {
            $this->response(array('status' => 'success'), REST_Controller::HTTP_OK);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    function index_put() 
    {
      $id = $this->put('id_acl');
      $password='';

      $group_id = '';

      if($this->put('role')=='admin'){
          $group_id = 1;
      }elseif($this->put('role')=='pegawai'){
          $group_id = 2;
      }else{
           $group_id = 3;
      }

      $this->db->select('password');
      $this->db->where('id_acl', $id);
      $password_old = $this->db->get('acl_user')->result();
      $password_old = $password_old[0]->password;

      // print_r(md5($this->put('password')));die;
      if($password_old == $this->put('password')){
           $data = array(
               'id_pegawai_pasien'  => $this->put('id_pegawai_pasien'),
               'username'           => $this->put('username'),
               'role'               => $this->put('role'), 
               'group_id'           =>  $group_id,
              );
      }else{
          $data = array(
              'id_pegawai_pasien'  => $this->put('id_pegawai_pasien'),
              'username'           => $this->put('username'),
              'password'           => md5($this->put('password')),
              'role'               => $this->put('role'),
              'group_id'           =>  $group_id,
              );
      }

      $this->db->where('id_acl', $id);
      $update = $this->db->update('acl_user', $data);
          if ($update) {
              $this->response(array('status' => 'success'), 200);
          } else {
              $this->response(array('status' => 'fail', 502));
          }
    }

    function index_delete()
    {
        $id = $this->delete('id_acl');
        $this->db->where('id_acl', $id);
        $delete = $this->db->delete('acl_user');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'failed'), 502);
        }
    }

    //tes
}
