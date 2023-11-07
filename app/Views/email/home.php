<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Permohonan Email &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Permohonan Email</h1>
            <div class="section-header-button">
                <a href="<?= base_url('email/new') ?>" class="btn btn-primary">Tambahkan Permohonan</a>
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
                    <h4>DATA Permohonan Email EAS GROUP </h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-md" id="email">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomor Email</th>
                                <th>Tanggal</th>
                                <th>Nama PT</th>
                                <th>Nama Pemohon</th>
                                <th>Jabatan</th>
                                <th>Alamat Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($nama_data as $key => $value) :
                            ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value->no_email ?></td>
                                    <td><?= tanggal_indonesia($value->tanggal_email) ?></td>
                                    <td><?= $value->nama_unit ?></td>
                                    <td><?= $value->nama_pemohon ?></td>
                                    <td><?= $value->jabatan_email ?></td>
                                    <td><?= $value->alamat_email ?></td>
                                    <td><?php if ($value->status == 0) { ?>
                                            <form action="<?= site_url('email/status/' . $value->id_email) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Ingin Menttd ?')">
                                                <?= csrf_field() ?>
                                                <button class="btn btn-danger btn-sm">
                                                    Proses TTD Pemohon
                                                </button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center" style="width:15%">
                                        <a href="<?= site_url('email/edit/' . $value->id_email) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="<?= site_url('email/del/' . $value->id_email) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data ?')">
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
</div>
<?= $this->endSection() ?>