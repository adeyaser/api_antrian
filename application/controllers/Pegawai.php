
<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Pegawai extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function index_get()
    {
       $id = $this->get('id_pegawai');
        if ($id == '') {
            $pegawai = $this->db->get('pegawai')->result();
        } else {
            $this->db->where('id_pegawai', $id);
            $pegawai = $this->db->get('pegawai')->result();
        }
        $this->response($pegawai, REST_Controller::HTTP_OK);
    }
    
    function index_post()
    {
        $data = array(
            'id_pegawai'         => $this->post('id_pegawai'),
            'nama_pegawai'       => $this->post('nama_pegawai'),
            'alamat'             => $this->post('alamat'),
            'no_telepon'         => $this->post('no_telepon'),
            'email'              => $this->post('email'),
        );
        $insert = $this->db->insert('pegawai', $data);
        if ($insert) {
            $this->response(array('status' => 'success'), REST_Controller::HTTP_OK);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    function index_put() 
    {
    $id = $this->put('id_pegawai');
    $data = array(
        'nama_pegawai'       => $this->put('nama_pegawai'),
        'alamat'             => $this->put('alamat'),
        'no_telepon'         => $this->put('no_telepon'),
        'email'              => $this->put('email'),
    );
    $this->db->where('id_pegawai', $id);
    $update = $this->db->update('pegawai', $data);
        if ($update) {
            $this->response(array('status' => 'success'), 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete()
    {
        $id = $this->delete('id_pegawai');
        $this->db->where('id_pegawai', $id);
        $delete = $this->db->delete('pegawai');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'failed'), 502);
        }
    }
}
