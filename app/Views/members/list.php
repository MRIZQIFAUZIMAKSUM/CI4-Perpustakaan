<div class="container">
    <div class="row">
        <div class="col-12 mt-3">
            <h2>Daftar Anggota</h2>
            <hr>
            <?php if (session()->get('success')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->get('success') ?>
            </div>
            <?php endif; ?>
            <?php if (session()->get('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->get('error') ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Member ID</th>
                        <th scope="col">nis</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">No. Telp</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tanggal Registrasi</th>

                        <?php if(session()->get('role')=="admin"):
              echo '<th scope="col">Action</th>';
            else:
                echo "";
            endif;
              ?>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0; 
                    foreach ($anggota as $anggota):?>
                    <tr>
                        <th scope="row"><?= $counter += 1 ?></th>
                        <td><?= $anggota['id']; ?></td>
                        <td><?= $anggota['nis']; ?></td>
                        <td><?= $anggota['fullname']; ?></td>
                        <td><?= $anggota['phone']; ?></td>
                        <td><?= $anggota['email']; ?></td>
                        <td><?= $anggota['created_at']; ?></td>
                        <?php if(session()->get('role')=="admin"):
              echo '
              <td><a href="members/edit/'.$anggota["id"].'" class="btn btn-success">Edit</a></td>
              <td><a href="members/delete/'.$anggota["id"].'" class="btn btn-danger">Delete</a></td>';
            else:
                echo "";
            endif;
              ?>
                    </tr>    
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>