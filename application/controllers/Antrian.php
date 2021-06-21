
<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Antrian extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function index_get()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal= date('d-m-Y');
        $query="select * from (
                SELECT no_antrian,
                id_antrian,
                DATE_FORMAT(tanggal,'%d-%m-%Y') as tgl_sort,
                tanggal,
                id_pasien,
                id_pegawai,aktif 
                FROM (
                SELECT * FROM ANTRIAN WHERE AKTIF ='Y' ORDER BY TANGGAL ASC LIMIT 1)T 
                )A where tgl_sort ='$tanggal'";
        $result = $this->db->query($query)->result();
        $this->response($result, REST_Controller::HTTP_OK);
    }
    
    function index_post()
    { 
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('y-m-d H:i:s');
        $data = array(
            'id_antrian'    => $this->post('id_antrian'),
            'tanggal'       => $tanggal,
            'id_pasien'     => $this->post('id_pasien'),
            'aktif'         => 'Y',
        );
        $insert = $this->db->insert('antrian', $data);
        if ($insert) {
            $this->response(array('status' => 'success'), REST_Controller::HTTP_OK);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    
    function index_put() 
    {
    $id = $this->put('no_antrian');
        if($this->put('aktif')=='N'){
            $data = array(
               'id_pegawai'     => $this->put('id_pegawai'),
               'aktif'         => 'N',
           );
        }else{
           $data = array(
               'id_pegawai'     => $this->put('id_pegawai'),
               'aktif'         => 'Y',
           );
        }

    $this->db->where('no_antrian', $id);
    $update = $this->db->update('antrian', $data);
        if ($update) {
            $this->response(array('status' => 'success'), 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete()
    {
        $id = $this->delete('no_antrian');
        $this->db->where('no_antrian', $id);
        $delete = $this->db->delete('antrian');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'failed'), 502);
        }
    }
}
