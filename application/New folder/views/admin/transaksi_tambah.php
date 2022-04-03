		<!-- Main content -->
		<section class="content">
		<div class="box box-info">
			<div class="box-header with-border">
			<div class="alert alert-warning alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-text="true">&times;</button>
			<h3 class="box-title">PASTIKAN POINT YANG ANDA MILIKI CUKUP ..!!!</h3>
			</div>
			</div>
			<div class="box-body table-responsive">
			<!-- form start -->
				<?php echo form_open('admin/insert_transaksi'); ?>
			<div class="col-md-12">
				
				<table class="table table-bordered table-hover" width="100%">
				<tr>
						<td align="left">NIK_NAMA &nbsp;&nbsp; <a href="<?php echo base_url()?>admin/reset_transkaryawan/<?php echo $autonumb?>"><i class="fa fa-refresh"></i></a></td>
						<td>:</td>
						<td>
							<select name="kar_id" id="kar_id" onchange="getDataKaryawan()" class="form-control select2">
								<?php 
								if(!$this->session->userdata('kar_id')){
									?>
									<option value="">--NAMA_KARYAWAN--</option>
								<?php
									$sql=$this->db->query("select * from m_karyawan")->result();
								}else{
									$sql=$this->db->query("select * from m_karyawan where kar_id='".$this->session->userdata('kar_id')."'")->result();
								}
								foreach($sql as $var){
									echo "<option value='$var->kar_id'>$var->kar_id | $var->kar_nama</option>";
								}
								?>
							</select>
							<input type="hidden" class="form-control" name="reqhed_code" value="<?php echo $autonumb?>" />
							<input type="hidden" style="width:100%" class="form-control" name="reqhed_tanggal" data-date-format="yyyy-mm-dd" id="tanggal" value="<?php echo date('Y-m-d')?>" />
						</td>
						<td align="left">TAMBAH ITEM</td>
						<td>:</td>
						<td>
							<select name="item_id" id="field_item" class="form-control" onchange="getSelect_Multi();">
								<option value="">--PILIH BARANG--</option>
								<?php $sql=$this->db->query("select * from m_item")->result();
								foreach($sql as $var){
									echo "<option value='$var->item_id'>$var->item_kode | $var->item_nama</option>";
								}
								?>
							</select>
						<input type="hidden" class="form-control" name="reqhed_code" value="<?php echo $autonumb?>" />
						</td>
					</tr>
