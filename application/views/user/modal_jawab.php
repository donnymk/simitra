<form action="<?= site_url().'index.php/user/pengajuan/'; ?>user" method="post" enctype="multipart/form-data"><center>
<table>
    <tr>
        <th>Surat rekomendasi</th>
        <th><input type=hidden name="id_pengajuan" value=<?= $_POST['id_pengajuan'] ?>>
        <input type=file name="surat_rekomendasi" accept=".doc, .docx" required></th>
    </tr>
    <tr>
        <td><strong>Keterangan</strong></td><td><textarea class="form-control" rows="4" name=ket cols="50" required></textarea></td>
    </tr>
    </table><br/>
    <button class="btn btn-danger" type="submit" name="jawab"><span class='glyphicon glyphicon-send' aria-hidden='true'></span> Kirim</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button></center>
</form>