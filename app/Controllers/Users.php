<?php namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MemberModel;

class Users extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'username' => 'required|min_length[3]|max_length[100]',
				'password' => 'required|min_length[8]|max_length[255]|validateUser[username,password]',
			];

			$errors = [
				'password' => [
					'validateUser' => 'Username or Password don\'t match'
				]
			];

			if (! $this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new UserModel();

				$user = $model->where('username', $this->request->getVar('username'))
											->first();

				$userauth = $this->setUserSession($user);
				//$session->setFlashdata('success', 'Successful Registration');
				if ($userauth==true){
					return redirect()->to('dashboard');
				}
				else{
					return redirect()->to('/login?msg='+$userauth);
				}

			}
		}

		$data['title'] = "Login";
		echo view('templates/header', ['title' => 'Login']);
		echo view('login', $data);
		echo view('templates/footer');
	}
	public function landingpage(){
		echo view('landingpage');
	}

	private function setUserSession($user){
		if($user['id']==1)
		{
			$data = [
				'id' => $user['id'],
				'firstname' => $user['firstname'],
				'lastname' => $user['lastname'],
				'username' => $user['username'],
				'isLoggedIn' => true,
			];
		}
			
		  else{
			$data = [];
			$model = new MemberModel();
			if($model->where('email',  $user['username'])->first()){
				if($member = $model->where('email',  $user['username'])->first()){
				$nis = $member['nis'];
				$data = [
					'id' => $user['id'],
					'nis' => $nis,
					'firstname' => $user['firstname'],
					'lastname' => $user['lastname'],
					'username' => $user['username'],
					'isLoggedIn' => true,
				];
				}
				else{
					return "maaf email dan passsword salah gunakan email terbaru yang terakhir teregister apabila tetap error maka register baru dengan email baru";
				}
			}
			else{
				return "maaf email dan passsword salah gunakan email terbaru yang terakhir teregister apabila tetap error maka register baru dengan email baru";
				
			}
			
		  }
			
		session()->set($data);
		return true;
	}

	public function register()
	{
		$data = [];
		helper(['form']);
		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
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
				$model = new UserModel();
				$username =  $this->request->getVar('username');
				$newData = [
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'username' => $username,
					'password' => $this->request->getVar('password'),
				];
				
				$nis = $this->request->getVar('member_id');
				$model->save($newData);
				$session = session();
				$data = [];
				$anggota = new MemberModel();
				
				if($anggota->where("nis",$nis)
				->set('email',$username)
				->update()){
					$anggota->where("nis",$nis)
					->set('email',$username)
					->update();
				}
				else{
					echo "server error";
				}
				$session->setFlashdata('success', 'Successful Registration');
				return redirect()->to('/login');

			}

		}
		$data['title'] = "Register";
		
		$model = new MemberModel();
		$anggota = $model->findAll();
		$data['anggota'] = $anggota;

		
		echo view('templates/header', $data);
		echo view('register', $data);
		echo view('templates/footer');
	}

	public function profile(){
		$data = [];
		helper(['form']);
		$model = new UserModel();
		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'firstname' => 'required|min_length[3]|max_length[20]',
				'lastname' => 'required|min_length[3]|max_length[20]',
			];

			if($this->request->getPost('password') != '') {
				$rules['password'] = 'required|min_length[8]|max_length[255]';
				$rules['password_confirm'] = 'matches[password]';
			}

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$newData = [
					'id' => session()->get('id'),
					'firstname' => $this->request->getPost('firstname'),
					'lastname' => $this->request->getPost('lastname'),
				];
				if($this->request->getPost('password') != '') {
					$newData['password'] = $this->request->getPost('password');
				}
				//Edit sessions
				session()->set('firstname', $this->request->getPost('firstname'));
				$model->save($newData);
				session()->setFlashdata('success', 'Data berhasil diubah');
				return redirect()->to('/profile');
			}
		}
		$data['title'] = "Edit Profile";
		$data['user'] = $model->where('id', session()->get('id'))->first();
		echo view('templates/header', $data);
		echo view('profile');
		echo view('templates/footer');

	}

	public function logout() {
		session()->destroy();
		return redirect()->to('/');
	}
	//--------------------------------------------------------------------

}
