<section class="section">
    <div class="section-header">
    <h1>Dashboard</h1>
    </div>
</section>

<div class="row">
	<div class="col-md-6 col-sm-6 col-lg-3 col-12">
	  <div class="card card-statistic-1">
	    <div class="card-icon bg-primary">
	      <i class="far fa-user"></i>
	    </div>
	    <div class="card-wrap">
	      <div class="card-header">
	        <h4>Total User</h4>
	      </div> 
	      <div class="card-body">
	        <?= $this->db->get("users")->num_rows() ?>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-3 col-12">
	  <div class="card card-statistic-1">
	    <div class="card-icon bg-primary">
	      <i class="far fa-user"></i>
	    </div>
	    <div class="card-wrap">
	      <div class="card-header">
	        <h4>Total Mahasiswa</h4>
	      </div>
	      <div class="card-body">
	        <?= $this->db->get("mahasiswa")->num_rows() ?>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-3 col-12">
	  <div class="card card-statistic-1">
	    <div class="card-icon bg-primary">
	      <i class="far fa-user"></i>
	    </div>
	    <div class="card-wrap">
	      <div class="card-header">
	        <h4>Total Ketua Prodi</h4>
	      </div>
	      <div class="card-body">
	        <?= $this->db->get("tbl_ketua_prodi")->num_rows() ?>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-3 col-12">
	  <div class="card card-statistic-1">
	    <div class="card-icon bg-primary">
	      <i class="far fa-user"></i>
	    </div>
	    <div class="card-wrap">
	      <div class="card-header">
	        <h4>Total Operator</h4>
	      </div>
	      <div class="card-body">
	        <?= $this->db->get("tbl_loket")->num_rows() ?>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="col-md-6 col-sm-6 col-lg-3 col-12">
	  <div class="card card-statistic-1">
	    <div class="card-icon bg-primary">
	      <i class="far fa-user"></i>
	    </div>
	    <div class="card-wrap">
	      <div class="card-header">
	        <h4>Total Dosen</h4>
	      </div>
	      <div class="card-body">
	        <?= $this->db->get("tbl_dosen")->num_rows() ?>
	      </div>
	    </div>
	  </div>
	</div>
</div>


	