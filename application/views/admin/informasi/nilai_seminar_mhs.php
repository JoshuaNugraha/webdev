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


    <div class="section-body" id="input">
                <div id="isi"></div>
    </div>

    <div class="section-body" id="list">
        <h2 class="section-title">List Seminar</h2>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" style="width: 100%;border: none;">
                        <br>
                        <table id="myTable" class="table table-bordered table-hover" width="99%">
                            <thead>
                            <tr>
                                <th width="40px">No</th>
                                <th>Judul</th>
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
                    "url": "<?php echo base_url();?>informasi/nilai_mhs",
                    "type": "POST",
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ 0,1,2 ], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                ],

            });
    }

    $(document).ready(function(){
        $('#input').fadeOut(300);
        load_data();
    })

    
   function detail(id){
        get_token(function(data){
            $.ajax({
                type : "POST",
                data : ({['csrf_am']: data.csrf_token,id}),
                url : "<?=base_url('informasi/nilai');?>",
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