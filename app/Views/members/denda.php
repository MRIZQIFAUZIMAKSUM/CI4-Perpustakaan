<div class="container">
    <div class="row">
        <div class="col-12 mt-3">
            <h2>Denda</h2>
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
                        <th scope="col">Peminjam</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Kembali</th>
                        <th scope="col">Denda</th>
                        <?php if(session()->get('id')==1):
              echo '<th scope="col">Action</th>';
            else:
                echo "";
            endif;
              ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0; 
                    foreach ($denda as $denda):?>
                    <tr>
                        <th scope="row"><?= $counter += 1 ?></th>
                        <td><?=$denda['fullname']; ?></td>
                        <td><?=$denda['judul']; ?></td>
                        <td><?=$denda['ISBN']; ?></td>
                        <td><?=$denda['tanggal_pinjam']; ?></td>
                        <td><?=$denda['tanggal_kembali']; ?></td>
                        <td>
                            <?php
                                //Denda 2000 per hari
                                $bayar = 2000;
                                $now = time();
                                $tanggal_kembali = strtotime($denda['tanggal_kembali']);
                                $datediff = $now - $tanggal_kembali;
                                if ($now<$tanggal_kembali){

                                }
                                else{
                                echo 'Rp'.number_format(round($datediff / (60 * 60 * 24))*$bayar, 0, '.', ','); 
                                }
                            ?>
                        </td>
                        <?php if(session()->get('id')==1):
              echo '<td><a href="delete_denda/'.$denda["id"].'" class="btn btn-danger">Sudah bayar</a></td>';
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