<!--<style type="text/css">
img{
    max-width:100%;
}
</style>-->
<table class="table">
    <tr>
        <th>Ruang Kelas</th> 
        <th>Asrama</th>
        <th>Ruang Makan</th>
        <th>Lapangan</th>
        <th>Kamar Mandi dan Toilet</th>
    </tr>
<?php
    $foto = $this->Model_user->tampil_foto_pengajuan()->result_array();

    foreach($foto as $row){
        //tampilkan foto
//        if(!file_exists($row['foto1']) && !file_exists($row['foto2']) && !file_exists($row['foto3']) && !file_exists($row['foto4']) && !file_exists($row['foto5'])){
//            echo"<center>Tidak ada foto</center>";
//        }
//        else{
//            if(file_exists($row['foto1'])){
//                echo '<img src="'.site_url().$row['foto1'].'">';
//            }
//            if(file_exists($row['foto2'])){
//                echo '<br><br><img src="'.site_url().$row['foto2'].'">';
//            }
//            if(file_exists($row['foto3'])){
//                echo '<br><br><img src="'.site_url().$row['foto3'].'">';
//            }
//            if(file_exists($row['foto4'])){
//                echo '<br><br><img src="'.site_url().$row['foto4'].'">';
//            }
//            if(file_exists($row['foto5'])){
//                echo '<br><br><img src="'.site_url().$row['foto5'].'">';
//            }
//        }
        echo '<tr>
        <td>'.$row['foto1'].'</td> 
        <td>'.$row['foto2'].'</td>
        <td>'.$row['foto3'].'</td>
        <td>'.$row['foto4'].'</td>
        <td>'.$row['foto5'].'</td>
    </tr>';
    }
    ?>
</table>