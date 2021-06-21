
<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Pasien extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function index_get()
    {
       $id = $this->get('id_pasien');
        if ($id == '') {
            $pasien = $this->db->get('pasien')->result();
        } else {
            $this->db->where('id_paseien', $id);
            $pasien = $this->db->get('pasien')->result();
        }
        $this->response($pasien, REST_Controller::HTTP_OK);
    }
    
    function index_post()
    {
        $data = array(
            'id_pasien'          => $this->post('id_pasien'),
            'nama_pasien'        => $this->post('nama_pasien'),
            'alamat'             => $this->post('alamat'),
            'jenis_kelamin'      => $this->post('jenis_kelamin'),
            'usia'               => $this->post('usia'),
            'email'              => $this->post('email'),
        );
        $insert = $this->db->insert('pasien', $data);
        if ($insert) {
            $this->response(array('status' => 'success'), REST_Controller::HTTP_OK);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    function index_put() 
    {
    $id = $this->put('id_pasien');
    $data = array(
        'nama_pasien'        => $this->put('nama_pasien'),
        'alamat'             => $this->put('alamat'),
        'jenis_kelamin'      => $this->put('jenis_kelamin'),
        'usia'               => $this->put('usia'),
        'email'              => $this->put('email'),
    );
    $this->db->where('id_pasien', $id);
    $update = $this->db->update('pasien', $data);
        if ($update) {
            $this->response(array('status' => 'success'), 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete()
    {
        $id = $this->delete('id_pasien');
        $this->db->where('id_pasien', $id);
        $delete = $this->db->delete('pasien');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'failed'), 502);
        }
    }
}
