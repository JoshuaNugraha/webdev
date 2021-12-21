
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
                    "url": "<?php echo base_url();?>input/get_judul_yg_ditawarkan?status=2",
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
    }

    $(document).ready(function(){
        load_data();
    })

    
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
    

</script>        