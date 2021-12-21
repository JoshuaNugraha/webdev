<!-- Modal -->

<!-- akhir modal -->


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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Mahasiswa S2</h4>
                         <div class="table-responsive" style="width: 100%;border: none;">
                            <table id="myTable" class="table table-bordered table-hover" width="99%">
                                <thead>
                                <tr>
                                    <th width="40px">No</th>
                                    <th>Data Mahasiswa</th>
                                    <th>Judul Seminar</th>
                                    <th width="50px">#</th>
                                </tr>
                                </thead>    
                                <tbody>
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4>Mahasiswa S3</h4>
                         <div class="table-responsive" style="width: 100%;border: none;">
                            <table id="myTable2" class="table table-bordered table-hover" width="99%">
                                <thead>
                                <tr>
                                    <th width="40px">No</th>
                                    <th>Data Mahasiswa</th>
                                    <th>Judul Seminar</th>
                                    <th width="50px">#</th>
                                </tr>
                                </thead>    
                                <tbody>
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body" id="input">
                <div id="isi"></div>
    </div>
</section>

<script>
    function load_data(){
            table = $('#myTable').DataTable({ 
                "destroy": true,
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo base_url();?>input/get_data_dosen_insert_nilai?s=2",
                    "type": "POST",
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ 0,1,2,3 ], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                ],

            });
    }

    function load_data2(){
            table = $('#myTable2').DataTable({ 
                "destroy": true,
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo base_url();?>input/get_data_dosen_insert_nilai?s=3",
                    "type": "POST",
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ 0,1,2,3 ], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                ],

            });
    }

    $(document).ready(function(){
        // $('#input').hide();
        
        load_data();
        load_data2();
    });

    function detail(id){
        get_token(function(data){
            $.ajax({
                type : "POST",
                data : ({['csrf_am']: data.csrf_token,id}),
                url : "<?=base_url('input/input_nilai');?>",
                success : function(data){
                    $("#isi").html(data);
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