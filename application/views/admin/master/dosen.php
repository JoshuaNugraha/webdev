<!-- Main content -->
<!-- Main content -->
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
                        <button class="btn btn-success waves-effect waves-light btn-sm" type="button" onclick="tambah();return false;">
                            <span class="btn-label"><i class="fa fa-plus-square"></i></span> Tambah
                        </button>
                    </div>
                    <div class="table-responsive" style="width: 100%;border: none;">
                        <br>
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="40px">No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Email</th>
                                <th>Nohp</th>
                                <th>#</th>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div style="background-color: #f8f8f8;border-radius: 5px;padding: 15px">
                                    <div class="row">
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <b>Nama Lengkap</b> *
                                            <input type="text" class="form-control" name="nama" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <b>Email</b> *
                                            <input type="email" class="form-control" name="email" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <b>Nomor HP</b> *
                                            <input type="tel" class="form-control" name="nohp" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <b>NIP</b> *
                                            <input type="text" class="form-control" name="nip" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <b>Agama</b>
                                            <input type="text" class="form-control" name="agama">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <b>Status Kawin</b> *
                                            <select name="status_kawin" class="form-control" required="">
                                                <option value="Belum Menikah">Belum Menikah</option>
                                                <option value="Menikah">Menikah</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <b>Jabatan</b>
                                            <input type="text" class="form-control" name="jabatan" >
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <div class="form-group">
                                            <b>Perguruan Tinggi</b>
                                            <input type="text" class="form-control" name="perguruan_tinggi" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <b>Alamat Lengkap</b> *
                                            <textarea name="alamat" class="form-control" required="" style="height: 150px"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <b>Buat Password</b>
                                            <input type="text" class="form-control" id="password" name="password">
                                            <span style="font-size: 12px;color: red">Buat Password baru untuk data baru. | Ganti password untuk data lama</span>
                                        </div>
                                    </div>
                                </div>
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
                    "url": "<?php echo base_url();?>master/get_dosen",
                    "type": "POST",
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ 0,5 ], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                ],

            });
    }

    $(document).ready(function(){
        $('#input').hide();
        
        load_data();
    })

    function tambah(){
        $('#stat_input').html('Tambah');
        $('#simpan').html('Simpan');
         $("[name='email']").removeAttr("readonly");
        $('#aksi').val('1');
        $('#form_data').each(function(){this.reset();});
        $('#list').fadeOut(300);
        $('#input').fadeIn(300);
    }
    function kembali(){
        $('#input').fadeOut(300);
        $('#list').fadeIn(300);
    }
    
    $("#form_data").on("submit",function(e){
        e.preventDefault();
        let formData = new FormData(this);

        let aksi = $('#aksi').val();
        if (aksi == '1'){
            if($('#password').val() == ''){
                swal('Warning','Password tidak boleh kosong..','warning');
                return false;
            }
        } 

        get_token(function(data){
            formData.append(['csrf_am'], data.csrf_token);
            $.ajax({
                type : "POST",
                url : '<?=base_url('master/simpan_dosen');?>',
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
                    $("[name='nama']").val(data.nama);
                    $("[name='email']").val(data.email);
                      $("[name='email']").attr("readonly","");
                    $("[name='nohp']").val(data.nohp);
                    $("[name='nik']").val(data.nik);
                    $("[name='agama']").val(data.agama);
                    $("[name='status_kawin']").val(data.status_kawin);
                    $("[name='jabatan']").val(data.jabatan);
                    $("[name='perguruan_tinggi']").val(data.perguruan_tinggi);
                    $("[name='alamat']").val(data.alamat);
                    $("[name='prodi']").val(data.prodi).trigger("change");
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