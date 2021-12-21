<!-- Main content -->
<!-- Main content -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background-color: #f8f8f8;">
      <div class="modal-header">
        <h5 class="modal-title">Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
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

    <div class="section-body" id="list">
        <h2 class="section-title">List <?=$title?></h2>
            <div class="card">
                <div class="card-body">
      
                    <div>
                        <button id="tblTambah" class="btn btn-success waves-effect waves-light btn-sm" type="button" onclick="tambah();return false;">
                            <span class="btn-label"><i class="fa fa-plus-square"></i></span> Tambah
                        </button>
                    </div>
                    <div class="table-responsive" style="width: 100%;border: none;">
                        <br>
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="40px">No</th>
                                <th width="80px">Tgl</th>
                                <th>Judul</th>
                                <th>Status</th>
                                <th width="70px">#</th>
                            </tr>
                            </thead>    
                            <tbody>
                            </tbody>
                        </table>
                        <br>
                    </div><!--- /table-responsive --->
                
                </div>
            </div>

    </div>

    <div class="section-body" id="input">
        <h2 class="section-title"><span id="stat_input">Tambah</span> <?=$title?></h2>
            
            <form id="form_data" action="" method="post">
                <input type="hidden" name="kode" id="kode">
                <input type="hidden" name="aksi" id="aksi" value="1">    

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <b>Judul 1</b>
                                    <input type="text" class="form-control" required="" name="judul1">
                                </div>
                                <div class="form-group">
                                    <b>Keterangan</b>
                                    <textarea id="summernote1" name="keterangan1" required=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <b>Judul 2</b>
                                    <input type="text" class="form-control" required="" name="judul2">
                                </div>
                                <div class="form-group">
                                    <b>Keterangan</b>
                                    <textarea id="summernote2" name="keterangan2" required=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <b>Judul 3</b>
                                    <input type="text" class="form-control" required="" name="judul3">
                                </div>
                                <div class="form-group">
                                    <b>Keterangan</b>
                                    <textarea id="summernote3" name="keterangan3" required=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- row -->
                
                <button class="btn btn-danger waves-effect waves-light btn-sm" type="button" onclick="kembali();return false;">
                    <span class="btn-label"><i class="fa fa-reply"></i></span> Kembali
                </button>
                <button class="btn btn-success waves-effect waves-light btn-sm" type="submit">
                    <span class="btn-label"><i class="fa fa-save"></i></span> <span id="simpan">Simpan</span>
                </button>
                
            </form> 
                    
    </div>

</section>

</section>
<!-- /.content --> 

<script type="text/javascript">
    var table;
    var otori = "1";

    function load_data(){
            table = $('#myTable').DataTable({ 
                "destroy": true,
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo base_url();?>input/get_judul_yg_ditawarkan",
                    "type": "POST",
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ 0,2,3,4 ], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                ],

            });
            cek_data();
    }

    function cek_data(){
        get_token(function(data){
        $.ajax({
                type : "GET",
                data : ({['csrf_am']: data.csrf_token}),
                url : "<?=base_url('input/cek_data');?>",
                success : function(data){
                    if (data == "ok"){
                        $("#tblTambah").hide();
                    } else {
                        $("#tblTambah").show();
                    }
                },
                error: function (jqXHR, exception) {
                    load_error(jqXHR, exception);
                }
            })
        })
    }

    $(document).ready(function(){
        $('#input').hide();
        $('#summernote1').summernote({
            height:250
        });
        $('#summernote2').summernote({
            height:250
        });
        $('#summernote3').summernote({
            height:250
        });
        load_data();
    })

    function tambah(){
        $('#stat_input').html('Tambah');
        $('#simpan').html('Simpan');
        $('#aksi').val('1');
        $('#form_data').each(function(){this.reset();});
        $('#list').fadeOut(300);
        $('#input').fadeIn(300);
    }
    function kembali(){
        $('#input').fadeOut(300);
        $('#list').fadeIn(300);
    }

    function detail(id){
        get_token(function(data){
            $.ajax({
                type : "POST",
                data : ({['csrf_am']: data.csrf_token,id}),
                url : "<?=base_url('input/detail');?>",
                success : function(data){
                    $("#myModal .modal-body").html(data);
                    $("#myModal").modal("show");
                },
                error: function (jqXHR, exception) {
                    load_error(jqXHR, exception);
                }
            })
        })
    }
    
    $("#form_data").on("submit",function(e){
        e.preventDefault();
        let formData = new FormData(this);
        get_token(function(data){
            formData.append(['csrf_am'], data.csrf_token);
            $.ajax({
                type : "POST",
                url : '<?=base_url('input/simpan_data_judul');?>',
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

    function edit(id,table){
        $('#stat_input').html('Ubah');
        $('#simpan').html('Simpan Perubahan');
        $('#kode').val(id);
        $('#aksi').val('2');
        get_token(function(data){
            $.ajax({
                type : "POST",
                dataType : "json",
                data : ({['csrf_am']: data.csrf_token,id,table}),
                url : "<?=base_url('index.php/admin/edit');?>",
                success : function(data){
                    $("[name='judul']").val(data.judul);

                    $('#list').fadeOut(300);
                    $('#input').fadeIn(300);
                },
                error: function (jqXHR, exception) {
                    load_error(jqXHR, exception);
                }
            })
        })
    }

    function update_status(id){
        status_user = $('#status_user_'+id).val();
        get_token(function(data){
            $.ajax({
                type : "POST",
                dataType : "json",
                data : ({['csrf_am']: data.csrf_token,id,status_user}),
                url : "<?=base_url('index.php/users/update_status_user');?>",
                success : function(data){
                    
                },
                error: function (jqXHR, exception) {
                    load_error(jqXHR, exception);
                }
            })
        })
    }

    function hapus(id,tabel){
        swal({
            title: "Anda Yakin ?",
            text: "Menghapus Data",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya Hapus",
            closeOnConfirm: false
        },
        function(){
            get_token(function(data){
                $.ajax({
                dataType : 'json',
                type : 'POST',
                data : ({['csrf_am']: data.csrf_token,tabel,field:'id',id}),
                url : "<?=base_url('index.php/admin/hapus');?>",
                success : function(data){
                    if(data.status == true){
                        swal("Success", data.message, "success");
                        load_data();
                    }else{
                        swal("Gagal", data.message, "warning");
                    }
                },
                    error: function (jqXHR, exception) {
                        load_error(jqXHR, exception);
                    }
                });
            })
        });
    } 

</script>        