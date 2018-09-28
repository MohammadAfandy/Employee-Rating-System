<?php

if($this->session->flashdata('add')) {  ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('add'); ?></strong> 
    </div>
<?php 
}elseif ($this->session->flashdata('delete')) { ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('delete'); ?></strong> 
    </div>
<?php
}elseif ($this->session->flashdata('edit')) { ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('edit'); ?></strong> 
    </div>
<?php
}

if ($this->session->userdata('akses') != 'admin'){
?>
<script>
    $(document).ready(function() {
        $('.btn-primary').prop('disabled', true);
    });
</script>
<?php
}
?>

	<div class="container">
		<div class="row" style="margin-top: 20px;">
			<section>
				<center><p><h2><b>Data Penilaian</p></h2></b></center>
				<a class="btn btn-success" data-toggle="modal" data-target="#modal_add_penilaian"> Tambah Data</a>
				<div class="row-fluid" style="margin-top: 20px">
				<table class='table table-hover table-bordered' id=example >
                	<thead>
						<tr>
							<th>No</th>
                            <th>Nama Pegawai</th>
                            <?php foreach ($kriteria as $k){ ?>
                                <th><?php echo $k->nama_kriteria; ?></th>
                            <?php } ?>
                            <th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$nomor = 0;
						foreach ($pegawaipenilaian as $pn){ ?>	
						<tr>
                            <td><?php echo $nomor=$nomor+1; ?></td>
                            <td><?php echo $pn->nama_pegawai; ?></td>

							<?php 
                            $query = $this->db->query("SELECT nilai from tb_penilaian where id_pegawai='$pn->id_pegawai'");
                            foreach ($query->result() as $nilai){
                            ?>
                                <td><?php echo $nilai->nilai; ?></td>
                            <?php } ?>
							<td>
                            <a class="btn btn-info btn-small" data-toggle="modal" data-target="#modal_edit_penilaian<?php echo $pn->id_penilaian; ?>"> Edit</a>
                            <button class="btn btn-danger btn-small" data-href="penilaian/delPenilaian/<?php echo $pn->id_pegawai; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</button> 
						</tr>
						<?php } ?>
					</tbody>
  				</table>
  				</div>   
<!-- <?php echo $this->db->last_query(); ?> -->
			</section>
		</div>
	</div>

<!-- ============ MODAL ADD penilaian =============== -->
        <div class="modal fade" id="modal_add_penilaian" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Data penilaian</h3>
            </div>
            <?php echo form_open('penilaian/addpenilaian', 'class="form-horizontal"'); ?>
                <div class="modal-body">
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >NIP | Nama</label>
                        <div class="col-xs-8">
                            <select name="id_pegawai" class="form-control" required>
                            <?php if ($jumlahnip > 0){
                                foreach ($ceknip as $c){ 
                                    echo "<option value='$c->id_pegawai;'>$c->nip | $c->nama_pegawai";   
                                }     
                            }else{
                                echo "<option value=''>-Tidak Ada Data Pegawai-";
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    
                    <?php foreach ($kriteria as $k){ ?>
                    <input name="<?php echo $k->id_kriteria; ?>" type="hidden" value="<?php echo $k->id_kriteria; ?>">
                    <div class="form-group">
                        <label class="control-label col-xs-3" ><?php echo $k->nama_kriteria; ?></label>
                        <div class="col-xs-3">
                            <input name="<?php echo 'c'.$k->id_kriteria; ?>" class="form-control" type="number" placeholder="Nilai..." max="100" required><i>
                        </div>Max (100)</i>
                    </div>
                    <?php } ?>
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
<!--END MODAL ADD penilaian-->


<!-- ============ MODAL Edit penilaian =============== -->
<?php foreach ($penilaian as $p){ ?>
        <div class="modal fade" id="modal_edit_penilaian<?php echo $p->id_penilaian; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">

            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Edit Data penilaian</h3>
            </div>
            <?php echo form_open('penilaian/editPenilaian', 'class="form-horizontal"'); ?>
           
                <div class="modal-body">
                    
                    <input type="hidden" name="id_pegawai" value="<?php echo $p->id_pegawai; ?>"?>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >NIP | Nama</label>
                        <div class="col-xs-8">
                            <?php
                            $query = $this->db->query("SELECT * FROM tb_pegawai WHERE id_pegawai='$p->id_pegawai'");
                            
                            foreach($query->result() as $peg){
                                echo "<input name='nama_nip' type='text' value='$peg->nip | $peg->nama_pegawai' readonly class='form form-control'>";
                            }
                            ?>
                        </div>
                    </div>
                    
                    <?php 
                    $query = $this->db->query("SELECT * FROM tb_penilaian,tb_kriteria WHERE id_pegawai='$p->id_pegawai' and tb_penilaian.id_kriteria=tb_kriteria.id_kriteria")->result();
                    foreach ($query as $n){
                    ?>     
                    <input name="<?php echo $n->id_kriteria; ?>" type="hidden" value="<?php echo $n->id_kriteria; ?>">
                    <div class="form-group">
                        <label class="control-label col-xs-3" ><?php echo $n->nama_kriteria; ?></label>
                        <div class="col-xs-3">
                            <input name="<?php echo 'c'.$n->id_kriteria; ?>" class="form-control" type="number" value="<?php echo $n->nilai; ?>" placeholder="Nilai..." max="100" required><i>
                        </div>Max (100)</i>
                    </div>
                    <?php } ?>
 
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>     
            </form>
            </div>

            </div>
        </div>
<?php }?>
<!--END MODAL Edit penilaian-->

<!-- MODAL Delete Pegawai -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Delete Confirmation
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Menghapus Data ?<br>
                <p class="debug-url"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" href="">Delete</a>
            </div>
        </div>
    </div>
</div>
<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
<!--END MODAL Delete Pegawai-->