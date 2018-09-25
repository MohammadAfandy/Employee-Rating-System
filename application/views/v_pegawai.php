<?php
if ($this->session->userdata('akses') != 'admin'){
?>
<script>
    $(document).ready(function() {
        $('.btn-primary').prop('disabled', true)
        
    });
</script>
<?php
}
?>
	<div class="container">
		<div class="row" style="margin-top: 20px;">
			<section>
				<center><p><h2><b>Data Pegawai</p></h2></b></center>
				<a class="btn btn-success" data-toggle="modal" data-target="#modal_add_pegawai"> Tambah Data</a>
				<div class="row-fluid" style="margin-top: 20px">
				<table class='table table-hover table-bordered' id=example >
                	<thead>
						<tr>
							<th>No</th>
  							<th>NIP</th>
  							<th>Nama Pegawai</th>
  							<th>Tgl Lahir</th>
  							<th>JK</th>
 							<th>No HP</th>
  							<th>Email</th>
  							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$nomor = 0;
						foreach ($pegawai as $p){ ?>	
						<tr>
							<td><?php echo $nomor=$nomor+1;?></td>
							<td><?php echo $p->nip; ?></td>
							<td><?php echo $p->nama_pegawai; ?></td>
							<td><?php echo $p->tgl_lahir; ?></td>
							<td><?php echo $p->jk; ?></td>
							<td><?php echo $p->no_hp; ?></td>
							<td><?php echo $p->email; ?></td>
							<td>
                            <a class="btn btn-info btn-small" data-toggle="modal" href="#modal_edit_pegawai<?php echo $p->id_pegawai; ?>"> Edit</a>
                            <a href="#confirm-delete<?php echo $p->id_pegawai;?>" data-toggle="modal" class="btn btn-danger btn-small">Delete</a>     
							</td>
						</tr>
						<?php } ?>
					</tbody>
  				</table>
  				</div>   

			</section>
		</div>
	</div>

<!-- ============ MODAL ADD Pegawai =============== -->
        <div class="modal fade" id="modal_add_pegawai" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Data Pegawai</h3>
            </div>
            <?php echo form_open('pegawai/addPegawai', 'class="form-horizontal"'); ?>
                <div class="modal-body">
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >NIP</label>
                        <div class="col-xs-8">
                            <input name="nip" class="form-control" type="text" placeholder="NIP..." required>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Pegawai</label>
                        <div class="col-xs-8">
                            <input name="nama_pegawai" class="form-control" type="text" placeholder="Nama Pegawai..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Lahir</label>
                        <div class="col-xs-8">
                            <input name="tgl_lahir" class="form-control" type="date" required>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jenis Kelamin</label>
                        <div class="col-xs-8">
                             <select name="jk" class="form-control" required>
                                <option value="">-PILIH-</option>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                             </select>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >No HP</label>
                        <div class="col-xs-8">
                            <input name="no_hp" class="form-control" type="text" placeholder="No HP..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Email</label>
                        <div class="col-xs-8">
                            <input name="email" class="form-control" type="email" placeholder="Email..." required>
                        </div>
                    </div>
 
                </div>
 
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
<!--END MODAL ADD Pegawai-->


<!-- ============ MODAL Edit Pegawai =============== -->
<?php foreach ($pegawai as $p){ ?>
        <div class="modal fade" id="modal_edit_pegawai<?php echo $p->id_pegawai; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">

            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Edit Data Pegawai</h3>
            </div>
            <?php echo form_open('pegawai/editPegawai', 'class="form-horizontal"'); ?>
           
                <div class="modal-body">
                    
                    <input type="hidden" name="id_pegawai" value="<?php echo $p->id_pegawai; ?>"?>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >NIP</label>
                        <div class="col-xs-8">
                            <input name="nip" readonly id="nip" value="<?php echo $p->nip; ?>" class="form-control" type="text" placeholder="NIP..." required>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Pegawai</label>
                        <div class="col-xs-8">
                            <input name="nama_pegawai" value="<?php echo $p->nama_pegawai; ?>" class="form-control" type="text" id="nama_pegawai" placeholder="Nama Pegawai..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Lahir</label>
                        <div class="col-xs-8">
                            <input name="tgl_lahir" value="<?php echo $p->tgl_lahir; ?>" id="tgl_lahir" class="form-control" type="date" required>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jenis Kelamin</label>
                        <div class="col-xs-8">
                             <select name="jk" id="jk" class="form-control" required>
                                <option value="">-Choose One-</option>
                                <?php if ($p->jk == 'L'){ ?>
                                <option value="L" selected>Laki-Laki</option>
                                <option value="P">Perempuan</option>
                                <?php }else{ ?>
                                <option value="L" >Laki-Laki</option>
                                <option value="P" selected>Perempuan</option>
                                <?php }?>
                             </select>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >No HP</label>
                        <div class="col-xs-8">
                            <input name="no_hp" class="form-control" value="<?php echo $p->no_hp; ?>"  id="no_hp" type="text" placeholder="No HP..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Email</label>
                        <div class="col-xs-8">
                            <input name="email" class="form-control" value="<?php echo $p->email; ?>" id="email" type="email" placeholder="Email..." required>
                        </div>
                    </div>
 
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
<!--END MODAL Edit Pegawai-->

<!-- MODAL Delete Pegawai -->
<?php foreach ($pegawai as $p){ ?>
<div class="modal fade" id="confirm-delete<?php echo $p->id_pegawai;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Delete Confirmation
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Menghapus Data Berikut ?<br>
                NIP  : <?=$p->nip;?><br>
                Nama : <?=$p->nama_pegawai;?>
                <p class="debug-url"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" id="btnhapus" href="pegawai/delPegawai/<?php echo $p->id_pegawai;?>">Delete</a>
            </div>
        </div>
    </div>
</div>
<?php }?>
<!--END MODAL Delete Pegawai-->