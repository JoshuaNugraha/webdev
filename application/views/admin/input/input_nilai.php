<?php

	$mhs = $this->db->query("SELECT b.* FROM users a INNER JOIN mahasiswa b ON a.email = b.email WHERE a.id = '$data->diajukan_oleh' ")->row();
?>

<!-- modal -->
<?php foreach($role as $r){ ?>
<div class="modal fade" id="mVerifikasi"  role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Input Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="form-verifikasi" method="post">
            <input type="hidden" name="id" value="">
            <div class="form-group">
                <b>Sebagai</b>
                <select name="sebagai" class="form-control">
					<?php  
						if($r->pembimbing1 == $uid){ ?>
						  <option value="pembimbing1">Pembimbing 1</option>
						<?php } if($r->pembimbing2 == $uid){ ?>
							<option value="pembimbing2">Pembimbing 2</option>
						<?php } if($r->penguji1 == $uid){ ?>
							<option value="penguji1">Penguji 1</option>
						<?php } if($r->penguji2 == $uid){ ?>
							<option value="penguji2">Penguji 2</option>
						<?php } if($r->penguji3 == $uid){ ?>
							<option value="penguji3">Penguji 3</option>
						<?php } 
						 ?>
							
                   
                </select>
            </div>
            <div class="form-group">
                <b>Nilai</b>
                <input type="number" class="form-control" name="nilai" required="" min="0" max="100" placeholder="0 - 100">
            </div>
            <button type="submit" class="btn btn-success">Kirim</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php } ?>
<!-- akhir modal -->






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
				<h4>Input Nilai</h4>
				<div class="table-responsive" style="widows: 100%;font-size: 13px">
					<table class="table" width="99%">
						<tr style="background-color: #f5f5f5">
							<th>No</th>
							<th>Jenis Ujian</th>
							<th>Pemb.1</th>
							<th>Pemb.2</th>
							<th>Penguji 1</th>
							<th>Penguji 2</th>
							<th>Penguji 3</th>
							<th>Rata2</th>
							<th>#</th>
						</tr>
						<?php $i=1; foreach($nilai as $s) {?>
									<tr>
										<td><?=$i++?></td>
										<td>
											<?= $s->jenis_ujian ?>
										</td>
										<td><?php if($s->pembimbing1_rata !== null){echo $s->pembimbing1_rata;}else{echo "--";} ?></td>
										<td><?php if($s->pembimbing2_rata!== null){echo $s->pembimbing2_rata;}else{echo "--";} ?></td>
										<td><?php if($s->penguji1_rata !== null){echo $s->penguji1_rata;}else{echo "--";} ?></td>
										<td><?php if($s->penguji2_rata !== null){echo $s->penguji2_rata;}else{echo "--";} ?></td>
										<td><?php if($s->penguji3_rata !== null){echo $s->penguji3_rata;}else{echo "--";} ?></td>
										<td></td>
										<td>
											<?php if ($s->status == 3){ ?>
												<button class="btn btn-success btn-sm" onclick="input_nilai('<?= $s->id ?>')"><i class="fa fa-edit"></i> Input Nilai</button>
											<?php } else { ?>
												#
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

	$("#form-verifikasi").on("submit",function(e){
        e.preventDefault();
        let formData = new FormData(this);
        get_token(function(data){
            formData.append(['csrf_am'], data.csrf_token);
            $.ajax({
                type : "POST",
                url : '<?=base_url('input/set_nilai');?>',
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

                            detail('<?= $data->id?>');
                            $("#mVerifikasi").modal("hide");
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

	function input_nilai(id){
		$("#mVerifikasi [name='id']").val(id);
		$("#mVerifikasi").appendTo("body").modal("show");
	}
</script>