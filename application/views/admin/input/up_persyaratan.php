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
		    	</div>
				<div class="row">
					<div class="col-md-6">
						<table>
							<tr>
								<td width="160px">Pembimbing 1</td>
								<td width="30px">:</td>
								<td><?= $this->db->get_where("tbl_dosen",["id"=>$data->pembimbing1])->row("nama") ?></td>
							</tr>
							<tr>
								<td>Pembimbing 2</td>
								<td>:</td>
								<td><?= $this->db->get_where("tbl_dosen",["id"=>$data->pembimbing2])->row("nama") ?></td>
							</tr>
							<tr>
								<td>Penguji 1</td>
								<td>:</td>
								<td><?= $this->db->get_where("tbl_dosen",["id"=>$data->penguji1])->row("nama") ?></td>
							</tr>
							<tr>
								<td>Penguji 2</td>
								<td>:</td>
								<td><?= $this->db->get_where("tbl_dosen",["id"=>$data->penguji2])->row("nama") ?></td>
							</tr>
							<tr>
								<td>Program Studi</td>
								<td>:</td>
								<td><?= $this->db->get_where("tbl_jdl_seminar",["id"=>$mhs->prodi])->row("judul") ?></td>
							</tr>
							<?php if ($data->status == 5){ ?>
								<tr>
									<td>Tgl Varifikasi</td>
									<td>:</td>
									<td><?= $data->tgl_verifikasi ?></td>
								</tr>
							<?php } ?>
						</table>
					</div>
					<div class="col-md-6">
						<table>
							<tr>
								<td width="160px">Nama</td>
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
								<td>Nomor Pokok</td>
								<td>:</td>
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
				<div class="row mt-3">
					<div class="col-md-12">
						<a href="<?= base_url("assets/images/$data->persyaratan") ?>" target="_blank" class="btn btn-primary">Persyaratan mengikuti Ujian</a>
						<?php if ($data->status == 3){ ?>
						<button class="btn btn-success" onclick="verifikasi()">Verifikasi</button>
						<button class="btn btn-warning" onclick="tolak()">Tolak</button>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<?php if ($data->status == 4) { ?>
		<div class="col-lg-12">
			<div class="alert alert-danger">
				Alasan Ditolak : <?= $data->alasan_tolak_persyaratan ?>
			</div>
		</div>
	<?php } ?>
	<div class="col-lg-12" id="verifikasi-form">
		<form action="" id="form-verifikasi" method="post">
			<input type="hidden" name="id" value="<?= $data->id ?>">
			<input type="hidden" name="status" value="5">
			<div class="card">
				<div class="card-body">
					<h4>Verifikasi Persyaratan</h4>
					<div class="form-group">
						<b>Input Tanggal Verifikasi</b>
						<input type="date" class="form-control" name="tgl_verifikasi" required="">
					</div>
					<button type="submit" class="btn btn-success">Kirim</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-lg-12" id="tolak-form">
		<div class="card">
			<div class="card-body">
				<form action="" id="form-tolak" method="post">
					<input type="hidden" name="id" value="<?= $data->id ?>">
					<input type="hidden" name="status" value="4">
					<h4>Tolak Persyaratan</h4>
					<div class="form-group">
						<textarea name="alasan_tolak_persyaratan" class="form-control" style="height: 150px"></textarea>
					</div>
					<button type="submit" class="btn btn-success">Kirim</button>
				</form>
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


	function verifikasi(){
		$("#verifikasi-form").show();
		$("#tolak-form").hide();
	}

	function tolak(){
		$("#verifikasi-form").hide();
		$("#tolak-form").show();
	}

	$("#verifikasi-form").hide();
	$("#tolak-form").hide();

	$("#form-tolak").on("submit",function(e){
        e.preventDefault();
        let formData = new FormData(this);
        get_token(function(data){
            formData.append(['csrf_am'], data.csrf_token);
            $.ajax({
                type : "POST",
                url : '<?=base_url('input/update_status_persyaratan');?>',
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

                            load_data();
                            kembali();
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
                url : '<?=base_url('input/update_status_persyaratan');?>',
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

                            load_data();
                            kembali();
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

    function kembali(){
        $('#input').fadeOut(300);
        $('#list').fadeIn(300);
    }
</script>