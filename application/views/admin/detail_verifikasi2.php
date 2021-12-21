<!-- Modal -->
<div class="modal fade" id="mVerifikasi"  role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Verifikasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="" id="form-verifikasi" method="post">		
			<input type="hidden" name="id" value="">
			<input type="hidden" name="status" value="3">
					<div class="form-group">
						<b>Input Waktu Seminar</b>
						<!-- <input type="date" class="form-control" name="tanggal" required="">				 -->
						<!-- <input type="time" class="form-control mt-1 mb-2" name="jam" required>  -->
						<input type="datetime-local" class="form-control" name="tanggal_verifikasi" required>
						<b>Input Tempat Seminar</b>
						<input type="text" class="form-control" name="tempat_verifikasi" placeholder="Masukkan Tempat" required>
					</div>
					<button type="submit" class="btn btn-success">Kirim</button>
		</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="mTolak"  role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tolak Persyaratan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="" id="form-tolak" method="post">
					<input type="hidden" name="id" value="">
					<input type="hidden" name="status" value="2">
					<div class="form-group">
						<textarea name="alasan_tolak" class="form-control" style="height: 150px" placeholder="Alasan penolakan. . ."></textarea>
					</div>
					<button type="submit" class="btn btn-success">Kirim</button>
				</form>
      </div>
    </div>
  </div>
</div>
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




<?php
	$mhs = $this->db->query("SELECT b.* FROM users a INNER JOIN mahasiswa b ON a.email = b.email WHERE a.id = '$data->diajukan_oleh' ")->row();
