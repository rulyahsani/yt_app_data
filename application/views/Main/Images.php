<div class="body flex-grow-1 px-3">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
            <div class="row">
        <div class="col-4">
                        <div class="card mb-4">
                            <div class="card-header"><strong>Form</strong><span class="small ms-1">Image</span></div>
                            <div class="card-body">
                                <div class="example">

                                    <form action="" method="post" id="form_image" enctype="multipart/form-data">
                                        <div class="tab-content rounded-bottom">
                                            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-739">
                                                <div class="mb-3">
                                                    <label class="form-label" for="name">Name</label>
                                                    <input class="form-control" id="name" name="name" type="text" placeholder="name@example.com">
                                                </div>
                                                <div class="mb-3">
                          
                                                    <div class="card">
                                                        <div class="card-body mb-3">
                                                        <img id="blah" src="<?php echo base_url()?>/assets/img/image.jpg" alt="image Preview" width="100%"><br>
                                                        </div>
                                                    </div>
                                                    <label class="form-label" for="img">Image</label>
                                                    <input class="form-control" id="img" type="file" name="img" multiple="true" accept="image/*" onchange="readURL(this)" >
                                                    </div>
                                                <div class="mb-3">
                                                    <button type="submit" id="submit" type="submit" class="btn btn-danger">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">

                                <table id="table_id" class="display">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data">
                                        <!-- <?php foreach ($dataimage as $row) : ?>
                                            <tr>
                                                <td><?php echo $row->name ?></td>
                                                <td><?php echo $row->img ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('Images/delete') ?>">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                   
            </div>
        </div>
        <!-- /.row-->
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> © 2022 creativeLabs.</div>
    <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
</footer>
</div>

<script>
view_data();

function view_data() {
   
    $.ajax({
      type: "ajax",
      url: "<?php echo base_url()?>Images/dataview",
      async: false,
      dataType: 'JSON',
      success : function(data) {
        var html = '';
        var i;
        for(i = 0; i<data.length; i++){
          html += '<tr>'+
                  '<td>'+data[i].name+'</td>'+
                  '<td><img src="<?php echo base_url()?>assets/upload/'+data[i].img+'" width="100"></td>'+
                  '<td>'+
                    '<a class="btn btn-danger btn-sm text-white" href="<?php echo base_url('Images/delete')?>">delete</a>'
                  +'</td>'
                  '</tr>';
        }
        $('#data').html(html);
      }
    });
  }

    $(document).ready(function() {
        table = $('#table_id').DataTable({
            "order": [],

        });
    });

    function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }


  $('#form_image').on('submit', function(e) {
      e.preventDefault();

      if ($('#img').val() == '') {
        alert("Please insert Image")
      } else {
        $.ajax({
          url: "<?php echo base_url() ?>Images/upload",
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
              view_data();
            
          },

          error: function(xhr, ajaxOptions, throwError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
        }

        })
      }
    });
</script>