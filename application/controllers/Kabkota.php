<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabkota extends CI_Controller {
    public function __construct(){
        parent::__construct();
        // Your own constructor code
        //ini_set('session.cookie_domain', '.com/.local/');
    }

    public function login(){
        if (!isset($_SESSION['kodeuser'])){
            $this->load->view('login_kontributor');
            return false;
        }
        else{
            return true;
        }
    }

    public function index(){
        if ($this->login()==true){
            $data['kodeuser'] = $_SESSION['kodeuser'];            
            $data['user']=$this->Model_kabkota->login_kabkota()->result();
            $this->load->view('kabkota/portal',$data);
        }
    }
    
    public function cek_session(){
        echo session_id();
    }
    
    public function cek_login(){
        $username_submit = $this->input->post('username');
        $password_submit = $this->input->post('password');
        //$kabkota = $this->Model_kabkota->cek_kabkota($username,$password)->row_array();
        $user = $this->Model_kabkota->cek_user($username_submit)->result();
        
        $notifikasi = '<div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong> Username dan / atau password salah.</div>';
        
        //jika username ada
        if(count($user) != 0){
            foreach ($user as $obj){
                $password_hash = $obj -> password;
                $iduser = $obj -> id;
                $kontributor = $obj -> nama;
                $jenis_user = $obj -> jenis_user;
            }
            //jika password benar
            if ($password_hash === crypt($password_submit ,$password_hash)){
                //tetapkan session  
                $_SESSION['iduser'] = $iduser;
                $_SESSION['kodeuser'] = $username_submit;
                $_SESSION['kontributor'] = $kontributor;
                $_SESSION['jenis_user'] = $jenis_user;
                $notifikasi = "ok";                
            }
        }
        echo $notifikasi;
    }

    public function pengajuan(){
        if ($this->login()==true){
            $data['user']=$this->Model_kabkota->login_kabkota()->result();
            $data['aktif_menu1_0']='active';
            $data['aktif_menu1_1']='active';
            $data['aktif_menu1_2']='disabled';
            $data['aktif_menu1_3']='';
            $data['aktif_menu2_0']='';
            $this->load->view('kabkota/header',$data);
            $this->load->view('kabkota/pengajuan',$data);
            $this->load->view('kabkota/footer');
        }
    }    
    
    public function modal_balasan(){
        $this->load->view('kabkota/modal_balasan');
    }

    public function menu_unggah_peserta(){
        if ($this->login()==true){
            $data['user']=$this->Model_kabkota->login_kabkota()->result();
            $data['aktif_menu1_0']='active';
            $data['aktif_menu1_1']='';
            $data['aktif_menu1_2']='active';
            $data['aktif_menu1_3']='';
            $data['aktif_menu2_0']='';
            $this->load->view('kabkota/header',$data);
            $this->load->view('kabkota/unggah_peserta',$data);
            $this->load->view('kabkota/footer');
        }
    }

    public function lihat_sttpp(){
        if ($this->login()==true){
            $data['user']=$this->Model_kabkota->login_kabkota()->result();
            $data['aktif_menu1_0']='active';
            $data['aktif_menu1_1']='';
            $data['aktif_menu1_2']='disabled';
            $data['aktif_menu1_3']='active';
            $data['aktif_menu2_0']='';
            $this->load->view('kabkota/header',$data);
            $this->load->view('kabkota/lihat_sttpp',$data);
            $this->load->view('kabkota/footer');
        }
    }
    
    //halaman form usulan uji kompetensi
    public function usulan_uji_komp(){
        if ($this->login()==true){
            $data['user']=$this->Model_kabkota->login_kabkota()->result();
            $data['jenisujikomp'] = $this->Model_kabkota->load_jenisujikomp()->result();
            $data['aktif_menu1_0']='';
            $data['aktif_menu1_1']='';
            $data['aktif_menu1_2']='disabled';
            $data['aktif_menu1_3']='';
            $data['aktif_menu2_0']='active';
            $this->load->view('kabkota/header',$data);
            $this->load->view('kabkota/form_uji_komp',$data);
            $this->load->view('kabkota/footer');
            
        }
    }
    
    public function lihat_usulanujikomp(){
        if ($this->login()==true){
            $data['user']=$this->Model_kabkota->login_kabkota()->result();
            $data['usulanujikomp'] = $this->Model_kabkota->lihat_usulanujikomp()->result_array();
            $data['jmlbaris'] = $this->Model_kabkota->lihat_usulanujikomp()->num_rows();            
            $data['aktif_menu1_0']='';
            $data['aktif_menu1_1']='';
            $data['aktif_menu1_2']='disabled';
            $data['aktif_menu1_3']='';
            $data['aktif_menu2_0']='active';
            $this->load->view('kabkota/header',$data);
            $this->load->view('kabkota/lihat_usulanujikomp',$data);
            $this->load->view('kabkota/footer');
        }
    }
    
    //muat data jabatan berdasarkan jenis uji kompetensi
    public function load_jabatan(){
        $jenisujikomp = $this->input->post('jenisujikomp');
        $jabatan = $this->Model_kabkota->load_jabatan($jenisujikomp)->result();
        foreach ($jabatan as $obj){
            echo '<option value="'.$obj -> id_jabatan.'">'.$obj -> nama_jabatan.'</td>';
        }
    }
    
    //muat data jenjang berdasarkan nama jabatan
    public function load_jenjang(){
        $idjabatan = $this->input->post('idjabatan');
        $jenjang = $this->Model_kabkota->load_jenjang($idjabatan)->result();
        foreach ($jenjang as $obj){
            echo '<option value="'.$obj -> id_penjenjangan.'">'.$obj -> nama_jenjang.'</td>';
        }
    }
    
    //muat data peserta uji kompetensi
    public function load_peserta_ujikomp(){
        $idusulanujikomp = $this->input->post('idusulanujikomp');
        $peserta = $this->Model_kabkota->load_peserta_ujikomp($idusulanujikomp)->result();
        $no = 0;
        foreach ($peserta as $obj){
            $no++;
            echo '<tr>'
                    . '<td>'.$no.'</td>'
                    . '<td>'.$obj -> nip.'</td>'
                    . '<td>'.$obj -> nama.'</td>'
                    . '<td>'.$obj -> jabatan.'</td>'
                    . '<td>'.$obj -> opd.'</td>'
                    . '</tr>';
        }
    }
    
    
    //delete data uji kompetensi dan pesertanya
    public function del_usulan_ujikomp(){
        $idusulanujikomp = $this->uri->segment(3);
        $del = $this->Model_kabkota->del_usulan_ujikomp($idusulanujikomp);
        //jika berhasil delete
        if($del){
            redirect('index.php/kabkota/lihat_usulanujikomp'); 
        }
        else{
            echo $del;
        }
    }
    
    //masukkan data usulan kompetensi jabatan beserta pesertanya ke dalam database
    function input_usulanujikomp(){
        $go = $this->Model_kabkota->simpan_usulanujikomp();
        if($go){
          redirect('index.php/kabkota/lihat_usulanujikomp');  
        }
        else{
            echo $go;
        }
    }
    
    //ambil data PNS Kab / Kota dari web service
    function get_datapns_kabkota(){
        $nip = $this->input->post('nip');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://simpeg.bkd.jatengprov.go.id/webservice/identitas_kabkota");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "nip=".$nip."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        //$decode = json_decode($result);
        echo $result;
    }
    
    //ambil data PNS Pemprov dari web service
    function get_datapns_pemprov(){
        $nip = $this->input->post('nip');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://simpeg.bkd.jatengprov.go.id/webservice/identitas/");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "nip=".$nip."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        //$decode = json_decode($result);
        echo $result;
    }

    public function logout(){
        //session_start();
        $_SESSION['kodeuser'] = null;
        redirect(base_url()); // Langsung mengarah ke Home index.php
    }
}