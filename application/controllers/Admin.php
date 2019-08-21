<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
	parent::__construct();
		$this->getsecurity();
		$this->load->library('form_validation');
		date_default_timezone_set("Asia/Jakarta");
	}
	function get_kod(){
            $q = $this->db->query("SELECT MAX(RIGHT(kd_admin,3)) AS kd_max FROM tbl_admin");
            $kd = "";
            if($q->num_rows()>0){
                foreach($q->result() as $k){
                    $tmp = ((int)$k->kd_max)+1;
                    $kd = sprintf("%03s", $tmp);
                }
            }else{
                $kd = "001";
            }
            return "A".$kd;
        }
	function getsecurity($value=''){
		// $username = $this->session->userdata('level');
		// if ($username == '2') {
			// $this->session->sess_destroy();
			// redirect('home');
		// }
	}
	public function index(){
		$data['title'] = "List Admin";
		$data['admin'] = $this->db->query("SELECT * FROM tbl_admin")->result_array();
		// die(print_r($data));
		$this->load->view('admin', $data);
	}

	public function daftar(){
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[tbl_admin.username_admin]',array(
			'required' => 'Email Wajib Di isi.',
			'is_unique' => 'Username Sudah Di Gunakan'
			 ));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',array(
			'required' => 'Email Wajib Di isi.',
			 ));
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|matches[password2]',array(
			'matches' => 'Password Tidak Sama.',
			'min_length' => 'Password Minimal 8 Karakter.'
			 ));
		$this->form_validation->set_rules('password2', 'Password2', 'trim|required|matches[password]');
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Tambah Admin';
			$this->load->view('tambahadmin',$data);
		} else {
			// die(print_r($_POST));
			$kode = $this->get_kod();
			$data = array(
				'kd_admin' 			=> $kode,
				'nama_admin' 		=> $this->input->post('name'),
				'email_admin'		=> $this->input->post('email'),
				'no_hp_admin'		=> $this->input->post('no_hp'),
				'img_admin'			=> 'assets/dist/img/default.png',
				'username_admin' 	=> strtolower($this->input->post('username')),
				'password_admin' 	=> password_hash($this->input->post('password'),PASSWORD_DEFAULT),
				'level_admin'		=> $this->input->post('level'),
				'create_date_admin' => time()
				 );
			// die(print_r($data));
			$this->db->insert('tbl_admin', $data);
    		redirect('admin');
		}

	}

	public function edit($method, $kode){
		
		if ($method == 'edit') {
			$sqlAdmin = $this->db->query("SELECT * FROM tbl_admin WHERE kd_admin = '".$kode."' ");
			if ($sqlAdmin->num_rows() > 0) {
				$rowAdmin = $sqlAdmin->row_array();
				$data['kd_admin'] 		= $rowAdmin['kd_admin'];
				$data['nama_admin'] 	= $rowAdmin['nama_admin'];
				$data['email_admin'] 	= $rowAdmin['email_admin'];
				$data['no_hp_admin'] 	= $rowAdmin['no_hp_admin'];
				$data['username_admin']	= $rowAdmin['username_admin'];
				$data['level_admin'] 	= $rowAdmin['level_admin'];
			} else {
				$data['kd_admin'] 		= '';
				$data['nama_admin'] 	= '';
				$data['email_admin'] 	= '';
				$data['no_hp_admin'] 	= '';
				$data['username_admin']	= '';
				$data['level_admin'] 	= '';
			}
			$data['title'] = 'Edit Admin';
			$this->load->view('editadmin',$data);
		} else {
			// die(print_r($_POST));
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[tbl_admin.username_admin]',array(
				'required' => 'Email Wajib Di isi.',
				'is_unique' => 'Username Sudah Di Gunakan'
				 ));
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',array(
				'required' => 'Email Wajib Di isi.',
				 ));
			if ($this->form_validation->run() == true) {
				$data = array(
					'nama_admin' 		=> $this->input->post('name'),
					'email_admin'		=> $this->input->post('email'),
					'no_hp_admin'		=> $this->input->post('no_hp'),
					'username_admin' 	=> strtolower($this->input->post('username')),
					'level_admin'		=> $this->input->post('level'),
				);
				// die(print_r($data));
				$this->db->update('tbl_admin', $data, array('kd_admin' => $kode));
				$this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil Edit Data Admin", "success");');
	    		redirect('admin');
	    	} else {
	    		$sqlAdmin = $this->db->query("SELECT * FROM tbl_admin WHERE kd_admin = '".$kode."' ");
			if ($sqlAdmin->num_rows() > 0) {
				$rowAdmin = $sqlAdmin->row_array();
					$data['kd_admin'] 		= $rowAdmin['kd_admin'];
					$data['nama_admin'] 	= $rowAdmin['nama_admin'];
					$data['email_admin'] 	= $rowAdmin['email_admin'];
					$data['no_hp_admin'] 	= $rowAdmin['no_hp_admin'];
					$data['username_admin']	= $rowAdmin['username_admin'];
					$data['level_admin'] 	= $rowAdmin['level_admin'];
					
				} else {
					$data['kd_admin'] 		= '';
					$data['nama_admin'] 	= '';
					$data['email_admin'] 	= '';
					$data['no_hp_admin'] 	= '';
					$data['username_admin']	= '';
					$data['level_admin'] 	= '';
					$data['password_admin']	= '';
				}
	    		$data['title'] = 'Edit Admin';
				$this->load->view('editadmin',$data);
	    	}
		}

	}

	public function ganti_password($method, $kode){
		
		if ($method == 'edit') {
			$sqlAdmin = $this->db->query("SELECT * FROM tbl_admin WHERE kd_admin = '".$kode."' ");
			if ($sqlAdmin->num_rows() > 0) {
				$rowAdmin = $sqlAdmin->row_array();
				$data['kd_admin'] 		= $rowAdmin['kd_admin'];
				$data['nama_admin'] 	= $rowAdmin['nama_admin'];
				$data['email_admin'] 	= $rowAdmin['email_admin'];
				$data['no_hp_admin'] 	= $rowAdmin['no_hp_admin'];
				$data['username_admin']	= $rowAdmin['username_admin'];
				$data['level_admin'] 	= $rowAdmin['level_admin'];
				$data['password_admin']	= $rowAdmin['password_admin'];
			} else {
				$data['kd_admin'] 		= '';
				$data['nama_admin'] 	= '';
				$data['email_admin'] 	= '';
				$data['no_hp_admin'] 	= '';
				$data['username_admin']	= '';
				$data['level_admin'] 	= '';
				$data['password_admin']	= '';
			}
			$data['title'] = 'Ganti Password Admin';
			$this->load->view('gantiPasswordAdmin',$data);
		} else {
			// die(print_r($_POST));
			$data = array(
				'password_admin' 	=> password_hash($this->input->post('password'),PASSWORD_DEFAULT),
			);
			// die(print_r($data));
			$this->db->update('tbl_admin', $data, array('kd_admin' => $kode));
			$this->session->set_flashdata('message', 'swal("Berhasil", "Berhasil Ganti Password Admin", "success");');
    		redirect('admin');
		}
	}

	public function get_password() {
		// $param = $_GET['pass'];

        $kd_admin   = $_GET['kd_admin'];
        $password   = $_GET['password'];

        $queryDataUser = $this->db->query("SELECT * FROM tbl_admin WHERE kd_admin='".$kd_admin."' limit 1");
        $queryDataUserResult = $queryDataUser->result();
        if ( count($queryDataUserResult) > 0 ) { // ada user nama itu
            if(password_verify($password, $queryDataUserResult[0]->password_admin)) {
                $send = TRUE;
            } else {
                $send = FALSE;
            }
        } else {
            $send = FALSE;
        }        

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/javascript')
            ->set_output(json_encode($send))
            ->_display();
        exit;
	}

	public function deleteAdmin($kode =''){
		$sqlcek = $this->db->query("SELECT * FROM tbl_admin WHERE kd_admin = '".$kode."' ")->row_array();
		if ($sqlcek) {
			$this->db->where('kd_admin', $kode); 
			$this->db->delete('tbl_admin'); 
			$this->session->set_flashdata('alert', '$(function() {
                $.bootstrapGrowl("Data Admin Dihapus",{
                		type: "danger",
                        align: "right",
                        width: "auto",
                        allow_dismiss: false
                });
            	});');
			redirect('admin');
		}else{
			$this->session->set_flashdata('alert', '$(function() {
                $.bootstrapGrowl("Data Admin Tidak Ada",{
                		type: "danger",
                        align: "right",
                        width: "auto",
                        allow_dismiss: false
                });
            	});');
			redirect('admin');
		}
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */