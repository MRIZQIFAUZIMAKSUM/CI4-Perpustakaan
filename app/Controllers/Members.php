<?php namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\PinjamanModel;
use App\Models\UserModel;

class Members extends BaseController
{
	public function index(){
		$data = [];
		helper(['form']);

		$model = new MemberModel();
		$anggota = $model->findAll();

		$data['title'] = "List Anggota";
		$data['anggota'] = $anggota;
		echo view('templates/header', $data);
		echo view('members/list');
		echo view('templates/footer');
	}
	public function add_admin(){
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
				'username' => 'required|min_length[3]|max_length[100]|is_unique[login.username]',
				'password' => 'required|min_length[8]|max_length[255]',
				'password_confirm' => 'matches[password]',
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
			    
				$nis = $this->request->getVar('member_id');
				$username =  $this->request->getVar('username');
			    $data = [];
				$model = new UserModel();
				$newData = [
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'username' => $username,
					'role' => "admin",
					'password' => $this->request->getVar('password'),
				];
				$model->save($newData);
				$session = session();
				
				$session->setFlashdata('success', 'Admin Berhasil ditambahkan');
				return redirect()->to('/members/add_admin');
			}
		}
		$data['title'] = "Tambah Anggota";
		echo view('templates/header', $data);
		echo view('members/add_admin');
		echo view('templates/footer');
	}
	public function add(){
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'nis' => 'required|numeric|is_unique[anggota.nis]',
				'fullname' => 'required',
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new MemberModel();

				$newData = [
					'nis' => $this->request->getVar('nis'),
					'fullname' => $this->request->getVar('fullname'),
					'phone' => $this->request->getVar('phone'),
					'email' => $this->request->getVar('email'),
				];
				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Data anggota berhasil ditambahkan');
				return redirect()->to(current_url());
			}
		}
		$data['title'] = "Tambah Anggota";
		echo view('templates/header', $data);
		echo view('members/add');
		echo view('templates/footer');
	}
	public function delete(int $id){
		$data = [];
		helper(['form']);

		$model = new MemberModel();
		$session = session();

		if($model->find($id)) {
			$model->delete($id);
			$session->setFlashdata('success', 'Data anggota berhasil dihapus');
		}else 
			$session->setFlashdata('error', 'Error Delete!');

		return redirect()->to(previous_url());
	}

	public function edit($id){
		$data = [];
		helper(['form']);

		$model = new MemberModel();
		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'nis' => 'required|numeric',
				'fullname' => 'required',
				'phone' => 'required|numeric',
				'email' => 'required|valid_email',
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$newData = [
					'id' => $this->request->getPost('id'),
					'nis' => $this->request->getPost('nis'),
					'fullname' => $this->request->getPost('fullname'),
					'phone' => $this->request->getPost('phone'),
					'email' => $this->request->getPost('email'),
				];
				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Data anggota telah diubah!');
				return redirect()->to(current_url());

			}
		}
		//$data['title'] = "Ubah Data Anggota";
		$data['user'] = $model->where('id', $id)->first();
		echo view('templates/header', $data);
		echo view('members/edit');
		echo view('templates/footer');
	}

	public function findMember(){
		$data = [];
		$model = new MemberModel();
		$id = $this->request->getPost('id');
		if($model->where('nis', $id)->first()){
			$member = $model->where('nis', $id)->first();
			echo  $member['fullname'];
		}
		else{
			echo "tidak ditemukan";
		}
	}

	public function denda()
	{
		$data = [];
		helper(['form']);

		$db      = \Config\Database::connect();
		$builder = $db->query('SELECT peminjaman.id,peminjaman.member_id, anggota.fullname,anggota.email, katalog.judul, katalog.ISBN, tanggal_pinjam,tanggal_kembali FROM peminjaman,anggota,katalog WHERE peminjaman.member_id = anggota.nis AND peminjaman.book_id = katalog.id');
		//$data['title'] = "List Anggota";
		$data['denda'] = $builder->getResult('array');
		echo view('templates/header', $data);
		echo view('members/denda');
		echo view('templates/footer');
	}

	public function delete_denda(int $id){
		$model = new PinjamanModel();
		$session = session();
		if($model->find($id)) {
			$model->delete($id);
			$session->setFlashdata('success', 'Denda telah dibayar!');
		}else 
			$session->setFlashdata('error', 'Error Delete!');

		return redirect()->to(previous_url());
	}

	//--------------------------------------------------------------------

}
