<!-- Modal -->
<div class="modal fade" id="modal-upload" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <a href="" id="info_ujian_z" target="_blank" class="btn btn-danger mb-3">Informasi Persyaratan Ujian</a>
        <form action="" method="post" id="form-upload-persyaratan">
            <input type="hidden" name="id" value="">
            <div class="form-group">
                <input type="file" class="form-control" name="foto">
            </div>
            <button class="btn btn-success">Upload</button>
        </form>
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
        <h2 class="section-title">List data judul</h2>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="width: 100%;border: none;">
                    <br>
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="40px">No</th>
                            <th width="90px">Tgl</th>
                            <th>Judul Yang diverifikasi</th>
                            <th width="130">#</th>
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
    </div>
</section>

<script type="text/javascript">

    function load_data(){
            table = $('#myTable').DataTable({ 
                "destroy": true,
                "processing": true, //Feature control the processing indicator.
                "serverSide": true, //Feature control DataTables' server-side processing mode.
                "order": [], //Initial no order.

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": "<?php echo base_url();?>verifikasi/get_judul_terverifikasi",
                    "type": "POST",
                },

                //Set column definition initialisation properties.
                "columnDefs": [
                { 
                    "targets": [ 0,2,3], //first column / numbering column
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
                url : "<?=base_url('input/upload_v');?>",
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
    function kembali(){
        $('#input').fadeOut(300);
        $('#list').fadeIn(300);
    }

</script>