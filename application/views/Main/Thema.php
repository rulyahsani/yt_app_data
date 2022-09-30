<div class="container">
  <?php echo $this->session->flashdata('sukses'); ?>
  <div class="card">
    <div class="card-body">
      <div class="row">

        <div class="col-md-12">
          <div class="card mb-4">
            <div class="card-header"><strong>Form control</strong><span class="small ms-1">Background</span></div>
            <div class="card-body">
              <div class="example">
                <div class="alert alert-success" id="divMsg" style="display:none">
                  <span id="msg"></span>
                </div>
                <form action="" method="post" id="upload_form" enctype="multipart/form-data">
                  <div class="tab-content rounded-bottom">
                    <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-739">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="headtitle">Head Title</label>
                            <input class="form-control" name="head_title" id="head_title" type="text" placeholder="Watching Data">
                          </div>
                          <div class="mb-3">
                            <label class="form-label" for="subtitle">Subtitle</label>
                            <input class="form-control" id="subtitle" name="subtitle" type="text" placeholder="Subtitle Header">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">

                            <div class="card">
                              <div class="card-body mb-3">
                                <img id="blah" src="<?php echo base_url() ?>/assets/img/image.jpg" alt="image Preview" width="100%"><br>
                              </div>
                            </div>
                            <label class="form-label" for="background">Background Image</label>
                            <input class="form-control" id="background" type="file" name="background" multiple="true" accept="image/*" onchange="readURL(this)">
                          </div>
                        </div>
                      </div>



                      <div class="mb-3">
                        <button type="submit" name="upload" id="upload" value="upload" class="btn btn-primary text-white">Simpan</button>
                      </div>
                    </div>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">

              <table id="table_id" class="display">
                <thead>
                  <tr>
                    <th>Head Title</th>
                    <th>Subtitle</th>
                    <th>Background Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="show_data">

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal start -->


<div class="modal fade" id="exampleModalLive" tabindex="-1" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLiveLabel">Modal title</h5>
          <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label" for="headtitle">Head Title</label>
            <input class="form-control" value="" name="head_title" id="head_title" type="text" placeholder="Watching Data">
          </div>
          <div class="mb-3">
            <label class="form-label" for="subtitle">Subtitle</label>
            <input class="form-control" id="subtitle" name="subtitle" type="text" placeholder="Subtitle Header">
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="button">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal end -->



<script>
  function show_data() {
    $.ajax({
      type: "ajax",
      url: "<?php echo base_url() ?>Thema/dataview",
      async: false,
      dataType: 'JSON',
      success: function(data) {
        var html = '';
        var i;
        for (i = 0; i < data.length; i++) {
          html += '<tr>' +
            '<td>' + data[i].head_title + '</td>' +
            '<td>' + data[i].subtitle + '</td>' +
            '<td><img src="<?php echo base_url() ?>assets/upload/' + data[i].background + '" width="100"></td>' +
            '<td><a onclick="deletedata(' + data[i].id_setting + ')" class="btn btn-danger btn-sm text-white">Hapus</td>'
          '</tr>';
        }
        $('#show_data').html(html);
      }
    });
  }

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  $(document).ready(function() {
    show_data();

    var dataTable = $('#table_id').DataTable({
      "order": [],

    });

    $('#upload_form').on('submit', function(e) {
      e.preventDefault();

      if ($('#background').val() == '') {
        alert("Please insert Image")
      } else {
        $.ajax({
          url: "<?php echo base_url() ?>Thema/upload",
          type: "POST",
          data: new FormData(this),
          contentType: false,
          cache: false,
          processData: false,
          success: function(data) {

            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Berhasil di Simpan',
              showConfirmButton: false,
              timer: 1500
            });
            show_data();

          },

          error: function(xhr, ajaxOptions, throwError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
          }

        })
      }
    });


  });

  function update(x) {
    $({
      type: "POST",
      data: 'id=' + x,
      url: '<?php echo base_url('Thema/getId') ?>',
      dataType: 'json',
      success: function(result) {
        $('[name="head_title"]').val(result[0].head_title);
      }
    })
  }


  // $(document).ready(function() {
  //   show_data();
  //   $('.form_add').submit(function(e) {
  //     $.ajax({
  //       type: "post",
  //       url: $(this).attr('action'),
  //       data: $(this).serialize(),
  //       dataType: "json",
  //       success: function(res) {
  //         if (res.error) {
  //           $('.msg').html(res.error).show();
  //         }

  //         if (res.success) {
  //           Swal.fire({
  //             position: 'top-end',
  //             icon: 'success',
  //             title: 'Berhasil di Simpan',
  //             showConfirmButton: false,
  //             timer: 1500
  //           });
  //           show_data();
  //         }
  //       },
  //       error: function(xhr, ajaxOptions, throwError) {
  //         alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
  //       }

  //     });
  //     return false;
  //   });




  // });

  function deletedata(id) {
    const ask = confirm("Are You Sure?")

    if (ask) {
      $.ajax({
        type: 'POST',
        data: 'id_setting=' + id,
        url: "<?php echo base_url('Thema/deletedata') ?>",
        success: function() {
          Swal.fire({
            position: 'top-end',
            icon: 'danger',
            title: 'Berhasil di Hapus',
            showConfirmButton: false,
            timer: 1500
          });
          show_data();
        }

      })
    }
  }
</script>