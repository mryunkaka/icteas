<style>

</style>
<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Barang Fasilitas ICT &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Barang Fasilitas ICT</h1>
            <div class="section-header-button">
                <a href="<?= base_url('permintaan') ?>" class="btn btn-secondary">Kembali</a>
                <?php if ($pfi->approve == 0) { ?>
                    <a href="<?= base_url('barang/add/' . $id) ?>" class="btn btn-primary">Tambahkan Barang</a>
                <?php } ?>
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
                    <h4>DATA Barang Fasilitas ICT</h4>
                    <div class="card-header-action">
                        <form action="<?= site_url('permintaan/approve/' . $id) ?>" method="post" class="d-inline" onsubmit="return confirm('Periksa kembali inputan barang anda sebelum di upload, Jika sudah diupload barang tidak dapat di edit, kecuali atasan mengijinkan untuk revisi')">
                            <?= csrf_field() ?>
                            <?php if ($pfi->approve == 0) { ?>
                                <button class="btn btn-info btn-sm">
                                    <i class="fas fa-arrow-alt-circle-up"></i> Aprrove</a>
                                </button>
                            <?php } ?>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-md" id="barang">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Merk/Tipe</th>
                                <th>Jumlah Barang</th>
                                <th>Harga Barang</th>
                                <th>Total Barang</th>
                                <th>Gambar</th>
                                <th>Keterangan</th>
                                <?php if ($pfi->approve == 0) { ?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($nama_data as $key => $value) :
                            ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= $value['nama_barang'] ?></td>
                                    <td><?= $value['merk_tipe'] ?></td>
                                    <td><?= $value['jumlah_barang'] . ' ' . $value['satuan'] ?></td>
                                    <td><?= rupiah($value['harga_barang']) ?></td>
                                    <td><?= rupiah($value['total_barang']) ?></td>

                                    <td><a href="<?= base_url('uploads/barang/' . $value['gambar']) ?>" data-fancybox="gallery"><img src="<?= base_url('uploads/barang/' . $value['gambar']) ?>" width="100" class="img-fluid img-lampu"></a></td>

                                    <td><?= $value['keterangan'] ?></td>
                                    <?php if ($pfi->approve == 0) { ?>
                                        <td class="text-center" style="width:15%">
                                            <a href="<?= site_url('barang/edit/' . $value['id_barang']) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <form action="<?= site_url('barang/delete/' . $value['id_barang']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin Hapus Data ?')">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    <?php } ?>
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