?>
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
		    		<div class="col-md-6">
		    			<div class="text-right">
		    				<?php if ($data->status == 0){ ?>
		    				<button class="btn btn-warning waves-effect waves-light btn-sm" type="button" onclick="tolak('<?= $data->id ?>');return false;">
					            <span class="btn-label"><i class="fa fa-times"></i></span> Tolak
					        </button>
					        <button class="btn btn-success waves-effect waves-light btn-sm" type="button" onclick="verifikasi('<?= $data->id ?>');return false;">
					            <span class="btn-label"><i class="fa fa-check"></i></span> Verifikasi
					        </button>
						    <?php } ?>
		    			</div>
		    		</div>
		    	</div>
				<div class="row">
					<div class="col-md-6">
						<table>
							<tr>
								<td width="150px">Nama</td>
								<td width="30px">:</td>
								<td><?= $mhs->nama ?></td>
							</tr>
							<tr>
								<td>Mahasiswa</td>
								<td>:</td>
								<td><?= $mhs->jenis ?></td>
							</tr>
							<tr>
								<td>Kekhususan</td>
								<td>:</td>
								<td><?= $mhs->kekhususan ?></td>
							</tr>
							<tr>
								<td>Program Studi</td>
								<td>:</td>
								<td><?= $this->db->get_where("tbl_jdl_seminar",["id"=>$mhs->prodi])->row("judul") ?></td>
							</tr>
							
						</table>
					</div>
					<div class="col-md-6">
						<table>
							<tr>
								<td width="150px">Nomor Pokok</td>
								<td width="30px">:</td>
								<td><?= $mhs->np ?></td>
							</tr>
							<tr>
								<td>Nomor HP</td>
								<td>:</td>
								<td><?= $mhs->nohp ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td>:</td>
								<td><?= $mhs->email ?></td>
							</tr>
						</table>
					</div>
				</div>
				<?php if ($data->status == 2){ ?>
				<div class="row">
					<div class="col-md-6">
						<hr>
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
					<div class="col-md-6">
						<hr>
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
				</div>
			    <?php } ?>
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
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<h4>Verifikasi Persyaratan</h4>
				<div class="table-responsive" style="widows: 100%">
					<table class="table table-bordered" width="99%">
						<tr style="background-color: #f5f5f5">
							<th>No</th>
							<th>Jenis Ujian</th>
							<th>Persyaratan</th>
							<th>Tanggal</th>
					 
							<th>Verifikasi</th>
							<th>Status</th>
							<th>Keterangan</th>
						
						</tr>
						<?php $i=1; foreach ($this->db->get_where("jadwal_ujian",["id_judul"=>$data->id])->result() as $s) {
							$new_date = date("Y-m-d",strtotime($s->tanggal)); ?>
									<tr>
										<td><?=$i++?></td>
										<td><?= $s->jenis_ujian ?></td>
										
										<td>
											<?php if ($s->status == 0){ ?>
												Belum di Upload
											<?php } else { ?>
												<a href="<?= base_url("assets/images/").$s->persyaratan ?>" target="_blank" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i> Lihat File</a>
											<?php } ?>
										</td>
										<td>
											<?php if($s->tanggal !== null){ ?>
											<?= $new_date; }else{?>
											<?php } ?>
											--
										</td>
										<td>
											<?php if ($s->status == 1){ ?>
												<button class="btn btn-success btn-sm" onclick="verifikasi('<?= $s->id ?>')"><i class="fa fa-check"></i> Terima</button>
												<button class="btn btn-danger btn-sm" onclick="tolak('<?= $s->id ?>')"><i class="fa fa-times"></i> Tolak</button>
											<?php } else if ($s->status == 2) { ?>
												 Menunggu Upload Ulang
											<?php } else { ?>
												--
											<?php } ?>
										</td>
										<td>
										<?php if ($s->status == 1){ ?>
											<span class="badge badge-warning">On process</span>
											<?php } else if ($s->status == 2) { ?>
												<span class="badge badge-danger">Ditolak</span>
											<?php } else if($s->status == 3) { ?>
												<span class="badge badge-success">Selesai</span>
											<?php }else if($s->status ==0){ ?>
												--
											<?php } ?>
										</td>
										<td>
										<?php if ($s->status == 1){ ?>
												
											<?php } else if ($s->status == 2) {?>
												<a href="javascript:void(0);" class="read-more" id="c0" at="<?= $s->alasan_tolak; ?>">Baca Alasan</a>
												 
											<?php } else if($s->status == 3) { ?>
												 Diterima
											<?php } ?>
										</td>
									</tr>
								<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
var id = <?= $data->id?>;
	$("#form-tolak").on("submit",function(e){
        e.preventDefault();
        let formData = new FormData(this);
        get_token(function(data){
            formData.append(['csrf_am'], data.csrf_token);
            $.ajax({
                type : "POST",
                url : '<?=base_url('pendaftaran/update_status_persyaratan');?>',
                data : formData,
                contentType : false,
                processData : false,
                dataType: "JSON",
                success : function(data){
				
                    if(data.status == true){
                        swal({
                            title: 'Success',
                            text: data.message,
                            confirmButtonClass: 'btn btn-success btn-bordered',
                            type: "success",
                            showConfirmButton: true,
                        },function () {
							sessionStorage.setItem('reload', '1');
							sessionStorage.reloadAfterPageLoad = true;
							sessionStorage.setItem('id', (id));
							location.reload();
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

	$("#form-verifikasi").on("submit",function(e){
        e.preventDefault();
        let formData = new FormData(this);
        get_token(function(data){
            formData.append(['csrf_am'], data.csrf_token);
            $.ajax({
                type : "POST",
                url : '<?=base_url('pendaftaran/update_status_persyaratan');?>',
                data : formData,
                contentType : false,
                processData : false,
                dataType: "JSON",
                success : function(data){
					
                    if(data.status == true){
                        swal({
							
                            title: 'Success',
                            text: data.message,
                            confirmButtonClass: 'btn btn-success btn-bordered',
                            type: "success",
                            showConfirmButton: true,
                        },function () {
							sessionStorage.setItem('reload', '1');
							sessionStorage.reloadAfterPageLoad = true;
							sessionStorage.setItem('id', (id));
							location.reload();
							
                            // $("#mVerifikasi").modal("hide");
							//   location.reload();
							
                        });
                    }else{
						console.log(data);
                        swal('Warning', data.message, "warning");
                    }
                }, error: function (jqXHR, exception) {
                    load_error(jqXHR, exception);
                }
            })
        });
    });

function selesai(id){
  get_token(function(data){
            $.ajax({
                type : "POST",
                data : ({['csrf_am']: data.csrf_token,id}),
                url : "<?=base_url('pendaftaran/detail_d');?>",
                success : function(data){
                    $("#isi").html(data);
                    $('#list').fadeOut(300);
                    $('#input').fadeIn(300);
                },
                error: function (jqXHR, exception) {
                    load_error(jqXHR, exception);
                }
            })
        })
    }
 
$(document).ready(function(){
   
    $(".read-more").click(function(){
		// $("#mVerifikasi [name='id']").val(id);
		var isi = $('#c0').attr('at');
		$('#c1').text(isi);
		$('#tolak').appendTo("body").modal('show');
		// $("#mVerifikasi").modal("show");
    });
	 
});

	function verifikasi(id){
		$("#mVerifikasi [name='id']").val(id);
		$("#mVerifikasi").modal("show");
	}
	function tolak(id){
		$("#mTolak [name='id']").val(id);
		$("#mTolak").modal("show");
	}
</script>