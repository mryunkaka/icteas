<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Permohonan bak ICT &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Permohonan</h1>
            <div class="section-header-button">
                <a href="<?= base_url('bak/add') ?>" class="btn btn-primary">Tambahkan Data</a>
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
                    <h4>DATA Permohonan bak </h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-md" id="bak">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Unit</th>
                                <th>Nomor bak</th>
                                <th>Tanggal</th>
                                <th>Jenis Barang</th>
                                <th>Nama Pemohon</th>
                                <th>Uraian Kejadian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bak as $key => $value) :
                            ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value->nama_unit ?></td>
                                    <td><?= $value->no_bak ?></td>
                                    <td><?= $value->tanggal_bak ?></td>
                                    <td><?= $value->jenis_barang ?></td>
                                    <td><?= $value->dilaporkan_oleh ?></td>
                                    <td><?= $value->uraian_kejadian ?></td>
                                    <td class="text-center" style="width:15%">
                                        <a href="<?= site_url('bak/edit/' . $value->id_bak) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="<?= site_url('bak/del/' . $value->id_bak) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data ?')">
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