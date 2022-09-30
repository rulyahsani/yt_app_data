<div class="container">
<?php echo $this->session->flashdata('sukses'); ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- <div class="col-md-2">
                    <div class="mb-3">
                        <button class="btn btn-success" type="button" data-coreui-toggle="modal" data-coreui-target="#themaModal">Insert</button>
                    </div>
                </div> -->
                <!-- <div class="col-md-6">
              <div class="card mb-4">
                <div class="card-header"><strong>Form control</strong><span class="small ms-1">Content</span></div>
                <div class="card-body">
                  <div class="msg" style="display:none"></div>
                  <div class="example">
                    <?php echo form_open('Content/add_data', ['class' => 'form_add'])?>
                    <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-739">
                        <div class="mb-3">
                          <label class="form-label" for="name_data">Name</label>
                          <input class="form-control" name="name_data" id="name_data" type="text" placeholder="Data Name">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="text_data">Description</label>
                          <textarea class="form-control" id="text_data" name="text_data" type="text" placeholder="Description"></textarea>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="content_data">Content</label>
                          <input class="form-control" name="content_data" id="content_data" type="text" placeholder="Content">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary text-white">Simpan</button>
                        </div>
                      </div>
                    </div>
                    <?php echo form_close()?>
                    
                  </div>
                </div>
              </div>
            
                </div> -->
                <div class="col-md-12">
                <div class="card mb-4">
                <div class="card-header"><strong>Form control</strong><span class="small ms-1">Image</span></div>
                <div class="card-body">
                  <div class="example">
                    <div class="alert alert-success" id="divMsg" style="display:none">
                        <span id="msg"></span>
                    </div>
                    <form action="" method="post" id="upload_form" enctype="multipart/form-data">
                    <div class="tab-content rounded-bottom">
                      <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-739">

                      <div class="row">
                        <div class="col-md-8">
                        <div class="mb-3">
                          <label class="form-label" for="name_data">Name</label>
                          <input class="form-control" name="name_data" id="name_data" type="text" placeholder="Data Name">
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="text_data">Description</label>
                          <textarea class="form-control" id="text_data" name="text_data" type="text" placeholder="Description"></textarea>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="content_data">Content</label>
                          <input class="form-control" name="content_data" id="content_data" type="text" placeholder="Content">
                        </div>
                        </div>
                        <div class="col-md-4">
                          
                        <div class="mb-3">
                          
                          <div class="card">
                            <div class="card-body mb-3">
                            <img id="blah" src="<?php echo base_url()?>/assets/img/user.jpg" alt="image Preview" width="100%"><br>
                            </div>
                          </div>
                          <label class="form-label" for="image">Image</label>
                          <input class="form-control" id="image" type="file" name="image" multiple="true" accept="image/*" onchange="readURL(this)" >
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
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Content</th>
                                        <th>Image</th>
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


<script>
function show_data() {
    

    $.ajax({
      type: "ajax",
      url: "<?php echo base_url()?>Content/dataview",
      async: false,
      dataType: 'JSON',
      success : function(data) {
        var html = '';
        var i;
        for(i = 0; i<data.length; i++){
          html += '<tr>'+
                  '<td>'+data[i].name_data+'</td>'+
                  '<td>'+data[i].text_data+'</td>'+
                  '<td>'+data[i].content_data+'</td>'+
                  '<td><img src="<?php echo base_url()?>assets/upload/'+data[i].image+'" width="100"></td>'+
                  '<td><a onclick="deletedata(' + data[i].id_data + ')" class="btn btn-danger btn-sm text-white">Hapus</td>'
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
    table = $('#table_id').DataTable({
          "order": [],

        });


    $('#upload_form').on('submit', function(e) {
      e.preventDefault();

      if ($('#image').val() == '') {
        alert("Please insert Image")
      } else {
        $.ajax({
          url: "<?php echo base_url() ?>Content/upload",
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

    
    // $('.form_add').submit(function(e){
    //   $.ajax({
    //     type: "post",
    //     url: $(this).attr('action'),
    //     data: $(this).serialize(),
    //     dataType: "json",
    //     success: function(res) {
    //       if(res.error) {
    //         $('.msg').html(res.error).show();
    //       }

    //       if(res.success) {
    //         Swal.fire({
    //         position: 'top-end',
    //         icon: 'success',
    //         title: 'Berhasil di Simpan',
    //         showConfirmButton: false,
    //         timer: 1500
    //       });
    //       show_data();
    //       }
          
    //     },
    //     error: function(xhr, ajaxOptions, throwError) {
    //       alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
    //     }

    //   });
    //   return false;
    // });

  });

  function deletedata(id) {
  const ask = confirm("Are You Sure?")

    if (ask) {
      $.ajax({
        type: 'POST',
        data: 'id_data=' + id,
        url: "<?php echo base_url('Content/deletedata') ?>",
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