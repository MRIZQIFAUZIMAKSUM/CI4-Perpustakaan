<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3>Register</h3>
        <hr>
        <form class="" action="<?= base_url() ?>/register" method="post">
          <div class="row">
          <div class="col-12">
          <div class="form-group">
               <label for="firstname">Cek nis </label>
               <input type="number" name="member_id" id="member_id" class="form-control" placeholder="ID" value="<?= set_value('member_id') ?>"><br>
                    <div class="input-group-append">
                        <button onclick="cekMember()" class="btn btn-outline-secondary" type="button">Check</button>
                    </div>
</div>
</div>
            <div class="col-12 col-sm-6">

              <div class="form-group">
               <label for="firstname">First Name</label>
               <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="lastname">Last Name</label>
               <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname') ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
               <label for="username">Email</label>
               <input type="email" class="form-control" name="username" id="username" value="<?= set_value('username') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="password">Password</label>
               <input type="password" class="form-control" name="password" id="password" value="">
             </div>
           </div>
           <div class="col-12 col-sm-6">
             <div class="form-group">
              <label for="password_confirm">Confirm Password</label>
              <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
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
              <button type="submit" class="btn btn-primary">Register</button>
            </div>
            <div class="col-12 col-sm-8 text-right">
              <a href="<?= base_url() ?>/login">Already have an account</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>


</script>
