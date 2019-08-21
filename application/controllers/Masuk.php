<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masuk extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->load->helper('tglindo_helper');
		$this->getsecurity();
		date_default_timezone_set("Asia/Jakarta");
	}
	public function index(){
		$data['title'] = 'Parkir Masuk';
		$data['jenis'] = $this->db->query("SELECT * FROM tbl_kendaraan")->result_array();
		$data['masuk'] = $this->db->query("SELECT * FROM tbl_masuk RIGHT JOIN tbl_kendaraan ON tbl_masuk.kd_kendaraan = tbl_kendaraan.kd_kendaraan WHERE tgl_masuk LIKE '".date('Y-m-d')."%' AND status_masuk LIKE '1'")->result_array();
		// die(print_r($data));
		$this->load->view('parkirmasuk', $data, FALSE);
	}
	function getsecurity($value=''){
		$username = $this->session->userdata('username_admin');
		if (empty($username)) {
			$this->session->sess_destroy();
			redirect('login');
		}
	}
	function get_kod(){
        $q = $this->db->query("SELECT MAX(RIGHT(kd_masuk,3)) AS kd_max FROM tbl_masuk");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%08s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "M".$kd;
    }

    public function printmasuk($kd) {
    	$sql = $this->db->query("SELECT * FROM tbl_masuk WHERE kd_masuk = '".$kd."' ")->row_array();
    	// die(print_r($sql));
    	$this->load->view('printmasuk', $sql);
    }

	public function kendaraanmasuk(){
		// print_r($_POST);
		$plat = strtoupper($this->input->post('plat'));
		$nomor = strtoupper($this->input->post('nomor'));
		$back = strtoupper($this->input->post('back'));
		$kd_masuk = $this->get_kod();
		$data = array(
			'kd_masuk' => $this->get_kod(),
			'kd_kendaraan' => $this->input->post('jenis'),
			'plat_masuk' 	=> $plat." ".$nomor." ".$back,
			'tgl_masuk'		=> date('Y-m-d H:i:s'),
			'status_masuk' => 1,	
			'create_masuk' => $this->session->userdata('nama_admin')
			 );
		$this->db->insert('tbl_masuk', $data);
		// $data['cetak'] = $data;
		// $this->load->view('cetakparkir', $data);
		$this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = 'assets/img/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $image_name = $kd_masuk.'.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $kd_masuk; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

		$this->session->set_flashdata('alert', '$(function() {
                $.bootstrapGrowl("Karcis Sudah Dibuat",{
                		type: "success",
                        align: "right",
                        width: "auto",
                        allow_dismiss: false
                });
            	});');
		redirect('masuk');
	}
	public function delete($id=''){
		$sqlcek = $this->db->query("SELECT * FROM tbl_masuk WHERE kd_masuk LIKE '".$id."'")->row_array();
		if ($sqlcek) {
			$this->db->where('kd_masuk', $id); 
			$this->db->delete('tbl_masuk'); 
			$this->session->set_flashdata('alert', '$(function() {
                $.bootstrapGrowl("Kode Karcis Dihapus",{
                		type: "danger",
                        align: "right",
                        width: "auto",
                        allow_dismiss: false
                });
            	});');
			redirect('masuk');
		}else{
			$this->session->set_flashdata('alert', '$(function() {
                $.bootstrapGrowl("Kode Karcis Tidak Ada",{
                		type: "danger",
                        align: "right",
                        width: "auto",
                        allow_dismiss: false
                });
            	});');
			redirect('masuk');
		}
	}
	public function cetakstruk($id=''){
		$sqlcek = $this->db->query("SELECT * FROM tbl_masuk WHERE kd_masuk LIKE '".$id."'")->row_array();
		// die(print_r($sqlcek));
		if ($sqlcek) {
			$data['cetak'] = $sqlcek;
			// die(print_r($data));
			$this->load->view('cetakparkir', $data);
			$this->session->set_flashdata('alert', '$(function() {
                $.bootstrapGrowl("Cetak Struk Selesai",{
                		type: "success",
                        align: "right",
                        width: "auto",
                        allow_dismiss: false
                });
            	});');
				redirect('masuk');
		}else{
			$this->session->set_flashdata('alert', '$(function() {
                $.bootstrapGrowl("Kode Karcis Tidak Ada",{
                		type: "danger",
                        align: "right",
                        width: "auto",
                        allow_dismiss: false
                });
            	});');
			redirect('masuk');
		}
	}
	public function listkendaraanmasuk($value=''){
		$data['title'] = 'List Kendaraan Yang Belum Keluar';
		$data['masuk'] = $this->db->query("SELECT * FROM tbl_masuk RIGHT JOIN tbl_kendaraan ON tbl_masuk.kd_kendaraan = tbl_kendaraan.kd_kendaraan WHERE status_masuk LIKE '1'")->result_array();
		// die(print_r($data));
		$this->load->view('listkendaraan', $data, FALSE);
	}
}

/* End of file Masuk.php */
/* Location: ./application/controllers/Masuk.php */