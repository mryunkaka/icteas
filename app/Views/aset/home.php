<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Aset ICT &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Aset</h1>
            <div class="section-header-button">
                <a href="<?= base_url('aset/add') ?>" class="btn btn-primary">Tambahkan Data</a>
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
                    <h4>DATA Permohonan aset </h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-md" id="aset">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Unit</th>
                                <th>Nomor aset</th>
                                <th>Form Bast</th>
                                <th>Desc. Aset</th>
                                <th>Lokasi</th>
                                <th>User</th>
                                <th>Foto Aset</th>
                                <th>Tahun Perolehan</th>
                                <th>Usia</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($aset as $key => $value) :
                                $startDateTime = new \DateTime($value->tahun_perolehan); // contoh datetime awal
                                $endDateTime = new \DateTime(date('Y-m-d')); // contoh datetime akhir

                                // Hitung selisih waktu
                                $interval = $startDateTime->diff($endDateTime);

                            ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value->nama_unit ?></td>
                                    <td><?= $value->no_aset ?></td>
                                    <td><a href="<?= base_url('aset/' . $value->form_bast) ?>"><?= $value->form_bast ?></a></td>
                                    <td><?= $value->desc_aset ?></td>
                                    <td><?= $value->lokasi ?></td>
                                    <td><?= $value->user ?></td>
                                    <td><a href="<?= base_url('uploads/aset/' . $value->foto_aset) ?>" data-fancybox="gallery"><img src="<?= base_url('uploads/aset/' . $value->foto_aset) ?>" width="100" class="img-fluid img-lampu"></a></td>
                                    <td><?= $value->tahun_perolehan ?></td>
                                    <td>
                                        <?php
                                        if ($value->usia == '0') {
                                            echo "";
                                        } else {
                                            echo $interval->format('%m Bulan, %y Tahun');
                                        }
                                        ?></td>
                                    <td class="text-center" style="width:15%">

                                        <a href="<?= site_url('aset/edit/' . $value->id_aset) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="<?= site_url('aset/del/' . $value->id_aset) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data ?')">
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