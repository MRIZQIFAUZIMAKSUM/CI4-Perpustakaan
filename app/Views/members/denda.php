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
                        <?php if(session()->get('role')=="admin"):?>
             <th scope="col">Action</th>
            <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $counter = 0; 
                    foreach ($denda as $denda):?>
                     <?php if(session()->get('role')=="admin"): ?>
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
                                $jml_hari = number_format(round($datediff / (60 * 60 * 24)));
                                $jml_denda=0;
                                if ($now<$tanggal_kembali){

                                }
                                else{
                                    $jml_denda = 'Rp'.number_format(round($datediff / (60 * 60 * 24))*$bayar, 0, '.', ','); 
                                    echo $jml_denda; 
                                }
                            ?>
                        </td>
                       <td><a href="delete_denda/<?= $denda["id"]?>" class="btn btn-danger">Sudah bayar</a><br><br>
                       <form action="/katalog/kirim/denda" method="post">
                        <input type="hidden" name="nama_penerima"value="<?=$denda['fullname']; ?>">
                        <input type="hidden" name="judul_buku" value="<?=$denda['judul']; ?>">
                        <input type="hidden" name="tanggal_pinjam" value="<?=$denda['tanggal_pinjam']; ?>">
                        <input type="hidden" name="tanggal_kembali" value="<?=$denda['tanggal_kembali']; ?>">
                        <input type="hidden" name="jml_hari"value="<?= $jml_hari ?>">
                        <input type="hidden" name="jml_denda" value="<?= $jml_denda ?>">
                        <input type="hidden" name="email_siswa" value="<?= $denda['email']?>">
                        <button type="submit" class="btn btn-warning">Kirim Tagihan</button>
                       </form>
                       </td>
         
                    </tr>    
                        
           <?php else:
                 if(session()->get('id')==$denda['member_id']):?>
                              <tr>
                        <th scope="row"><?= $counter += 1 ?></th>
                        <td><?=$denda['fullname']; ?></td>
                        <td><?=$denda['judul']; ?></td>
                        <td><?=$denda['ISBN']; ?></td>
                        <td><?=$denda['tanggal_pinjam']; ?></td>
                        <td><?=$denda['tanggal_kembali']; ?></td>
                        <?php
                                //Denda 2000 per hari
                                $bayar = 2000;
                                $now = time();
                                $tanggal_kembali = strtotime($denda['tanggal_kembali']);
                                $datediff = $now - $tanggal_kembali;
                                if ($now<$tanggal_kembali){

                                }
                                else{
                                 }
                            ?>
                        </td>
         
                    </tr> 
                  <?php else:
                      echo "";
                  endif;
                
                echo "";
            endif;
              ?>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>