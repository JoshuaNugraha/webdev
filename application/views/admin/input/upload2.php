<div class="row mb-2">
	<div class="col-12">
		<button class="btn btn-danger waves-effect waves-light" type="button" onclick="kembali();return false;">
            <span class="btn-label"><i class="fa fa-reply"></i></span> Kembali
        </button>
        <a href="<?= base_url("assets/images/$data2->persyaratan") ?>" target="_blank" class="btn btn-primary"><i class="fa fa-file"></i> Persyaratan mengikuti Ujian</a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<h4><?= $data->judul ?></h4>
				<?= $data->keterangan ?>
			</div>
		</div>
	</div>
</div>
<script>
	$("#formUpload").on("submit",function(e){
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