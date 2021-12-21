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
				<div class="row">
					<div class="col-md-12">
						<hr>
						<table>
							<tr>
								<td width="150px">Judul yang diterima</td>
								<td width="30px">:</td>
								<td><b><?= $data->judul ?></b></td>
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
	<div class="col-lg-4">
		<div class="card">
			<div class="card-body">
				Judul 1
				<h6><?= $data->judul1 ?></h6>
				<?= $data->keterangan1 ?>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card">
			<div class="card-body">
				Judul 2
				<h6><?= $data->judul2 ?></h6>
				<?= $data->keterangan2 ?>
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card">
			<div class="card-body">
				Judul 3
				<h6><?= $data->judul3 ?></h6>
				<?= $data->keterangan3 ?>
			</div>
		</div>
	</div>
</div>