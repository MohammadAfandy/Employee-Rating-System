<?php

if($this->session->flashdata('set')) {  ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('set'); ?></strong> 
    </div>
<?php 
}elseif ($this->session->flashdata('edit')) { ?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('edit'); ?></strong> 
    </div>
<?php
}elseif ($this->session->flashdata('delete')) { ?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong><?php echo $this->session->flashdata('delete'); ?></strong> 
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

<!-- <script>
$(document).ready(function(){
$('select').change(function() {
    var myOpt = [];
    $("select").each(function () {
        myOpt.push($(this).val());
    });
    $("select").each(function () {
        $(this).find("option").prop('hidden', false);
        var sel = $(this);
        $.each(myOpt, function(key, value) {
            if((value != "") && (value != sel.val())) {
                sel.find("option").filter('[value="' + value +'"]').prop('hidden', true);
            }
        });
    });
});
});
</script> -->	
	<div class="container">
		<div class="row" style="margin-top: 20px;">
			<section>
				<center><p><h2><b>Data Kriteria</p></h2></b></center>
                <center><p><h3><b>Jumlah Bobot Maks 100%</p></h3></b></center>
                <a class="btn btn-success" data-toggle="modal" data-target="#modal_add_kriteria"> Tambah Data</a>
				<div class="row-fluid" style="margin-top: 20px">
				<?php echo form_open('kriteria/setBobot'); ?>
				<table class='table table-hover table-bordered' >
                	<thead>
						<tr>
							<th>No</th>
  							<th>Nama Kriteria</th>
  							<th>Bobot</th>
  							<th>Bobot Saat Ini</th>
  							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$nomor = 0;
						foreach ($kriteria as $k){ ?>	
						<input type="hidden" name="id_kriteria" value="<?php echo $k->id_kriteria; ?>">
						<tr>
							<td><?php echo $nomor=$nomor+1;?></td>
							<td><?php echo $k->nama_kriteria; ?></td>
							<!-- <td><?php echo form_dropdown('c'.$k->id_kriteria, $angkaBobot,'','required="required"'); ?></td> -->
                            <td><input id="c<?php echo $k->id_kriteria; ?>" class="inputBobot" min="0" max="100" step="any" name="c<?php echo $k->id_kriteria; ?>" placeholder="Nilai Dalam %" type="number"></td>
							<td><?php echo $k->bobot * 100 .' %'; ?></td>
							<td>
							<a class="btn btn-info btn-small" data-toggle="modal" data-target="#modal_edit_kriteria<?php echo $k->id_kriteria; ?>">Edit</a>
                            <a class="btn btn-danger btn-small" data-href="kriteria/delKriteria/<?php echo $k->id_kriteria; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>
							</td>

						</tr>
						<?php } ?>
					</tbody>
  				</table>
  				<input type="submit" value="Set Bobot Kriteria" name="submit" class="btn btn-primary" >
                <a class="btn btn-danger" data-toggle="modal" data-target="#confirm-reset">Reset Bobot</a>
  				</form>
  				</div>           
			</section>
		</div>
	</div>

<!-- ============ MODAL Add Kriteria =============== -->
        <div class="modal fade" id="modal_add_kriteria" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">

            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Data Kriteria</h3>
            </div>
            <?php echo form_open('kriteria/addKriteria', 'class="form-horizontal"'); ?>
           
                <div class="modal-body">
                    <p style="font-size: 15px; color:red;"><strong>Note: Menambah Data Kriteria Akan Mereset Seluruh Bobot Kriteria</strong></p>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Kriteria</label>
                        <div class="col-xs-8">
                            <input name="nama_kriteria" class="form-control" type="text" id="nama_kriteria" placeholder="Nama Kriteria..." required>
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
<!--END MODAL Edit Kriteria-->


<!-- ============ MODAL Edit Kriteria =============== -->
<?php foreach ($kriteria as $k){ ?>
        <div class="modal fade" id="modal_edit_kriteria<?php echo $k->id_kriteria; ?>" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">

            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 class="modal-title" id="myModalLabel">Edit Data Kriteria</h3>
            </div>
            <?php echo form_open('kriteria/editKriteria', 'class="form-horizontal"'); ?>
           
                <div class="modal-body">
                    
                    <input type="hidden" name="id_kriteria" value="<?php echo $k->id_kriteria; ?>"?>
                     
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Kriteria</label>
                        <div class="col-xs-8">
                            <input name="nama_kriteria" value="<?php echo $k->nama_kriteria; ?>" class="form-control" type="text" id="nama_kriteria" placeholder="Nama Kriteria..." required>
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
<!--END MODAL Edit Kriteria-->

<!--Add MODAL Reset Kriteria-->
<div class="modal fade" id="confirm-reset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Reset Kriteria Confirmation
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Mereset Bobot Kriteria ?<br>
                <p class="debug-url"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="kriteria/resetBobot">Reset</a>
            </div>
        </div>
    </div>
</div>
<!--END MODAL Reset Kriteria-->

<!-- MODAL Delete Kriteria -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Delete Confirmation
            </div>
            <div class="modal-body">
                <p style="font-size: 15px; color:red;"><strong>Note: Menghapus Data Kriteria Akan Mereset Seluruh Bobot Kriteria</strong></p>
                Apakah Anda Yakin Ingin Menghapus Kriteria ?<br>
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
<!--END MODAL Delete Kriteria-->


<script>
$('.inputBobot').focus(function(){
   var total = 0; // create a var to track the current total
   $('.inputBobot').each(function(){  // loop through each element
        total = total + Number($(this).val()); // add the current value to the running total
   });
   var remaining = 100 - total; // figure out how much is left before you hit 100
   $(this).attr('max', remaining); // set the max on the current element to match the remaining limit
});

// that will handle the stepper, note that the max wont prevent the user typing in a value higher than the limit
// if you want, you can also make it so typing in a greater value will default to the max value
$('.inputBobot').keyup(function(){
    if(Number($(this).val()) > Number($(this).attr('max'))){
        $(this).val($(this).attr('max'))
    }
});
</script>