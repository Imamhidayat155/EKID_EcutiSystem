'<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive">
                <h3 class="box-title">
                    <a href="<?php echo base_url('laporan/cetak_request/'.$this->uri->segment('3')); ?>#" class="btn btn-md btn-danger btn-flat"><i class="fa fa-download "> </i> PRINT DATA</a>
                </h3>
                
                    <table id="example" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KODE CUTI</th>
                                <th>NAMA KARYAWAN</th>
                                <th>MULAI CUTI</th>
                                <th>SELESAI CUTI</th>
                                <th>LAMA CUTI</th>
                                <th>ALASAN CUTI</th>
                                <th>STATUS CUTI</th>
                                <th>KETERANGAN</th>

                        </thead>
                        <tbody>
                            <?php  
                                $no = 1;
                                foreach ($data as $lihat):
                                $getmCuti=$this->db->query("SELECT * FROM tr_permohonan_cuti WHERE kar_id='$lihat->kar_id'")->row();
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $lihat->pc_kode?></td>
                                <td><?php echo $lihat->kar_nama?></td>
                                <td><?php echo $lihat->pc_tanggalfrom?></td>
                                <td><?php echo $lihat->pc_tanggalto?></td>
                                <td><?php echo $lihat->pc_lamacuti?> Hari</td>
                                <td><b><?php echo $lihat->pc_keterangan?></b></td>
                                <td><b><?php echo $lihat->status_nama?></b></td>
                                <td><b><?php if($lihat->status_nama == "DITOLAK"){
                                echo $lihat->pc_keterangan_ditolak ;
                                }elseif($lihat->status_nama == "MENUNGGU APPROVE MANAGER"){
                                    echo "";
                                }else{
                                    echo "OK";
                                } ?></b></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div>
        </div>
    </div>


</section><!-- /.content -->'