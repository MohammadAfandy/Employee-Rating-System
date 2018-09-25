<script>
    $(document).ready(function() {
    $('#table1').DataTable();
    $('#table2').DataTable();
    $("#example").dataTable().fnDestroy();
    var t = $('#example').DataTable( {   

        "order": [[ 1, "desc" ]],
        "columnDefs": [ {
            "targets": [0,1],
            "orderable": false
        } ],
        "pagingType" : "full_numbers"

    } );

    t.on( 'order.dt search.dt', function () {
        t.column(2, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    } );    
</script>
    <div class="container">
		<div class="row" style="margin-top: 20px;">
			<section>
				<center><p><h2><b>Laporan</p></h2></b></center>
                <div class="panel-group">
                <div class="row-fluid" style="margin-top: 20px">
                <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 20px;">Penilaian</div>
                <div class="panel-body">
                <!-- TABLE PENILAIAN -->
                <table class='table table-hover table-bordered' id=table1 >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <?php foreach ($kriteria as $k){ ?>
                                <th><?php echo $k->nama_kriteria; ?></th>
                            <?php } ?>
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
                            
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>   

                </div>
                </div>

                
                <div class="row-fluid" style="margin-top: 20px">
                <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 20px;">Normalisasi</div>
                <div class="panel-body">
                <!-- TABLE NORMALISASI -->
                <table class='table table-hover table-bordered' id=table2 >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pegawai</th>
                            <?php foreach ($kriteria as $k){ ?>
                                <th><?php echo $k->nama_kriteria; ?></th>
                            <?php } ?>
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
                            $query = $this->db->query("SELECT * from tb_penilaian where id_pegawai='$pn->id_pegawai'");
                            foreach ($query->result() as $pi){

                                $max = $this->db->query("SELECT MAX(nilai) as maks FROM tb_penilaian WHERE id_kriteria='$pi->id_kriteria'");
                                foreach ($max->result() as $maks);

                                // $maksimum = array_map('intval', $maks->maks);

                                // $max = $this->db->select_max('nilai')
                                //                 ->from('tb_penilaian')->where('id_kriteria',$pn->id_kriteria)->result();
                                $normalisasi = round($pi->nilai / $maks->maks , 3);
                            ?>
                                <td><?php echo $normalisasi; ?></td>
                            <?php } ?>
                            
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
                </div>
                </div>

               
                <div class="row-fluid" style="margin-top: 20px">
                <div class="panel panel-default">
                <div class="panel-heading" style="font-size: 20px;">Ranking</div>
                <div class="panel-body">
                <!-- TABLE RANKING -->
                <table class='table table-hover table-bordered' id=example >
                    <thead>
                        <tr>                            
                            <th>Nama Pegawai</th>
                            <th>Nilai</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach ($pegawaipenilaian as $pn){ ?>  
                        <tr>                            
                            <td><?php echo $pn->nama_pegawai; ?></td>
                            <?php 
                            $nomor=0;
                            $query = $this->db->query("SELECT * from tb_penilaian where id_pegawai='$pn->id_pegawai'");
                            $rank = array();
                            foreach ($query->result() as $pi){
                                $max = $this->db->query("SELECT MAX(nilai) as maks FROM tb_penilaian WHERE id_kriteria='$pi->id_kriteria'");
                                $cekbobot = $this->db->query("SELECT bobot FROM tb_kriteria  WHERE id_kriteria='$pi->id_kriteria'");
                                foreach ($max->result() as $maks);
                                foreach ($cekbobot->result() as $c);
                                $normalisasi = round($pi->nilai / $maks->maks , 3);
                                $rank[] = round($normalisasi * $c->bobot,3);
                            }
                            
                            $rank = array_sum($rank);
                            ?>
                            <td><?php echo $rank; ?></td>
                            <td><?php echo $nomor=$nomor+1; ?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                </div>
                </div>
                </div>
                </div>   
			</section>
		</div>
	</div>
