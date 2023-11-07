<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Tambah Data Barang Fasilitas ICT &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Create Barang Fasilitas ICT</h1>
            <div class="section-header-button">
                <a href="<?= base_url('barang/home/' . $id) ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Barang</h4>
                </div>
                <div class="card-body col-md-6">
                    <?php $validation = \Config\Services::validation(); ?>
                    <form action="<?= site_url('barang/prosesAdd/' . $id) ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_pfi" class="form-control" value="<?= $id ?>">
                        <div class="form-group">
                            <label>Nama Barang *</label>
                            <input type="text" name="nama_barang" class="form-control <?= $validation->hasError('nama_barang') ? 'is-invalid' : null ?>" value="<?= old('nama_barang', session('temp_data.nama_barang')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_barang') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Merk/Type *</label>
                            <input type="text" name="merk_tipe" class="form-control <?= $validation->hasError('merk_tipe') ? 'is-invalid' : null ?>" value="<?= old('merk_tipe', session('temp_data.merk_tipe')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('merk_tipe') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Barang *</label>
                            <input type="number" name="jumlah_barang" class="form-control <?= $validation->hasError('jumlah_barang') ? 'is-invalid' : null ?>" value="<?= old('jumlah_barang', session('temp_data.jumlah_barang')); ?>" id="jumlah">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jumlah_barang') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Satuan *</label>
                            <input type="text" name="satuan" class="form-control <?= $validation->hasError('satuan') ? 'is-invalid' : null ?>" value="<?= old('satuan', session('temp_data.satuan')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('satuan') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Harga Barang *</label>
                            <input type="number" name="harga_barang" class="form-control <?= $validation->hasError('harga_barang') ? 'is-invalid' : null ?>" value="<?= old('harga_barang', session('temp_data.harga_barang')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('harga_barang') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Gambar *</label>
                            <input type="file" name="gambar" class="form-control <?= $validation->hasError('gambar') ? 'is-invalid' : null ?>" value="<?= old('gambar', session('temp_data.gambar')); ?>" id="harga">
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control <?= $validation->hasError('keterangan') ? 'is-invalid' : null ?>"><?= old('keterangan', session('temp_data.keterangan')); ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('keterangan') ?>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Save</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>