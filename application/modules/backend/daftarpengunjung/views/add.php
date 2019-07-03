

<!-- Main content -->
<section class="content">
  <div class="row">
	<div class="col-xs-12">
	  <div class="box box-info">
		<div class="box-header">
		  <h3 class="box-title"><?php echo $sub_title;?></h3>
		</div><!-- /.box-header -->
		 
		  	<form enctype="multipart/form-data" id="dt_form" action="<?php echo backend_url().this_module();?>/save_action" class="form-horizontal" method="post">
			  <div class="box-body wd-form">
			
			<?php show_alert('success',$this->session->flashdata('success_message'));?>
			<?php show_alert('danger',$this->session->flashdata('danger_message'));?>
				  
				  <div class="callout callout-warning validate-js-message">
                    <h4><i class="icon fa fa-warning"></i> Warning</h4>
					
					 <?php echo wd_validation_errors(); ?>
                  </div>
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Nama Pengunjung*</label>
				  <div class="col-sm-10">

				  		 <input value="<?php echo wd_set_value('nama_pengunjung'); ?>" type="text" class="form-control" name="nama_pengunjung" id="nama_pengunjung" placeholder="Nama Pengunjung" size="50">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Tanggal Daftar*</label>
				  <div class="col-sm-10">

				  		 <input value="<?php echo wd_set_value('tgl_daftar'); ?>" type="text" class="form-control" name="tgl_daftar" id="tgl_daftar" size="10">			  </div>
				</div>
	
				<div class="form-group">
				  <label for="" class="col-sm-2 control-label">Foto Pengunjung*</label>
				  <div class="col-sm-10">

				  		 
					<div class="img">
		    			<img id="preview_foto_pengunjung" class="img-responsive" style="display: none;" /> 
					</div>
					<div class="col-sm-12" style="padding-left: 0">
						<input type="file"  name="foto_pengunjung" id="foto_pengunjung" onchange="foto_pengunjungHandler()" >
					</div>
					<div style="color: red" id="error_foto_pengunjung"></div>			  </div>
				</div>
				  </div><!-- /.box-body -->
				
			  <span class="wd-box-helper"></span>		
			  <div class="wd-box-action">
				  <div class="col-sm-offset-2">
					  <div class="wd-box-action-btn">
						<button type="submit" class="btn ladda-button"  data-color="blue" data-style="expand-right" data-size="xs">Save</button>
						<a href="<?php echo backend_url().this_module();?>" class="btn btn-default">Back to List</a>
					  </div>
				  </div>
			  </div><!-- /.box-footer -->	
				
			  <div class="wd-box-required">
				  <hr>
					<span class="required">*</span>
					Field Required
			  </div><!-- /.box-footer -->
			</form>
	  </div><!-- /.box -->
	</div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->




<!-- 

/* Generated via crud engine by indonesiait.com | 2019-07-02 08:25:13 */

-->