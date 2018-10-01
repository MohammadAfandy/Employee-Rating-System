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
        $('.btn-primary').prop('disabled', true)
        
    });
</script>
<?php
}
?>

<div class="container">
		<div class="row" style="margin-top: 20px;">
			<section>
				<center><p><h2><b>Setting Akun</p></h2></b></center>
				<a class="btn btn-success" data-toggle="modal" data-target="#modal_add_akun"> Tambah Data</a>
				<div class="row-fluid" style="margin-top: 20px">
				<table class='table table-hover table-bordered' id=example >
                	<thead>
						<tr>
							<th>No</th>
  							<th>Username</th>
  							<th>Level</th>
  							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$nomor = 0;
						foreach ($akun as $a){ ?>	
						<tr>
							<td><?php echo $nomor=$nomor+1;?></td>
							<td><?php echo $a->username; ?></td>
							<td><?php echo $a->level; ?></td>
							<td>
                            <a class="btn btn-info btn-small" data-toggle="modal" data-target="#modal_edit_akun" 
                                data-id="<?php echo $a->id_user; ?>"
                                data-username="<?php echo $a->username; ?>"
                                data-level="<?php echo $a->level; ?>">Edit</a>
                            <button class="btn btn-danger btn-small" data-href="akun/delAkun/<?php echo $a->id_user; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</button> 
							</td>
						</tr>
						<?php } ?>
					</tbody>
  				</table>
  				</div>   

			</section>
		</div>
	</div>

<!-- ============ MODAL ADD Akun =============== -->
        <div class="modal fade" id="modal_add_akun" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Akun</h3>
            </div>
            <?php echo form_open('akun/addAkun', 'class="form-horizontal"'); ?>
                <div class="modal-body">
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Username</label>
                        <div class="col-xs-8">
                            <input name="username" class="form-control" type="text" placeholder="Username..." required>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Password</label>
                        <div class="col-xs-8">
                            <input name="password" class="form-control" type="password" placeholder="Password..." required>
                        </div>
                    </div>
 
                    <!-- <div class="form-group">
                        <label class="control-label col-xs-3" >Level</label>
                        <div class="col-xs-8">
                             <select name="level" class="form-control" required>
                                <option value="">-PILIH-</option>
                                <option value="L">Admin</option>
                                <option value="P">User</option>
                             </select>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Level</label>
                        <div class="col-xs-5">
                             <input type="radio" name="level" value="admin" required>Admin<br>
                             <input type="radio" name="level" value="user" required>User
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
<!--END MODAL ADD Akun-->

<!-- ============ MODAL Edit Akun =============== -->
        <div class="modal fade" id="modal_edit_akun" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">

            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Edit Akun</h3>
            </div>
            <?php echo form_open('akun/editAkun', 'class="form-horizontal"'); ?>
           
                <div class="modal-body">
                    
                    <input type="hidden" name="id_user" id="id_user" value="" >

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Username</label>
                        <div class="col-xs-8">
                            <input name="username" id="username" value="" class="form-control" type="text" placeholder="Username..." required>
                        </div>
                    </div>
 
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Password</label>
                        <div class="col-xs-8">
                            <input name="password" class="form-control" type="password" id="password" placeholder="Password..."><p style="font-size:12px;".>Note: Leave the field blank if you don't want to change password</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Level</label>
                        <div class="col-xs-5">
                             <input type="radio" name="level" value="admin" required>Admin<br>
                             <input type="radio" name="level" value="user" required>User
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
        <script>
     $(document).ready(function() {
            $('#modal_edit_akun').on('show.bs.modal', function (event) {
                var div     = $(event.relatedTarget) 
                var modal   = $(this)
 
                // Isi nilai pada field
                modal.find('#id_user').attr("value",div.data('id'));
                modal.find('#username').attr("value",div.data('username'));
                modal.find('#level').attr("value",div.data('level'));
            });
        });
        </script>
<!--END MODAL Edit Akun-->

<!-- MODAL Delete Akun -->
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
                <a class="btn btn-danger btn-ok" id="btnhapus" href="">Delete</a>
            </div>
        </div>
    </div>
</div>
<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
<!--END MODAL Delete Akun-->