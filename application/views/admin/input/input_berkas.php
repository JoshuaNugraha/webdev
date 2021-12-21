<script>
 
function validateFileType(i){
  let file = document.getElementById("berkas"+i);
  
  var fileName = document.getElementById("berkas"+i).value;
  idxDot = fileName.lastIndexOf(".") + 1,
  extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
  if (extFile=="doc" || extFile=="docx" || extFile=="pdf"){
    document.getElementById('upload-file'+i).disabled = false;
    
    $("#uploadForm"+i).on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url().'master/berkas_upload' ?>',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,

                    beforeSend: function(){
                       
                    },
                    error: function(data){
                        
                       
                    },
                    success: function(response){
                        if(response=="sukses"){
                        $('#uploadForm'+i)[0].reset();
                        $('#uploadStatus'+i).html('<span style="color:#32CD32;">File berhasil diunggah</span>');
                        }else if(response=="gagal"){
                           
                            $('#uploadStatus'+i).html('<span style="color:#FF0000;">Gagal Mengunggah File</span>');
                        }
                        else if(response=="fileexisted"){
                           
                           alert("file existed");
                       }
                        
                         
                    }
                });
                
            });
  }else{
            alert("Only DOC , DOCX , PDF files are allowed!");
            document.getElementById('upload-file'+i).disabled = true;
            console.log("error");
            file.value = "";  // Reset the input so no files are uploaded
        }
}


</script>

<section class="section">
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

<?php 

$berkas = array(
    "1" => array("img" => $table[0]->undangan_gagasan_awal,
                "nama" => "Undangan Gagasan Awal",
                "table" => "undangan_gagasan_awal",
                "no" => "1"),
                
    "2" => array("img" => $table[0]->undangan_proposal,
    "nama" => "Undangan Proposal",
    "table" => "undangan_proposal",
    "no" => "2"),

    "3" => array("img" => $table[0]->keterangan_perbaikan_proposal,
    "nama" => "Keterangan Perbaikan Proposal",
    "table" => "keterangan_perbaikan_proposal",
    "no" => "2 . 1"),

    "4" => array("img" => $table[0]->undangan_hasil,
    "nama" => "Undangan Hasil",
    "table" => "undangan_hasil",
    "no" => "3"),

    "5" => array("img" => $table[0]->keterangan_perbaikan_hasil,
    "nama" => "Keterangan Perbaiakan Hasil",
    "table" => "keterangan_perbaikan_hasil",
    "no" => "3 . 1"),

    "6" => array("img" => $table[0]->undangan_tutup,
    "nama" => "Undangan Tutup",
    "table" => "undangan_tutup",
    "no" => "4"),

    "7" => array("img" => $table[0]->perbaikan_tutup,
    "nama" => "Perbaikan Tutup",
    "table" => "perbaikan_tutup",
    "no" => "4 . 1"),

    "8" => array("img" => $table[0]->undangan_timbang_promosi,
    "nama" => "Undangan Timbang Promosi",
    "table" => "undangan_timbang_promosi",
    "no" => "5"),

    "9" => array("img" => $table[0]->berita_acara_timbang_promosi,
    "nama" => "Berita Acara Timbang Promosi",
    "table" => "berita_acara_timbang_promosi",
    "no" => "5 . 1"),

    "10" => array("img" => $table[0]->undangan_promosi,
    "nama" => "Undangan Promosi",
    "table" => "undangan_promosi",
    "no" => "6"),

    "11" => array("img" => $table[0]->persetujuan_promosi,
    "nama" => "Persetujuan Promosi",
    "table" => "persetujuan_promosi",
    "no" => "6 . 1"),

    "12" => array("img" => $table[0]->berita_acara_penilaian_ujian_tutup,
    "nama" => "Berita Acara Penilaian Ujian Tutup",
    "table" => "berita_acara_penilaian_ujian_tutup",
    "no" => "7"),

    "13" => array("img" => $table[0]->berita_acara_promosi,
    "nama" => "Berita Acara Promosi",
    "table" => "berita_acara_promosi",
    "no" => "8"),

    "14" => array("img" => $table[0]->format_lembar_penilaian_proposal,
    "nama" => "Format Lembar Penilaian Proposal",
    "table" => "format_lembar_penilaian_proposal",
    "no" => "9"),

    "15" => array("img" => $table[0]->format_lembar_penilaian_ujian_lisan,
    "nama" => "Format Lembar Penilaian ujian Lisan",
    "table" => "format_lembar_penilaian_ujian_lisan",
    "no" => "10"),

    "16" => array("img" => $table[0]->penilaian_hasil,
    "nama" => "Penilaian Hasil",
    "table" => "penilaian_hasil",
    "no" => "11"),

    "17" => array("img" => $table[0]->penilaian_proposal,
    "nama" => "Penilaian Proposal",
    "table" => "penilaian_proposal",
    "no" => "12")
);

?>



    
       
            <div class="card">
                <div class="card-body">
                    <h6>Persyaratan Ujian S2</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr style="background-color: #f5f5f5">
                                <th>No</th>
                                <th>Berkas</th>
                                <th>Preview Berkas</th>
                                <th>Upload Berkas</th>
                            </tr>

                            <?php
                            
                            for($no=1; $no<18; $no++){ ?>
                            <tr>
                                <td><?= $berkas[$no]['no']; ?></td>
                                <td><?= $berkas[$no]['nama']; ?></td>
                                <td> 
                                    <a href="<?= base_url("assets/PTK/").$berkas[$no]['img']?>.pdf" target="_blank" class="btn btn-primary">Lihat Preview</a>
                                </td>
                                <td width="380px">
                                <form id="uploadForm<?=$no;?>" style="display:'';" class="form-b" enctype='multipart/form-data'>
                                
                                      
                                        <div class="input-group">
                                          Download File PDF
                                          <div class="input-group-append">
                                            <button class="btn btn-success" id="upload-file<?=$no;?>" type="submit"><i class="fa fa-file-pdf"></i></button>
                                          </div>
                                        </div>
                                    </form>
                                <div id="uploadStatus<?= $no; ?>"></div>
                                </td>
                            </tr>
                        <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
 

          
</section>

