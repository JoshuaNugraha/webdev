<div class="modal fade" id="tolak"  role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alasan Tolak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <p id="c1"></p>
      </div>
    </div>
  </div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
		    <div class="card-body">
		    	<div class="row mb-3">
		    		<div class="col-md-6">
		    			<button class="btn btn-danger waves-effect waves-light btn-sm" type="button" onclick="kembali();return false;">
				            <span class="btn-label"><i class="fa fa-reply"></i></span> Kembali
				        </button>
		    		</div>
		    	</div>
				<div class="row">
					<div class="col-md-6 col-lg-5 col-xl-4">
						<table>
							<tr>
								<td width="150px">Pembimbing 1</td>
								<td width="30px">:</td>
								<td><?= $this->db->get_where("tbl_dosen",["id"=>$data->pembimbing1])->row("nama") ?></td>
							</tr>
							<tr>
								<td>Pembimbing 2</td>
								<td>:</td>
								<td><?= $this->db->get_where("tbl_dosen",["id"=>$data->pembimbing2])->row("nama") ?></td>
							</tr>
						</table>
					</div>
					<div class="col-md-6 col-lg-5 col-xl-4">
						<table>
							<tr>
								<td width="150px">Penguji 1</td>
								<td width="30px">:</td>
								<td><?= $this->db->get_where("tbl_dosen",["id"=>$data->penguji1])->row("nama") ?></td>
							</tr>
							<tr>
								<td>Penguji 2</td>
								<td>:</td>
								<td><?= $this->db->get_where("tbl_dosen",["id"=>$data->penguji2])->row("nama") ?></td>
							</tr>
							<tr>
								<td>Penguji 3</td>
								<td>:</td>
								<td><?= $this->db->get_where("tbl_dosen",["id"=>$data->penguji3])->row("nama") ?></td>
							</tr>
						</table>
					</div>
					<!-- <div class="col-md-6 col-lg-7">
						<?php if ($data->status == 2 || $data->status == 4  ){ ?>
						<form action="" method="post" id="formUpload">
							<input type="hidden" name="id" value="<?= $data->id ?>">
							<div class="form-group">
								<b>Upload Persyaratan</b> (PDF)
								<input type="file" accept="application/pdf" required="" name="foto" class="form-control">
								<button type="submit" class="mt-2 btn btn-success">Upload Persyaratan</button>
							</div>
						</form>
						<?php if ($data->status == 4){ ?>
							<div class="alert alert-danger">
								Persyaratan kamu ditolak <br>
								<?= $data->alasan_tolak_persyaratan ?>
							</div>
						<?php } ?>
					<?php } else { ?>
						<a href="<?= base_url("assets/images/$data->persyaratan") ?>" target="_blank" class="btn btn-primary">Persyaratan mengikuti Ujian</a>
						<?php if ($data->status == 3){echo"<br>Mohon Tunggu Verifikasi dari Loket";} ?>
					<?php } ?>
					</div> -->
					<div class="col-md-12 mt-2">
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr style="background-color: #f5f5f5">
									<th>Nama Ujian</th>
									<th>Persyaratan</th>
									<th>Tanggal</th>	
									<th>Nilai</th>
									<th>#</th>
									<th class="col-2">Keterangan</th>
								</tr>
								<?php $disabled = ""; ?>
								<?php $pengaturan = $this->db->get("pengaturan"); ?>
								<?php $disabledClass = "btn-secondary"; ?>
								<?php $tingkatan = "S2"; ?>
								<?php $urut = 0; ?>
								<?php foreach ($this->db->get_where("jadwal_ujian",["id_judul"=>$data->id])->result() as $s) { ?>
									<?php if($urut == 0){
										if ($s->jenis_ujian == "Pendaftaran Prelium"){
											$tingkatan = "S3";
										}
									} ?>
									<tr>
										<td><?= $s->jenis_ujian ?></td>
										
										<td>
											<?php if ($s->status == 0){ ?>
												Belum di Upload
											<?php } else { ?>
												<a href="<?= base_url("assets/images/").$s->persyaratan ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i> Lihat File</a>
											<?php } ?>
										</td>
										<td><?= date("Y-m-d",strtotime($s->tanggal)); ?></td>
										<td><?= $tingkatan ?></td>
										<td>
											<?php
												$fild = "";
												if($tingkatan == "S2"){
													if ($s->jenis_ujian == "Seminar Proposal"){
														$fild = "seminar_proposal_s2";
													} else if ($s->jenis_ujian == "Seminar Hasil"){
														$fild = "seminar_hasil_s2";
													} else if ($s->jenis_ujian == "Ujian Tutup"){
														$fild = "ujian_tutup_s2";
													}
												} else {
													if ($s->jenis_ujian == "Pendaftaran Prelium"){
														$fild = "pendaftaran_prelium";
													} else if ($s->jenis_ujian == "Seminar Proposal"){
														$fild = "seminar_proposal";
													} else if ($s->jenis_ujian == "Seminar Hasil"){
														$fild = "seminar_hasil";
													} else if ($s->jenis_ujian == "Ujian Tutup"){
														$fild = "ujian_tutup";
													} else if ($s->jenis_ujian == "Gagasan Awal"){
														$fild = "gagasan_awal";
													} else if ($s->jenis_ujian == "Promosi"){
														$fild = "promosi";
													} 
 												}
 												$link = "";
 												if ($pengaturan->row($fild) != '' && $pengaturan->row($fild) != null){
 												$link = base_url("assets/").$pengaturan->row($fild);
 												}
											?>
											<?php if ($s->status == 0){ ?>
											<button class="btn btn-sm btn-primary <?= $disabledClass ?>" <?= $disabled ?> onclick="upload_persyaratan_v2('<?= $s->id ?>','<?= $link ?>')">Upload Persyaratan</button>
											<?php } else if ($s->status == 1){ ?>
											<span class="badge badge-warning">Menunggu konfirmasi</span>
											<?php } else if ($s->status == 2){ ?>
											<button class="btn btn-sm btn-primary " <?= $disabled ?> onclick="upload_persyaratan_v2('<?= $s->id ?>','<?= $link ?>')">Upload Persyaratan</button><br>
												
											<?php }else if($s->status == 3){ ?>
											<span class="badge badge-success">Diterima</span>
										<?php } ?>
										</td>

										<td class="col-2">
											<?php if($s->status == 0){ ?>
												--
											<?php }else if($s->status == 1){  ?>
												Loket
											<?php }else if($s->status == 2){  ?>
											<span class="badge badge-danger">Ditolak : </span> <br>
											<a href="javascript:void(0);" class="read-more" id="c0" at="<?= $s->alasan_tolak; ?>">Baca Alasan</a>
											 

											 
											<?php }else if($s->status == 3)	{?>
												Jadwal Telah Keluar
											<?php } ?>
											

										</td>
									<?php if ($s->status < 3){$disabled = "disabled";} ?>
									</tr>
									<?php $urut++; ?>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<h6><?= $data->judul ?></h6>
				<?= $data->keterangan ?>
			</div>
		</div>
	</div>
</div>
<script>
	function upload_persyaratan_v2(id_jadwal_ujian,link){
		$("#modal-upload").modal("show");
		$("#form-upload-persyaratan [name='id']").val(id_jadwal_ujian);
		if (link != ''){
			$("#info_ujian_z").attr("href",link).show();
		} else {
			$("#info_ujian_z").hide();
		}
	}

	$("#form-upload-persyaratan").on("submit",function(e){
        e.preventDefault();
        let formData = new FormData(this);
        get_token(function(data){
            formData.append(['csrf_am'], data.csrf_token);
            $.ajax({
                type : "POST",
                url : '<?=base_url('input/upload_persyaratan');?>',
                data : formData,
                contentType : false,
                processData : false,
                dataType: "JSON",
                success : function(data){
                	$('#form-upload-persyaratan').each(function(){this.reset();});
                    if(data.status == true){
                    	$("#modal-upload").modal("hide");
                        swal({
                            title: 'Success',
                            text: data.message,
                            confirmButtonClass: 'btn btn-success btn-bordered',
                            type: "success",
                            showConfirmButton: true,
                        },function () {

                            detail('<?= $data->id ?>')
                        });
                    }else{
                        swal('Warning', data.message, "warning");
                    }
                }, error: function (jqXHR, exception) {
                    load_error(jqXHR, exception);
                }
            })
        });
    });

$(document).ready(function(){
   
    $(".read-more").click(function(){
		// $("#mVerifikasi [name='id']").val(id);
		var isi = $('#c0').attr('at');
		$('#c1').text(isi);
		$('#tolak').appendTo("body").modal('show');
		// $("#mVerifikasi").modal("show");
    });
	 
});
</script>