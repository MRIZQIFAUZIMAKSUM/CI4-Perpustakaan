<?php namespace App\Controllers;

use App\Models\KatalogModel;
use App\Models\PinjamanModel;
use App\Models\buku_dataset;
use App\Models\KategoriModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Fpdf\Fpdf;

class KatalogBuku extends BaseController
{
	public function index()
	{
		$data = [];
		helper(['form']);

		$model = new buku_dataset();
		$buku = $model->findAll();

		$data['buku'] = $buku;
	
		$model = new KategoriModel();
		$kategori = $model->findAll();

		$data['kategori'] = $kategori;

		echo view('templates/header', $data);
		echo view('katalog/list');
		echo view('templates/footer');
	}

	public function add(){
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'ISBN' => 'required|is_unique[katalog.ISBN]',
				'judul' => 'required',
				'pengarang' => 'required',
				'penerbit' => 'required',
				'tahun_terbit' => 'required|numeric|exact_length[4]',
				'kategori' => 'required',
				'eksemplar' => 'required|numeric',
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new KatalogModel();

				$newData = [
					'ISBN' => $this->request->getVar('ISBN'),
					'judul' => $this->request->getVar('judul'),
					'pengarang' => $this->request->getVar('pengarang'),
					'penerbit' => $this->request->getVar('penerbit'),
					'tahun_terbit' => $this->request->getVar('tahun_terbit'),
					'kategori' => $this->request->getVar('kategori'),
					'eksemplar' => $this->request->getVar('eksemplar'),
				];
				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Data buku berhasil ditambahkan ke katalog <a href="list">Kembali ke list</a>');
				return redirect()->to(current_url());

			}
		}
		$data['title'] = "Tambah Katalog";
		echo view('templates/header', $data);
		echo view('katalog/add');
		echo view('templates/footer');
	}

	public function delete(int $id){
		$data = [];
		helper(['form']);

		$model = new KatalogModel();
		$session = session();

		if($model->find($id)) {
			$model->delete($id);
			$session->setFlashdata('success', 'Data katalog berhasil dihapus');
		}else 
			$session->setFlashdata('error', 'Error Delete!');

		return redirect()->to(previous_url());
	}

	public function edit($id){
		$data = [];
		helper(['form']);

		$model = new KatalogModel();
		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'kategori' => 'required',
				'eksemplar' => 'required|numeric',
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$newData = [
					'id' => $this->request->getPost('id'),
					'kategori' => $this->request->getPost('kategori'),
					'eksemplar' => $this->request->getPost('eksemplar'),
				];
				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Data katalog telah diubah! <a href="../list">Kembali ke list</a>');
				return redirect()->to(current_url());

			}
		}
		//$data['title'] = "Ubah Data Anggota";
		$data['buku'] = $model->where('id', $id)->first();
		echo view('templates/header', $data);
		echo view('katalog/edit');
		echo view('templates/footer');
	}

	public function pinjam(){
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'ISBN' => 'required',
				'judul' => 'required',
				'fullname' => 'required',
				'member_id' => 'required',
			];

			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new PinjamanModel();

				$newData = [
					'book_id' => $this->request->getVar('book_id'),
					'member_id' => $this->request->getVar('member_id'),
				];
				$model->save($newData);
				$session = session();
				$session->setFlashdata('success', 'Data peminjaman buku telah ditambahkan! <a href="list">Kembali ke list</a>');
				return redirect()->to(current_url());

			}
		}
		echo view('templates/header', $data);
		echo view('katalog/pinjam');
		echo view('templates/footer');
	}

	public function kembali(){
		$data = [];
		helper(['form']);

		if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'ISBN' => 'required',
				'judul' => 'required',
				'fullname' => 'required',
				'member_id' => 'required',
			];
			if (! $this->validate($rules)) {
				$data['validation'] = $this->validator;
			}else{
				$model = new PinjamanModel();
				$session = session();
				$queries = ['book_id' => $this->request->getVar('book_id'), 'member_id' => $this->request->getVar('member_id')];
				if($model->where($queries)->delete()){
					$session->setFlashdata('success', 'Buku telah dikembalikan! <a href="list">Kembali ke list</a>');
				}else{
					$session->setFlashdata('error', 'Error occured!');
				}
				return redirect()->to(current_url());
			}
		}
		echo view('templates/header', $data);
		echo view('katalog/kembali');
		echo view('templates/footer');
	}

	public function findBook(){
		$data = [];
		$model = new buku_dataset();
		$id = $this->request->getPost('ISBN');
		$book = $model->where('ISBN', $id)->first();
		echo "[\"$book[judul]\", $book[id]]";
	}

	public function list_pinjam()
	{
		$data = [];
		helper(['form']);
		//$model = new PinjamanModel();
		$db      = \Config\Database::connect();
		$role = session()->get('role');
		if (session()->get('role') == 'admin'){
		   $builder = $db->query('SELECT peminjaman.id, anggota.fullname, katalog.judul, katalog.ISBN, tanggal_pinjam, tanggal_kembali, peminjaman.status FROM peminjaman JOIN anggota ON anggota.nis = peminjaman.member_id JOIN katalog ON katalog.id = peminjaman.book_id');
		}
		else {
		   $nis = session()->get('nis');
		   $builder = $db->query('SELECT peminjaman.id, anggota.fullname, katalog.judul, katalog.ISBN, tanggal_pinjam, tanggal_kembali, peminjaman.status FROM peminjaman JOIN anggota ON anggota.nis = peminjaman.member_id JOIN katalog ON katalog.id = peminjaman.book_id where peminjaman.member_id = '.$nis);
		}
		//$data['title'] = "List Anggota";
		$data['pinjaman'] = $builder->getResult();
		echo view('templates/header', $data);
		echo view('katalog/daftar_pinjaman');
		echo view('templates/footer');
	}
	public function tolak(int $id)
	{
		$data = [];
		
		helper(['form']);
		$peminjaman = new PinjamanModel();
		if($peminjaman->where("id",$id)
				->set('status',2)
				->update()){
					$peminjaman->where("id",$id)
					->set('status',2)
					->update();
				}
		return redirect()->to(previous_url());
	}
	public function izinkan(int $id)
	{
		$data = [];
		helper(['form']);
		
		$peminjaman = new PinjamanModel();
		
		if($peminjaman->where("id",$id)
				->set('status',1)
				->update()){
					$peminjaman->where("id",$id)
					->set('status',1)
					->update();
				}
		return redirect()->to(previous_url());
	}
	public function kirimDenda()
	{
		
		$nama_penerima = $this->request->getPost('nama_penerima');
		$judul_buku = $this->request->getPost('judul_buku');
		$tanggal_pinjam =  $this->request->getPost('tanggal_pinjam');
		$tanggal_kembali = $this->request->getPost('tanggal_kembali');
		$jml_hari = $this->request->getPost('jml_hari');
		$jml_denda = $this->request->getPost('jml_denda');
		//$tgl_sekarang ="3-08-2023"; //$this->request->getPost('tgl_sekarang');
		$email_siswa = "fauzimaksum30@gmail.com";
		$mail = new PHPMailer(true);
		$session = session();
		try {
			// $pdf = new Fpdf();
			// $pdf->AddPage();
			// $pdf->SetFont('Arial','B',16);
			// $pdf->Cell(40,10,'tgl 1 +IO2000 tgl 2 +2000 total 4000');
			// $content = $pdf->Output('F','denda/'.$nama_penerima.$tgl_sekarang.'.pdf');
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'admpustakagamasmkn3tegal@gmail.com';                     //SMTP username
			$mail->Password   = 'heiyrjjoodxalobu';                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		
			//Recipients
			$mail->setFrom('admpustakagamasmkn3tegal@gmail.com', 'Admin Pustagama');
			$mail->addAddress($email_siswa, $nama_penerima);     //Add a recipient
			$mail->addAddress($email_siswa);               //Name is optional
			$mail->addReplyTo($email_siswa, 'Information');
			$mail->addCC($email_siswa);
			$mail->addBCC($email_siswa);
		
			//Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
			//$mail->addAttachment('denda/'.$nama_penerima.$tgl_sekarang.'.pdf', $nama_penerima.'.pdf');    //Optional name
		
			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'Keterlambatan Pengembalian Buku';
			$mail->Body    = 'Maaf Anda sudah Terlambat mengembalikan Buku <b>'.$judul_buku.'</b> yang dipinjam dari Tanggal : <b> '.$tanggal_pinjam.' </b> Sampai Tanngal : <b> '.$tanggal_kembali.' </b> yang berarti Anda Telat mengembalikan Buku Selama : <b> '.$jml_hari.' </b> maka Anda dikenakan Denda Sebesar : <b> RP.'.$jml_denda.'</b> Mohon untuk Segera dikembalikan Buku tersebut dan melunasi Denda Anda di <b> Perpustakaan SMKN 3 Tegal </b>';
		
			$mail->send();
			$mail->SMTPDebug = 0;
			$session->setFlashdata('success', 'Tagihan Telah Dikirim!');
			echo "<script language='javascript' type='text/javascript'>
			alert('Tagihan Telah Dikirim! silahkan kembali ke menu denda');
			window.location.href = '/members/denda';
		   </script>";
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
		
	}

	//--------------------------------------------------------------------

}
