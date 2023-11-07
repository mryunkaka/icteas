<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Log Downtime Jaringan & CCTV &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Log Downtime Jaringan & CCTV</h1>
            <div class="section-header-button">
                <a href="<?= base_url('downtime/new') ?>" class="btn btn-primary">Tambahkan Log</a>
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
                    <h4>DATA Log Downtime Jaringan & CCTV </h4>
                    <!-- <div class="card-header-action">
                        <a href="<?= site_url('downtime/export-pdf') ?>" class="btn btn-warning"><i class="fa fa-print"></i> Export PDF</a>
                    </div> -->
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-md" id="downtime">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Unit</th>
                                <th>Tanggal Input</th>
                                <th>Down Awal</th>
                                <th>Down Akhir</th>
                                <th>Interval</th>
                                <th>keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($downtime as $key => $value) :
                                $startDateTime = new \DateTime($value->down_awal); // contoh datetime awal
                                $endDateTime = new \DateTime($value->down_akhir); // contoh datetime akhir

                                // Hitung selisih waktu
                                $interval = $startDateTime->diff($endDateTime);

                            ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value->nama_unit ?></td>
                                    <td><?= $value->tanggal_input ?></td>
                                    <td><?= $value->down_awal ?></td>
                                    <td><?= $value->down_akhir ?></td>
                                    <td>
                                        <?php
                                        if ($value->down_akhir == '0000-00-00 00:00:00') {
                                            echo "0 Jam";
                                        } else {
                                            if ($interval->format('%h') <= 0) {
                                                echo $interval->format('%i menit');
                                            } else if ($interval->format('%d') == 0) {
                                                echo $interval->format('%h jam');
                                            } else if ($interval->format('%m') == 0) {
                                                echo $interval->format('%d hari');
                                            } else {
                                                echo $interval->format('%m bulan');
                                            }
                                        }
                                        ?></td>
                                    <td><?= $value->keterangan ?></td>
                                    <td class="text-center" style="width:15%">
                                        <a href="<?= site_url('downtime/edit/' . $value->id_downtime) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="<?= site_url('downtime/del/' . $value->id_downtime) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data ?')">
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