<script>
	function getDataKaryawan()
		{ 
		var x=document.getElementById("kar_id").value;
		$.ajax({
			type	:"POST",
			url		:"<?php echo base_url()?>admin/getDataKaryawan/"+x,
			success	: function(data){ 
			document.getElementById("kar_section").value=data.split("|")[0];
			document.getElementById("kar_posisi").value=data.split("|")[1];
				}
			});											
		}
	</script>
					
					<tr>
						<td align="left">SECTION</td>
						<td>:</td>
						<?php						
							if(!$this->session->userdata('section')){
								$section = '';
							}else{
								$section = $this->session->userdata('section');
							}
						?>
						<td>
							<input type="text" readonly class="form-control" name="section" id="kar_section" onclick="getDataKaryawan()" value="<?php echo $section?>"/>
						</td>
						<td align="left">WARNA</td>
						<td>:</td>
						<td>
							<select name="warna_id" id="field_warna" class="form-control">
								<!-- <option value="">--PILIH WARNA--</option> -->
								<?php 
								// $sql=$this->db->query("select * from m_warna")->result();
								// foreach($sql as $var){
								// 	echo "<option value='$var->warna_id'>$var->warna_nama</option>";
								// }
								?>
							</select>
						<input type="hidden" class="form-control" name="reqhed_code" value="<?php echo $autonumb?>" />
						</td>
					</tr>
					<tr>
						<td align="left">POSISI</td>
						<td>:</td>
						<?php						
							if(!$this->session->userdata('position')){
								$position = '';
							}else{
								$position = $this->session->userdata('position');
							}
						?>
						<td>
							<input type="text" readonly class="form-control" name="position" id="kar_posisi" value="<?php echo $position?>"/>
						</td>
						<td align="left">SIZE</td>
						<td>:</td>
						<td>
							<select name="size_id" id="field_size" class="form-control">
								<!-- <option value="">--PILIH SIZE--</option> -->
								<?php 
								// $sql=$this->db->query("select * from m_size")->result();
								// foreach($sql as $var){
								// 	echo "<option value='$var->size_id'>$var->size_no</option>";
								// }
								?>
							</select>						
						</td>
					</tr>
					<tr>
						<td colspan="3">&nbsp;</td>
						<td align="left">JUMLAH</td>
						<td>:</td>
						<td style="width:20%"><input type="text" class="form-control" name="req_qty" value="" /></td>
						<td><button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-plus"></i>  Tambah</button></td>
					</tr>
				  </table>
                  <table id="" class="table table-bordered table-hover dataTable">
                    <thead>
                      <tr>
                        <th>NO</th>
												<th>KODE</th>
                        <th>ITEM</th>
                        <th>POINT(A)</th>
                        <th>WARNA</th>
                        <th>QTY(B)</th>
                        <th>TOTAL POINT(C)</th>
                        <th>SIZE</th>
                        <th>AKSI</th>
                    </thead>
                    <tbody>
                      	<?php  
                        $no = 1; $totalpoint=0;;
												$data	= $this->db->query("select a.*,b.*,c.*,d.*
												from req_detail a
												inner join m_item b on a.item_id=b.item_id
												left join m_size c on a.size_id=c.size_id
												left join m_warna d on a.warna_id=d.warna_id
												where reqhed_code='$autonumb'
												")->result_object();
																		foreach ($data as $lihat){
												$totalpoint+=$lihat->req_qty*$lihat->item_point;
                        ?>
                    	<tr>
                        <td><?php echo $no++ ?></td>
												<td><?php echo ucwords($lihat->reqhed_code)?></td> 
												<td><?php echo ucwords($lihat->item_nama)?></td>
												<td><?php echo ucwords($lihat->item_point)?></td>
												<td><?php echo ucwords($lihat->warna_nama)?></td>
												<td><?php echo number_format($lihat->req_qty)?></td>
												<td><?php echo number_format($lihat->req_qty*$lihat->item_point)?></td>
												<td><?php echo ucwords($lihat->size_no)?></td>
                        <td align="center">
                          <div class="btn-group" role="group">
                            <a href="<?php echo base_url(); ?>admin/hapus_transaksi/<?php echo $lihat->reqdet_id ?>" onclick="javascript: return confirm('Anda yakin akan menghapus data ini ?')" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</a>
                          </div>
                        </td>                  		
                    	</tr>
                    	<?php } ?>
						<tr>     		
							<th colspan="6">TOTAL</th>
							<th><?php echo $totalpoint?><input type="hidden" class="form-control" name="reqhed_totalpoint" value="<?php echo $totalpoint?>" /></th>
							
						</tr>
                    </tbody>
                  </table>
				<hr/>				  
                </div><!-- /.col-md-12 -->
				
			    <div class="col-md-12" align="center">
                  <button type="submit" name="selesai" class="btn btn-success"><i class="fa fa-save"></i> Selesai</button>
                <?php echo form_close(); ?>
                </div>
              </div><!-- /.box-body -->
			</div><!-- /.box -->
		</section><!-- /.content -->
<script src="<?php echo $this->config->item('link_url')?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
       
<script type="text/javascript">
	
	$(document).ready(function() {
		getSelect_Item(); //console.log(role);
	});
	function getSelect_Multi(){
		getSelect_Warna();
		getSelect_Size();
	}
	function getSelect_Item() {
		var param = null;
		$.ajax( {
			type : "POST" ,
			url : "<?php echo base_url(); ?>select/getSelect_Item" ,
			data : param ,
			cache : false ,
			success : function ( data ) {
				var obj = $.parseJSON( data );

				var str = '';
				str += '<option value="" >--PILIH ITEM--</option>';
				$.each( obj[ 'data' ] , function ( i , val ) {
					str += '<option value="' + val.item_id + '">' + val.item_nama + '</option>';
				} );

				$( '#field_item' ).html( str );

			}
		} );
	}
	function getSelect_Warna() {

		var param = $('#field_item').val();
		$.ajax( {
			type : "POST" ,
			url : "<?php echo base_url(); ?>select/getSelect_Warna" ,
			data : 'item_id='+param ,
			cache : false ,
			success : function ( data ) {
				var obj = $.parseJSON( data );

				var str = '';
				str += '<option value="" >--PILIH WARNA--</option>';
				$.each( obj[ 'data' ] , function ( i , val ) {
					str += '<option value="' + val.warna_id + '">' + val.warna_nama + '</option>';
				} );

				$( '#field_warna' ).html( str );

			}
		} );
	}
	function getSelect_Size() {

		var param = $('#field_item').val();
		$.ajax( {
			type : "POST" ,
			url : "<?php echo base_url(); ?>select/getSelect_Size" ,
			data : 'item_id='+param ,
			cache : false ,
			success : function ( data ) {
				var obj = $.parseJSON( data );

				var str = '';
				str += '<option value="" >--PILIH SIZE--</option>';
				$.each( obj[ 'data' ] , function ( i , val ) {
					str += '<option value="' + val.size_id + '">' + val.size_no + '</option>';
				});

				$( '#field_size' ).html( str );

			}
		} );
	}
</script>