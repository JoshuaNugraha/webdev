<!-- Modal -->
<div class="modal fade" id="filterTgl" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="filterTglLabel">Filter Tanggal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="get">
          <div class="modal-body">
            <div class="form-group">
                <b>Tanggal Awal</b>
                <input type="date" name="tgl_awal" class="form-control" required="">
            </div>
            <div class="form-group">
                <b>Tanggal Akhir</b>
                <input type="date" name="tgl_akhir" class="form-control" required="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning">Filter</button>
          </div>
      </form>
    </div>
  </div>
</div>

<section class="section">

  <!-- Default box -->
    <div class="section-header">
        <h1><?=$title?></h1>
        <div class="section-header-breadcrumb">
            <?php if($title_nav_3 != ''){ ?>
            <div class="breadcrumb-item active"><a href="javascript:void(0)"><?=$title_nav_3?></a></div>
            <?php }if($title_nav_2 != ''){ ?>
            <div class="breadcrumb-item active"><a href="javascript:void(0)"><?=$title_nav_2?></a></div>
            <?php } ?>
            <div class="breadcrumb-item"><?=$title_nav_1?></div>
        </div>
    </div>

    <div id="list">
        <div class="row">
            <div class="col-md-8 col-sm-7 col-lg-9"> 
                <form action="" method="get">
                    <div class="form-group"> 
                        <div class="input-group">
                          <input type="text" class="form-control" minlength="6" name="key" required="" placeholder="Masukkan judul Seminar">
                          <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Cari</button>
                          </div>
                        </div>        
                    </div>  
                </form>
            </div>  
            <div class="col-md-4 col-sm-5 col-lg-3">
                <button class="btn btn-warning btn-block btn-lg" data-toggle="modal" data-target="#filterTgl"><i class="fa fa-calendar"></i> Filter Tanggal</button>
            </div>
        </div>  

        <div class="row">
            <div class="col-md-12">
                <?php

                    $where = '';
                    if ($sendiri){
                        $user_id = $this->session->userdata('user_id'); 
                        $where = "AND a.diajukan_oleh = '".$user_id."'";
                    }

                    $status_page = 0;

                    if (isset($_GET["key"]) && $_GET["key"] != "" ){
                        $query = $this->db->query("SELECT a.*,b.tanggal as tglnya, b.jenis_ujian,b.id as id_a FROM tbl_data_judul a
                            LEFT JOIN jadwal_ujian b ON a.id=b.id_judul
                            WHERE b.status = '3'
                            AND a.judul LIKE '%".$_GET["key"]."%' $where ");
                        $status_page = 1;
                    } else if (isset($_GET["tgl_awal"]) && isset($_GET["tgl_akhir"])){
                        $query = $this->db->query("SELECT a.*,b.tanggal_verifikasi as tglnya, b.jenis_ujian,b.id as id_a, b.tempat_verifikasi as tmp FROM tbl_data_judul a
                            LEFT JOIN jadwal_ujian b ON a.id=b.id_judul
                            WHERE b.status = '3'
                            AND (tanggal  BETWEEN '".$_GET["tgl_awal"]."' AND '".$_GET["tgl_akhir"]."')  $where ");
                        $status_page = 1;
                    } else {
                        $query = $this->db->query("SELECT a.*,b.tanggal_verifikasi as tglnya, b.jenis_ujian,b.id as id_a,  b.tempat_verifikasi as tmp FROM tbl_data_judul a
                            LEFT JOIN jadwal_ujian b ON a.id=b.id_judul
                            WHERE b.status = '3'
                            AND tanggal >= '".date("Y-m-d")."' $where ");
                    }
                ?>
                <?php if (isset($_GET["key"]) && $_GET["key"] != "" ){ ?>
                    <h5 class="mb-3">Hasil Pencarian : <?= $_GET["key"]?> (<?= $query->num_rows() ?> data ditemukan) </h5>
                <?php } else if (isset($_GET["tgl_awal"]) && isset($_GET["tgl_akhir"])){  ?>
                    <h5 class="mb-3">Hasil Filter : <?= $_GET["tgl_awal"]?> s/d <?= $_GET["tgl_akhir"]?> (<?= $query->num_rows() ?> data ditemukan) </h5>
                <?php }  ?>
                <?php foreach ($query->result() as $d) { ?>
                    <div class="card">  
                        <div class="card-body"> 
                           <div class="row">    
                            <div class="col-md-8 col-lg-9 col-xl-10">
                                 <h4>Tanggal - <?= $d->tglnya; ?></h4>
                                 <h5>Tempat - <?= $d->tmp; ?></h5>
                                 
                                <div style="font-size: 18px" class="mb-2"><?= $d->judul ?></div>
                                <?php
                                    $mhs = $this->db->query("SELECT b.*,c.judul as prodi FROM users a INNER JOIN mahasiswa b ON a.email = b.email LEFT JOIN tbl_jdl_seminar c ON b.prodi = c.id WHERE a.id = '$d->diajukan_oleh' ")->row();
                                ?>
                                <span class="badge badge-warning"><?= $mhs->prodi ?></span>
                                <span class="badge badge-info">by <?= $mhs->nama ?></span>
                                <span class="badge badge-primary"><?= $d->jenis_ujian ?></span>
                            </div>
                            <div class="col-md-4 text-right col-lg-3 col-xl-2">
                                <button class="btn btn-success mt-3 btn-block" onclick="detail('<?= $d->id_a ?>')">Detail Seminar</button>
                            </div>
                           </div>
                        </div>
                    </div>
                <?php } ?>
                <?php if($query->num_rows() == 0 && $status_page == 0){ ?>
                    <h5>Beluma ada Seminar yang akan datang</h5>
                <?php } ?>
            </div>
        </div>
    </div>

    <div id="input"></div>

</section>      

<script>
    function detail(id){
        get_token(function(data){
            $.ajax({
                type : "POST",
                data : ({['csrf_am']: data.csrf_token,id}),
                url : "<?=base_url('input/upload_v2');?>",
                success : function(data){
                    $("#input").html(data);
                    $('#list').fadeOut(300);
                    $('#input').fadeIn(300);
                },
                error: function (jqXHR, exception) {
                    load_error(jqXHR, exception);
                }
            })
        })
    }
    function kembali(){
        $('#input').fadeOut(300);
        $('#list').fadeIn(300);
    }
</script>