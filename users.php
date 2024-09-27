<?php
require_once 'header.php';
?>

<div class="content">
    <div class="container">
        <h3>Beranda</h3>
        <div class="card">
        <a href="users_add.php" class="btn" title="Tambah data"><i class="fa fa-plus"></i></a>
        <table class="table">
            <thead>
                <tr>
                    <th>USERNAME</th>
                    <th width="100">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($run_query_select) > 0){ ?>
                <?php $nomor = 1; ?>
                <?php while($row = mysqli_fetch_array($run_query_select)){ ?>
                    <tr>
                        <td align="center"><?= $nomor++ ?></td>
                        <td><?= $row['ussername'] ?></td>
                        <td align="center">
                            <a href="users_edit.php?id=<?= $row['user_id'] ?>" class="btn" title="Edit data"><i class="fa fa-edit"></i></a>
                            <a href="?delete=<?= $row['user_id'] ?>" class="btn" onclick="return confirm('Yakin ?')" title="Hapus data"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    <?php }}else{ ?>
                        <tr>
                            <td colspan="4">Tidak ada data</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php require_once 'footer.php'; ?>