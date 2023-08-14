<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3>Tambah Anggota</h3>
        <hr>
        <?php if (session()->get('success')): ?>
          <div class="alert alert-success" role="alert">
            <?= session()->get('success') ?>
          </div>
        <?php endif; ?>
        <form class="" action="<?= base_url() ?>/members/add_admin" method="post">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
               <label for="nis">first name</label>
               <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname') ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
               <label for="nis">last name</label>
               <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname') ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
               <label for="nis">email</label>
               <input type="email" class="form-control" name="username" id="username" value="<?= set_value('username') ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
               <label for="password">password</label>
               <input type="password" class="form-control" name="password" id="password" value="<?= set_value('password') ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
               <label for="password_confirm">confirm password</label>
               <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="<?= set_value('password_confirm') ?>">
              </div>
            </div>
           
          <?php if (isset($validation)): ?>
            <div class="col-12">
              <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?>
          </div>

          <div class="row">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="row">
      <span style="visibility: hidden">dddd</span>
  </div>
</div>
