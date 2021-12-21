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
        <h2 class="section-title">List</h2>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" style="width: 100%;border: none;">
                        <br>
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="40px">No</th>
                                <th width="80px">Tgl</th>
                                <th>Mahasiswa</th>
                                <th>Prodi</th>
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
    <div id="input"></div>
</section>
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
                    "url": "<?php echo base_url();?>input/get_judul_up_persyaratan",
                    "type": "POST",
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ 0,2,3,4,5 ], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                ],

            });
    }

    function detail(id){
        get_token(function(data){
            $.ajax({
                type : "POST",
                data : ({['csrf_am']: data.csrf_token,id}),
                url : "<?=base_url('input/persyaratan_s');?>",
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

    $(document).ready(function(){
        $('#input').hide();
        load_data();
    })

</script>