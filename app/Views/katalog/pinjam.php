<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-4 mb-4 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3>Pinjam Buku</h3>
        <hr>
        <?php if (session()->get('success')): ?>
          <div class="alert alert-success" role="alert">
            <?= session()->get('success') ?>
          </div>
        <?php endif; ?>
        <form class="" action="<?= base_url() ?>/katalog/pinjam_buku" method="post">
          <input type="hidden" name="book_id" id="book_id" value="<?= set_value('book_id') ?>">
          <div class="row">
                
          <?php if(session()->get('role')=="admin"){
              echo '<div class="col-12">
              <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Member ID</label>
                    </div>
                    <input type="text" name="member_id" id="member_id" class="form-control" placeholder="ID" value="">
                    <div class="input-group-append">
                        <button onclick="cekMember()" class="btn btn-outline-secondary" type="button">Check</button>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Nama Anggota</label>
                    </div>
                    <input type="text" readonly name="fullname" id="fullname" class="form-control" value="">
              
                </div>
              </div>
            </div>';
            }
            else{
              echo '<input type="hidden" name="member_id" id="member_id" class="form-control" placeholder="ID" value="'.session()->get('nis').'">
              <input type="hidden" readonly name="fullname" id="fullname" class="form-control" value="'.session()->get('firstname')." ".session()->get('lastname').'">';
            }
              ?>
         
            <div class="col-12">
              <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                    <label class="input-group-text">Kode ISBN</label>
                    </div>
                    <input type="text" name="ISBN" id="ISBN" class="form-control" placeholder="ISBN" value="<?= set_value('ISBN') ?><?php if(isset($_GET['isbn'])){echo $_GET['isbn'];}?>">
                    <div class="input-group-append">
                        <button onclick="cekBuku()" class="btn btn-outline-secondary" type="button">Check</button>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Judul Buku</label>
                    </div>
                    <input type="text" readonly name="judul" id="judul" class="form-control" value="<?= set_value('judul') ?>">
                </div>
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
</div>
