<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Project ICT &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Project</h1>
            <div class="section-header-button">
                <a href="<?= base_url('project/add') ?>" class="btn btn-primary">Tambahkan Project</a>
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
                    <h4>DATA Project </h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-md" id="project">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Unit</th>
                                <th>Nama Project</th>
                                <th>Jenis Pekerjaan</th>
                                <th>Estimasi Pengerjaan</th>
                                <th>R.A.B</th>
                                <th>B.A.P.P</th>
                                <th>B.A.S.T</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($nama_data as $key => $value) :
                            ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value->nama_unit ?></td>
                                    <td><?= $value->nama_project ?></td>
                                    <td><?= $value->jenis_pekerjaan ?></td>
                                    <td><?= $value->estimasi ?></td>
                                    <td><a href="<?= base_url('project/' . $value->rab) ?>"><?= $value->rab ?></a></td>
                                    <td><a href="<?= base_url('project/' . $value->bapp) ?>"><?= $value->bapp ?></a></td>
                                    <td><a href="<?= base_url('project/' . $value->bast) ?>"><?= $value->bast ?></a></td>
                                    </td>
                                    <td><?php if ($value->status == 0) { ?>
                                            <a class="btn btn-warning btn-sm">Proses B.A.P.P</a>
                                        <?php } elseif ($value->status == 1) { ?>
                                            <a class="btn btn-info btn-sm">Proses B.A.S.T</a>
                                        <?php } elseif ($value->status == 2) { ?>
                                            <a class="btn btn-success btn-sm">Proses Selesai</a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center" style="width:15%">
                                        <a href="<?= site_url('project/edit/' . $value->id_project) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="<?= site_url('project/del/' . $value->id_project) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data ?')">
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