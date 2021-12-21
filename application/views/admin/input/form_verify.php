<form action="" method="post" id="form_verify">
	<input type="hidden" name="id" value="<?= $id ?>">
	<input type="hidden" name="status" value="2">
	<input type="hidden" name="keterangan" id="keterangan">
	<div class="row">
		<div class="col-lg-10">
			<div class="form-group">
				<b>Judul yang diterima</b>
				<select name="judul" class="form-control" required="" onchange="getKet(this.value)">
					<option value="">Pilih</option>
					<option value="<?= $data->judul1 ?>">Judul 1 : <?= $data->judul1 ?></option>
					<option value="<?= $data->judul2 ?>">Judul 2 : <?= $data->judul2 ?></option>
					<option value="<?= $data->judul3 ?>">Judul 3 : <?= $data->judul3 ?></option>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-lg-5">
			<div class="form-group">
				<b>Pembimbing 1</b>
				<select name="pembimbing1" class="form-control select2" required="">
					<option value="">Pilih</option>
					<?php foreach ($this->db->get("tbl_dosen")->result() as $d) { ?>
                    <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                    <?php } ?>
				</select>
			</div>
		</div>
		<div class="col-md-6 col-lg-5">
			<div class="form-group">
				<b>Pembimbing 2</b>
				<select name="pembimbing2" class="form-control select2" required="">
					<option value="">Pilih</option>
					<?php foreach ($this->db->get("tbl_dosen")->result() as $d) { ?>
                    <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                    <?php } ?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-lg-5">
			<div class="form-group">
				<b>Penguji 1</b>
				<select name="penguji1" class="form-control select2" required="">
					<option value="">Pilih</option>
					<?php foreach ($this->db->get("tbl_dosen")->result() as $d) { ?>
                    <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                    <?php } ?>
				</select>
			</div>
		</div>
		<div class="col-md-6 col-lg-5">
			<div class="form-group">
				<b>Penguji 2</b>
				<select name="penguji2" class="form-control select2" required="">
					<option value="">Pilih</option>
					<?php foreach ($this->db->get("tbl_dosen")->result() as $d) { ?>
                    <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                    <?php } ?>
				</select>
			</div>
		</div>
		<div class="col-md-6 col-lg-5">
			<div class="form-group">
				<b>Penguji 3</b>
				<select name="penguji3" class="form-control select2" required="">
					<option value="">Pilih</option>
					<?php foreach ($this->db->get("tbl_dosen")->result() as $d) { ?>
                    <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                    <?php } ?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-3">
			<button class="btn btn-success btn-block">Kirim</button>
		</div>
	</div>
</form>
<script>
	function getKet(d){
		if (d == `<?= $data->judul1 ?>`){
			$("#keterangan").val(`<?= $data->keterangan1 ?>`)
		} else if (d == `<?= $data->judul2 ?>`){
			$("#keterangan").val(`<?= $data->keterangan2 ?>`)
		} else if (d == `<?= $data->judul3 ?>`){
			$("#keterangan").val(`<?= $data->keterangan3 ?>`)
		}
	} 

	$("#form_verify").on("submit",function(e){
        e.preventDefault();
        let formData = new FormData(this);
        get_token(function(data){
            formData.append(['csrf_am'], data.csrf_token);
            $.ajax({
                type : "POST",
                url : '<?=base_url('verifikasi/verifkasi_judul');?>',
                data : formData,
                contentType : false,
                processData : false,
                dataType: "JSON",
                success : function(data){
                    if(data.status == true){
                    	$("#myModal").modal("hide");
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
</script>