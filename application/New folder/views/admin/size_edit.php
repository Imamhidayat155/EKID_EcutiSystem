
          <!-- Main content -->
          <section class="content">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">FORM EDIT DATA</h3>
              </div>
              <div class="box-body">
                <!-- form start -->
                <?php  
                foreach ($editdata as $data):
                echo form_open('admin/update_size/'.$data->size_id); ?>
                   
				   <div class="form-group">
                    <label for="exampleInputEmail1">KODE</label>
                      <input type="text" readonly class="form-control" name="size_kode" value="<?php echo $data->size_kode?>"/>
                  </div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">NAMA_ITEM</label>
					  <select name="item_id" class="form-control select2">
						<?php
						$combo=$this->db->query("select * from m_item where item_id='$data->item_id'")->result();
						foreach($combo as $var){
							echo "
							<option value='$var->item_id'>$var->item_nama</option>
							";
						}
						?>
					  </select>
					</div>
				  <div class="form-group">
                    <label for="exampleInputEmail1">SIZE</label>
                      <input type="text" class="form-control" name="size_no" value="<?php echo $data->size_no?>"/>
                  </div>
                  <a href="<?php echo base_url(); ?>admin/size" class="btn btn-warning"><i class="fa fa-arrow-left"></i>BATAL</a>
                  <button type="submit" name="" class="btn btn-success"><i class="fa fa-save"></i>SIMPAN</button>
                <?php endforeach ?>
                <?php echo form_close(); ?>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </section><!-- /.content -->
        