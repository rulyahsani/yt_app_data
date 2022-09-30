
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card-group d-block d-md-flex row">
              <div class="card col-md-7 p-4 mb-0">
                <div class="card-body">
                  <h1 class="text-center">Login</h1>
                  <p class="text-medium-emphasis text-center">Kreasi Tanpa Henti, Demi Jutaan Dolar</p>
                  <?php echo $this->session->flashdata('sukses'); ?>

                  <form action="<?php echo base_url('Auth'); ?>" method="post">

                  
                  <div class="input-group mb-3"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="<?php echo base_url()?>assets/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                      </svg></span>
                    <input class="form-control" type="text" name="username"  placeholder="Username">
                  </div>
                  <div class="input-group mb-4"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="<?php echo base_url()?>assets/vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                      </svg></span>
                    <input class="form-control" name="password" type="password" placeholder="Password">
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button class="btn btn-primary px-4" type="submit">Login</button>
                    </div>
                    <div class="col-6 text-end">

                  </div>
                </div>
                </form>
  

              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>