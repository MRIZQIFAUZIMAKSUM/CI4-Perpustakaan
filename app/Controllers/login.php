<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MemberModel;

class Login extends BaseController {

	public function index()
	{
		
		echo view('perpusweb_templates/header_login');
		echo view('login/index');
		echo view('perpusweb_templates/footer_login');
	}

	public function proses_login()
	{
		$username = $this->input->post('user');
    	$password = $this->input->post('pwd');

    	$where = array(
    		'nama' => $username,
    		'pass' => $password
    	);

    	$cek = $this->login_model->cek_login($where, 'pengguna')->num_rows();
    	$data = $this->login_model->cek_login($where, 'pengguna')->row_array();
    	if ($cek > 0) {

    		$sessi = array(
				'id_user' => $data['id_user'],
    			'username' => $data['nama'],
    			'email' => $data['email'],
    			'notelp' => $data['notelp'],
    			'status' => $data['status'],
    			'level' => $data['level'],
				'foto' => $data['foto'],
				'role' => $data['role'],
				'login' => 'perpusweb'
    		);

			$this->session->set_userdata($sessi);
			
			$respon = array('respon' => 'success');
			echo json_encode($respon);
    	}
    	else{
			$respon = array('respon' => 'failed');
			echo json_encode($respon);
		}

	}

	public function logout()
	{
		$this->session->sess_destroy();
		$respon = array('respon' => 'success');
		echo json_encode($respon);
	}
}
