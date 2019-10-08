<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // Your own constructor code
    }

    public function index(){
	if (!isset($_SESSION['user_bidang'])){
             $this->load->view('login_bidangg');
        }
        else{
            $data['bidang']=$this->Model_user->login_user()->result();
            $data['aktif_menu1_0']='active';
            $data['aktif_menu1_1']='active';
            $data['aktif_menu1_2']='disabled';
            $data['aktif_menu2_0']='';
            $this->load->view('user/portal',$data);
        }
    }

    public function cek_login_bidang(){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $userbidang = $this->Model_user->cek_user_bidang($username,$password)->row_array();
        $databidang = $this->Model_user->cek_user_bidang($username,$password)->result();
        if($userbidang==0){
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Warning!</strong> Username dan / atau password salah.</div>';
        }
        else{
            $_SESSION['user_bidang'] = $username;
            foreach ($databidang as $data){
                $_SESSION['nama_bidang'] = $data -> nama;
            }
            echo "ok";
        }
    }
    
// --------------------------------------------------------------------------
// Pengajuan Proposal
// --------------------------------------------------------------------------
    
    public function pengajuan(){
        //$data['bidang'] = $this->Model_user->login_user()->result();
        $data['kabkota'] = $this->Model_user->tampil_kabkota()->result_array();
        $data['aktif_menu1_0']='active';
        $data['aktif_menu1_1']='active';
        $data['aktif_menu1_2']='disabled';
        $data['aktif_menu2_0']='';
        $data['aktif_menu2_1']='';
        $data['aktif_menu2_2']='';            
        $this->load->view('user/header', $data);
        $this->load->view('user/pilih_pengajuan', $data);
        $this->load->view('user/footer');
    }

    public function modal_jawab(){
        $this->load->view('user/modal_jawab');
    }

    public function modal_lihat_foto(){
        $this->load->view('user/modal_lihat_foto');
    }

    public function download_excel(){
        if(isset($_POST['download_excel'])){
        	//Mulai memorises data
            $id_pengajuan=$_POST['id_pengajuan'];

            //cek apakah file excel sudah diupload
            $download_excel=$this->Model_user->download_excel($id_pengajuan)->result_array();

            //jika hasil kosong berarti belum diupload. Tampil pesan error
            if ($this->Model_user->download_excel($id_pengajuan)->num_rows()==0){
            ?>
            <div class=container><label>Daftar peserta belum diupload Kab / Kota</label>
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
        		location.replace('".site_url().$dok."')</script>";
            }
        }
    }

    public function unggah_sttpp(){
        $data['bidangteknis']=$this->Model_user->login_user()->result();
        $data['aktif_menu1_0']='active';
        $data['aktif_menu1_1']='';
        $data['aktif_menu1_2']='active';
        $data['aktif_menu2_0']='';
        $data['aktif_menu2_1']='';
        $data['aktif_menu2_2']='';          
    	$this->load->view('user/header',$data);
        $this->load->view('user/unggah_sttpp',$data);
        $this->load->view('user/footer');
    }
    
// --------------------------------------------------------------------------
// Usulan Uji Kompetensi
// --------------------------------------------------------------------------
    
    public function lihat_usulanujikomp(){
//            $data['bidang']=$this->Model_user->login_user()->result();
            $data['usulanujikomp'] = $this->Model_user->lihat_usulanujikomp()->result_array();
            $data['jmlbaris'] = $this->Model_user->lihat_usulanujikomp()->num_rows();
            $data['aktif_menu1_0']='';
            $data['aktif_menu1_1']='';
            $data['aktif_menu1_2']='disabled';
            $data['aktif_menu1_3']='';
            $data['aktif_menu2_0']='active';
            $data['aktif_menu2_1']='active';
            $data['aktif_menu2_2']='';
            $this->load->view('user/header',$data);
            $this->load->view('user/lihat_usulanujikomp',$data);
            $this->load->view('user/footer');
    }
    
    public function kelola_jft(){
//            $data['bidang']=$this->Model_user->login_user()->result();
            $data['jenisujikomp'] = $this->Model_kabkota->load_jenisujikomp()->result();
            $data['aktif_menu1_0']='';
            $data['aktif_menu1_1']='';
            $data['aktif_menu1_2']='disabled';
            $data['aktif_menu1_3']='';
            $data['aktif_menu2_0']='active';
            $data['aktif_menu2_1']='';
            $data['aktif_menu2_2']='active';
            $this->load->view('user/header',$data);
            $this->load->view('user/lihat_jft',$data);
            $this->load->view('user/footer');
    }
    
    //halaman tambah data Jabatan
    public function tambah_jft(){
        $data['jenisujikomp'] = $this->Model_kabkota->load_jenisujikomp()->result();
        $data['aktif_menu1_0']='';
        $data['aktif_menu1_1']='';
        $data['aktif_menu1_2']='disabled';
        $data['aktif_menu1_3']='';
        $data['aktif_menu2_0']='active';
        $data['aktif_menu2_1']='';
        $data['aktif_menu2_2']='active';                
        $this->load->view('user/header',$data);
        $this->load->view('user/form_jft',$data);
        $this->load->view('user/footer');
    }
    
    //insert data Jabatan
    public function input_jabatan(){
        $go = $this->Model_user->simpan_jabatan();
        if($go){
          redirect('index.php/user/kelola_jft');  
        }
        else{
            echo $go;
        }        
    }
    
    //muat data jabatan dan jenjang berdasarkan jenis uji kompetensi
    public function load_jabatannjenjang(){
        $jenisujikomp = $this->input->post('jenisujikomp');
        $jabatan = $this->Model_user->load_jabatannjenjang($jenisujikomp)->result();
        $hasil = [];
        //tampilkan hasilnya dalam format JSON
        foreach ($jabatan as $obj){
            array_push($hasil,
                array(
                    "namajabatan" => $obj -> nama_jabatan, 
                    "jenjang" => $obj -> nama_jenjang)
                );
        }
        echo json_encode($hasil);
    }
    
    //delete data uji kompetensi dan pesertanya
    public function del_usulan_ujikomp(){
        $idusulanujikomp = $this->uri->segment(3);
        $del = $this->Model_kabkota->del_usulan_ujikomp($idusulanujikomp);
        //jika berhasil delete
        if($del){
            redirect('index.php/user/lihat_usulanujikomp'); 
        }
        else{
            echo $del;
        }
    }

    public function logout(){
        //session_start();
        $_SESSION['user_bidang'] = null;
        $_SESSION['nama_bidang'] = null;
        redirect(site_url('index.php/user')); // Langsung mengarah ke Home index.php
    }

}