<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Permohonan Fasilitas ICT &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Permohonan Fasilitas ICT</h1>
            <div class="section-header-button">
                <a href="<?= base_url('permintaan/new') ?>" class="btn btn-primary">Tambahkan Data</a>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">x</button>
                    <b>Success !</b>
                    <?= session()->getFlashdata('success') ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('delete')) : ?>
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">x</button>
                    <b>Delete !</b>
                    <?= session()->getFlashdata('delete') ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>DATA Permohonan Fasilitas ICT</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-md" id="permintaan">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal</th>
                                <th>PT</th>
                                <th>No PFI</th>
                                <th>Prioritas</th>
                                <th>Type</th>
                                <th>Pengguna</th>
                                <th>Dept</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($nama_data as $key => $value) :
                            ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value->tanggal_pfi ?></td>
                                    <td><?= $value->nama_unit ?></td>
                                    <td><?= $value->no_pfi ?></td>
                                    <td><?php if ($value->prioritas == 0) {
                                            echo "NORMAL";
                                        } else {
                                            echo "URGENT";
                                        } ?></td>
                                    <td><?php if ($value->type == 0) {
                                            echo "SOFTWARE";
                                        } else {
                                            echo "HARDWARE";
                                        } ?></td>
                                    <td><?= $value->pengguna ?></td>
                                    <td><?= $value->dept ?></td>
                                    <td style="width:15%">
                                        <center>
                                            <?php if ($value->progres == 0) { ?>
                                                <a href="#" class="btn btn-primary btn-sm">Proses Pembuatan</a>
                                            <?php } elseif ($value->progres == 1) { ?>
                                                <form action="<?= site_url('permintaan/ttd_fat/' . $value->id_pfi) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Ingin TTD Permohonan Ini ?')">
                                                    <?= csrf_field() ?>
                                                    <button class="btn btn-primary btn-sm">
                                                        Proses TTD Manager FAT
                                                    </button>
                                                </form>
                                            <?php } elseif ($value->progres == 2) { ?>
                                                <form action="<?= site_url('permintaan/ttd_gm/' . $value->id_pfi) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Ingin TTD Permohonan Ini ?')">
                                                    <?= csrf_field() ?>
                                                    <button class="btn btn-primary btn-sm">
                                                        Proses TTD GM
                                                    </button>
                                                </form>
                                            <?php } elseif ($value->progres == 3) { ?>
                                                <a href="#" class="btn btn-info btn-sm">Proses TTD Div. Head</a>
                                            <?php } elseif ($value->progres == 4) { ?>
                                                <a href="#" class="btn btn-success btn-sm">Telah Disetujui</a>
                                            <?php } elseif ($value->progres == 5) { ?>
                                                <a href="#" class="btn btn-warning btn-sm">Revisi</a>
                                            <?php } elseif ($value->progres == 6) { ?>
                                                <a href="#" class="btn btn-danger btn-sm">Reject</a>
                                            <?php } elseif ($value->progres == 7) { ?>
                                                <form action="<?= site_url('permintaan/ttd_stf/' . $value->id_pfi) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Ingin TTD Permohonan Ini ?')">
                                                    <?= csrf_field() ?>
                                                    <button class="btn btn-primary btn-sm">
                                                        Proses TTD Staff
                                                    </button>
                                                </form>
                                            <?php }  ?>
                                        </center>
                                    </td>
                                    <td><?= $value->alasan_kebutuhan ?></td>
                                    <td class="text-center" style="width:15%">
                                        <?php if ($value->progres == 3 || $value->progres == 5 || $value->progres == 6) { ?>
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal<?= $value->id_pfi ?>"><i class="fas fa-edit"></i></button>
                                        <?php } ?>
                                        <?php if ($value->approve == 1) { ?>
                                            <a href="<?= site_url('barang/export-pdf/' . $value->id_pfi) ?>" class="btn btn-primary btn-sm"><i class="fas fa-print"></i></a>
                                        <?php } ?>
                                        <a href="<?= site_url('barang/home/' . $value->id_pfi) ?>" class="btn btn-success btn-sm"><i class="fas fa-box-open"></i></a>
                                        <a href="<?= site_url('permintaan/edit/' . $value->id_pfi) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="<?= site_url('permintaan/del/' . $value->id_pfi) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data ?')">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </section>
    <?php foreach ($nama_data as $key => $value) :
    ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal<?= $value->id_pfi ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">PT. <?= $value->nama_unit ?> - Permohonan Fasilitas ICT - <?= $value->no_pfi ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= site_url('permintaan/setujui/' . $value->id_pfi) ?>" method="post" autocomplete="off">
                        <div class="modal-body">

                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label>Pilih Aksi</label>
                                <select class="form-control" name="progres">
                                    <option value="4">Setujui</option>
                                    <option value="5">Revisi</option>
                                    <option value="6">Reject</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Catatan</label>
                                <input type="text" name="catatan" class="form-control">
                            </div>

                        </div>

                        <div class="modal-footer bg-whitesmoke br">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<?= $this->endSection() ?>