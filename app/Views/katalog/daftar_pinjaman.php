<div class="container">
    <div class="row">
        <div class="col-12 mt-3">
            <h2>Daftar Pinjaman</h2>
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
                        <th scope="col">Status</th>
                        <?php if(session()->get('id')==1):?>
                        <th scope="col">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>                    
                    <?php $counter = 0; 
                    foreach ($pinjaman as $pinjaman):?>
                    <tr>
                        <th scope="row"><?= $counter += 1 ?></th>
                        <td><?= $pinjaman->fullname ?></td>
                        <td><?= $pinjaman->judul ?></td>
                        <td><?= $pinjaman->ISBN ?></td>
                        <td><?= $pinjaman->tanggal_pinjam ?></td>
                        <td><?= $pinjaman->tanggal_kembali ?></td>
                        <td><?php if ($pinjaman->status == 1): ?>
                            <svg style="color:green;width:100%;height:100%" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                            </svg>
                           
                        <?php elseif($pinjaman->status == 2): ?>
                            <svg style="color:red;width:100%;height:100%" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        <?php else: ?>
                            <svg style="color:yellow;width:100%;height:100%" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
                            <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z"/>
                            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                            </svg>
                        <?php endif;?></td>
                        <?php if(session()->get('id')==1): ?>
                        <td>
                            <a href="izinkan/<?=$pinjaman->id?>" class="btn btn-success">Izinkan</a><br><br>
                            <a href="tolak/<?=$pinjaman->id?>" class="btn btn-danger">Tolak</a>
                            
                        <td>
                        <?php endif; ?>
                    </tr>    

                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>