<zdiv class="container">
  <div class="row">
 
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3  from-wrapper">
    <center><img src="<?= base_url() ?>/img/SMK_N_3_TEGAL-removebg-preview.png" style="witdh: 150px;height: 150px;" alt=""><br>
			<h3><b>PUSTAKAGAMA </b>SMKN 3 TEGAL</h3>
      </center>
    <div class="container bg-white">
      
      <h3>Login</h3>
        <hr>
        <?php if (session()->get('success')): ?>
          <div class="alert alert-success" role="alert">
            <?= session()->get('success') ?>
          </div>
        <?php endif; ?>
        <form class="" action="<?= base_url() ?>/" method="post">
          <div class="form-group">
           <label for="username"><b>Username</b></label>
           <input type="text" class="form-control" name="username" placeholder="masukan username" id="username" value="<?= set_value('username') ?>">
          </div>
          <div class="form-group">
           <label for="password"><b>Password</b></label>
           <input type="password" class="form-control" name="password" placeholder="masukan password" id="password" value="">
          </div>
          <?php if (isset($validation)): ?>
            <div class="col-12">
              <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?>
              <button type="submit" class="btn btn-primary btn btn-primary btn-block">Login</button>
          
        </form>
        <br><br>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="mx-auto mt-4">
    </div>
  </div>
</div>
