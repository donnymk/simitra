<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // Your own constructor code
    }

    public function login(){
        if (!isset($_SESSION['user_admin'])){
            $this->load->view('login_admin');
            return false;
        }
        else{
            return true;
        }
    }

	public function index(){
	    if ($this->login()==true){
                $data['admin']=$this->Model_admin->login_admin()->result();
                $data['aktif_menu1_0']='active';
                $data['aktif_menu1_1']='active';
                $data['aktif_menu1_2']='disabled';
                $data['aktif_menu2_0']='';
                $this->load->view('admin/header',$data);
                $this->load->view('admin/pilih_pengajuan',$data);
                $this->load->view('admin/footer');
            }
	}

    public function cek_login_admin(){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $bidangteknis = $this->Model_admin->cek_admin($username,$password)->row_array();
        if($bidangteknis==0){
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Warning!</strong> Username dan / atau password salah.</div>';
        }
        else{
            $_SESSION['user_admin'] = $username;
            echo "ok";
        }
    }

    public function modal_jawab(){
        $this->load->view('admin/modal_jawab');
    }

    public function modal_lihat_foto(){
        $this->load->view('admin/modal_lihat_foto');
    }

    public function download_excel(){
        if(isset($_POST['download_excel'])){
        	//Mulai memorises data
            $id_pengajuan=$_POST['id_pengajuan'];

            //cek apakah file excel sudah diupload
            $download_excel=$this->Model_admin->download_excel($id_pengajuan)->result_array();

            //jika hasil kosong berarti belum diupload. Tampil pesan error
            if ($this->Model_admin->download_excel($id_pengajuan)->num_rows()==0){
            ?>
            <div class=container><label>Daftar peserta belum diupload</label>
                 <form action=''>
                <input type='button' class='btn btn-primary' onclick='self.close()' value='Tutup'>
                </form>
            </div>
            <?php
            }
            //jika ada langsung dialihkan ke url file excel untuk didownload
            else{
                foreach($download_excel as $row){
                	$id_pengajuan = $row['id_pengajuan'];
                    $dok = $row['dok'];
                }
        		echo "<script>
        		location.replace('". site_url().$dok."')</script>";
            }
        }
    }

    public function unggah_sttpp(){
        if ($this->login()==true){
            $data['admin']=$this->Model_admin->login_admin()->result();
            $data['aktif_menu1_0']='active';
            $data['aktif_menu1_1']='';
            $data['aktif_menu1_2']='active';
            $data['aktif_menu2_0']='';
            $this->load->view('admin/header',$data);
            $this->load->view('admin/unggah_sttpp',$data);
            $this->load->view('admin/footer');
        }
    }

    public function hapus_pengajuan(){
        //tangkap variabel yang akan digunakan untuk operasi hapus file dan database
        $id_pengajuan=$_GET['id'];

        //cari dokumen sttpp, kemudian hapus dokumen sttpp, setelah itu hapus dari database
        $caristtpp=$this->Model_admin->cari_sttpp($id_pengajuan)->result_array();
        foreach($caristtpp as $row){
            //$id_pengajuan = $row['id_pengajuan'];
            $dok_sttpp = $row['dok_sttpp'];
            unlink($dok_sttpp);
        }
        $this->Model_admin->delete_sttpp($id_pengajuan);

        //cari dokumen peserta, kemudian hapus dokumen peserta, setelah itu hapus dari database
        $caridokpeserta=$this->Model_admin->cari_dokpeserta($id_pengajuan)->result_array();
        foreach($caridokpeserta as $row){
            //$id_pengajuan = $row['id_pengajuan'];
            $dok = $row['dok'];
            unlink($dok);
        }
        $this->Model_admin->delete_dokpeserta($id_pengajuan);

        //cari rekomendasi, kemudian hapus dokumen rekomendasi, setelah itu hapus dari database
        $carirekomendasi=$this->Model_admin->cari_surat_rekomendasi($id_pengajuan)->result_array();
        foreach($carirekomendasi as $row){
            //$id_pengajuan = $row['id_pengajuan'];
            $surat = $row['surat'];
            if($surat!=NULL){
                unlink($surat);
            }
        }
        $this->Model_admin->delete_surat_rekomendasi($id_pengajuan);

        //cari pengajuan_detail, kemudian hapus foto, setelah itu hapus dari database
        $caripengajuan_detail=$this->Model_admin->cari_pengajuan_detail($id_pengajuan)->result_array();
        foreach($caripengajuan_detail as $row){
            //$id_pengajuan = $row['id_pengajuan'];
            $foto1 = $row['foto1'];
            $foto2 = $row['foto2'];
            $foto3 = $row['foto3'];
            $foto4 = $row['foto4'];
            $foto5 = $row['foto5'];
            if(file_exists($foto1)){
                unlink($foto1);
            }
            if(file_exists($foto2)){
                unlink($foto2);
            }
            if(file_exists($foto3)){
                unlink($foto3);
            }
            if(file_exists($foto4)){
                unlink($foto4);
            }
            if(file_exists($foto5)){
                unlink($foto5);
            }

        }
        $this->Model_admin->delete_pengajuan_detail($id_pengajuan);

        //cari pengajuan, kemudian hapus dokumen pengajuan, setelah itu hapus dari database//$caripengajuan=mysqli_query($koneksi,"SELECT proposal, dok_lain FROM pengajuan WHERE id_pengajuan='".$id_pengajuan."'");
        $caripengajuan=$this->Model_admin->cari_pengajuan($id_pengajuan)->result_array();
        foreach($caripengajuan as $row){
            $proposal = $row['proposal'];
            $dok_lain = $row['dok_lain'];
            unlink($proposal);
            if($dok_lain!=""){
                unlink($dok_lain);
            }
        }
        $this->Model_admin->delete_pengajuan($id_pengajuan);
        redirect(site_url().'index.php/admin');
    }

    public function pengaturan(){
        if ($this->login()==true){
            $data['admin']=$this->Model_admin->login_admin()->result();
            $data['aktif_menu1_0']='';
            $data['aktif_menu1_1']='';
            $data['aktif_menu1_2']='disabled';
            $data['aktif_menu2_0']='';
        	$this->load->view('admin/header',$data);
            $this->load->view('admin/pengaturan',$data);
            $this->load->view('admin/footer');
        }
    }

    public function save_kabkota(){
        $kabkota=$_POST['kabkota'];
        $namakabkota=$_POST['namakabkota'];
        $nama=$_POST['nama'];
        $password=$_POST['password'];

        $cek_kabkota=$this->Model_admin->cek_kabkota($kabkota,$namakabkota)->num_rows();

        if($cek_kabkota!=0){
        	echo "<script>alert('Maaf, $kabkota $namakabkota sudah terdaftar');
            location.replace('pengaturan');
            </script>";
            //redirect();
        }
        else{
	        // Simpan ke Database
            $this->Model_admin->save_kabkota($nama,$password,$kabkota,$namakabkota);
		    redirect(site_url('admin/pengaturan'));
	    }
    }

    public function save_user(){
        $nama=$_POST['nama'];
        $user=$_POST['user'];
        $password=$_POST['password'];

        $cek_user=$this->Model_admin->cek_user($user)->num_rows();

        if($cek_user!=0){
        	echo "<script>alert('Maaf, User $user sudah terdaftar')
        	location.replace('pengaturan')</script>";
        }
        else{
            // Memasukkan data ke dalam tabel //
            $this->Model_admin->save_user($user,$password,$nama);
            redirect(site_url('admin/pengaturan'));
        }
    }

    public function update_kabkota(){
        $id_kabkota=$_POST['id_kabkota'];
        $user=$_POST['user'];
        $password=$_POST['password'];
        $this->Model_admin->update_kabkota($id_kabkota,$user,$password);
        redirect(site_url('admin/pengaturan'));
    }

    public function update_user(){
        $id_user=$_POST['id_user'];
        $nama=$_POST['nama'];
        $user=$_POST['user'];
        $password=$_POST['password'];
        $this->Model_admin->update_user($id_user,$nama,$user,$password);
        redirect(site_url('index.php/admin/pengaturan'));
    }

    public function update_admin(){
        $id_admin=$_POST['id_admin'];
        $user=$_POST['user'];
        $password=$_POST['password'];
        $this->Model_admin->update_admin($id_admin,$user,$password);
        redirect(site_url('admin/pengaturan'));
    }

    public function logout(){
        //session_start();
        $_SESSION['user_admin'] = null;
        redirect(site_url('index.php/admin'));
    }
}