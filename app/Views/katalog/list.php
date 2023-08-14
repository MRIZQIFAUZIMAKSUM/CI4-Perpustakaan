<div class="container">
    <div class="row">
        <div class="col-12 mt-3">
            <h2>Katalog Buku</h2>
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
        <div class="mb-3">
            <table class="table table-hover" id="tabel_buku">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Pengarang</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Tahun Terbit</th>    
                        <th scope="col">Ditambahkan pada</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0; 
                    foreach ($buku as $buku):?>
                    <tr class="clickable">
                        <th scope="row"><?= $counter += 1 ?></th>
                        <td><img src="<?= $buku['Image-URL-M']; ?>"loading="lazy"></td>
                        <td><?= $buku['Book-Title']; ?></td>
                        <td><?= $buku['Book-Author']; ?></td>
                        <td><?= $buku['ISBN']; ?></td>
                        <td><?= $buku['Publisher']; ?></td>
                        <td><?= $buku['Year-Of-Publication']; ?></td>
                        <td><?= $buku['created_at']; ?></td>
                        <?php if(session()->get('role')=="admin"):?>
                        <td><a href="<?= base_url() ?>/katalog/edit/<?=$buku['id'];?>" class="btn btn-success">Edit</a></td>
                        <td><a href="<?= base_url() ?>/katalog/delete/<?=$buku['id'];?>" class="btn btn-danger">Delete</a></td>
                        <?php else:?>
                        <td><a href="<?= base_url() ?>/katalog/pinjam_buku?isbn=<?=$buku['ISBN'];?>" class="btn btn-success">Pinjam Buku</a></td>
                        <?php endif; ?>
                    </tr>
                   
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>
