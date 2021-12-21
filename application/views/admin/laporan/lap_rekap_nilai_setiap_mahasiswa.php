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

    <div class="section-body" id="list">
        <div class="card">
            <div class="card-body">
                <form action="" method="post" id="form-laporan">
                    <div class="row">
                        <div class="col-md-6 col-lg-3 col-xl-2">
                            <div class="form-group">
                                Pendidikan
                                <select name="pendidikan" class="form-control" onchange="get_mhs(this.value)" required="">
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                Mahasiswa
                                <select name="id_mahasiswa" id="d_mhs" onchange="get_judul(this.value)" class="form-control select2" required="">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 col-xl-6">
                            <div class="form-group">
                                Judul
                                <select name="judul" id="d_judul" class="form-control select2" required="">
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function(){
        get_mhs('S2');
    });
    function get_mhs(jenis){
        get_token(function(data){
            $.ajax({
                type : "POST",
                data : ({['csrf_am']: data.csrf_token,jenis}),
                url : "<?=base_url('laporan/get_mhs_by_jenis');?>",
                success : function(hm){
                    $("#d_mhs").html(hm);
                },
                error: function (jqXHR, exception) {
                    load_error(jqXHR, exception);
                }
            })
        })
    }

    function get_judul(id_mhs){
        get_token(function(data){
            $.ajax({
                type : "POST",
                data : ({['csrf_am']: data.csrf_token,id_mhs}),
                url : "<?=base_url('laporan/get_judul_by_mhs');?>",
                success : function(hm){
                    $("#d_judul").html(hm);
                },
                error: function (jqXHR, exception) {
                    load_error(jqXHR, exception);
                }
            })
        })
    }
</script>