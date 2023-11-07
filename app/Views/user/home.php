<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Manajemen User &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Manajemen User</h1>
            <div class="section-header-button">
                <a href="<?= base_url('user/add') ?>" class="btn btn-primary">Tambahkan User</a>
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
                    <h4>DATA User </h4>
                    <!-- <div class="card-header-action">
                        <a href="<?= site_url('downtime/export-pdf') ?>" class="btn btn-warning"><i class="fa fa-print"></i> Export PDF</a>
                    </div> -->
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-md" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Nik</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th>Unit</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($nama_data as $key => $value) :  ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value->username ?></td>
                                    <td><?= $value->nik_name ?></td>
                                    <td><?= $value->name_user ?></td>
                                    <td><?= $value->email_user ?></td>
                                    <td><?= $value->jabatan_user ?></td>
                                    <td><?= $value->nama_unit ?></td>
                                    <td>
                                        <?php if ($value->status == 0) { ?>
                                            <form action="<?= site_url('user/verif/' . $value->id_user) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin verif User ?')">
                                                <?= csrf_field() ?>
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-user-times"></i>
                                                </button>
                                            </form>
                                        <?php } else { ?>
                                            <form action="<?= site_url('user/unverif/' . $value->id_user) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin unverif User ?')">
                                                <?= csrf_field() ?>
                                                <button class="btn btn-success btn-sm">
                                                    <i class="fas fa-user-check"></i>
                                                </button>
                                            </form>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center" style="width:15%">
                                        <a href="<?= site_url('user/edit/' . $value->id_user) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="<?= site_url('user/delete/' . $value->id_user) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data ?')">
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