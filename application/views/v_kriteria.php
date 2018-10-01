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

<script>
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
</script>	
	<div class="container">
		<div class="row" style="margin-top: 20px;">
			<section>
				<center><p><h2><b>Data Kriteria</p></h2></b></center>
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
							<td><?php echo form_dropdown('c'.$k->id_kriteria, $angkaBobot,'','required="required"'); ?></td>
							<td><?php echo $k->bobot * 100 .' %'; ?></td>
							<td>
							<a class="btn btn-info btn-small" data-toggle="modal" data-target="#modal_edit_kriteria<?php echo $k->id_kriteria; ?>">Edit</a>
							</td>
						</tr>
						<?php } ?>
					</tbody>
  				</table>
  				<input type="submit" value="Set Bobot Kriteria" name="submit" class="btn btn-primary" >
  				</form>
  				</div>           
			</section>
		</div>
	</div>

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