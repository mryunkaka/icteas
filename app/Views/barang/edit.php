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
                <a href="<?= base_url('barang/home/' . $barang->id_pfi) ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Barang</h4>
                </div>
                <div class="card-body col-md-6">
                    <?php $validation = \Config\Services::validation(); ?>
                    <form action="<?= site_url('barang/proses/edit/' . $barang->id_barang) ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_pfi" class="form-control" value="<?= $barang->id_pfi ?>">
                        <div class="form-group">
                            <label>Nama Barang *</label>
                            <input type="text" name="nama_barang" class="form-control <?= $validation->hasError('nama_barang') ? 'is-invalid' : null ?>" value="<?= $barang->nama_barang ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_barang') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Merk/Type *</label>
                            <input type="text" name="merk_tipe" class="form-control <?= $validation->hasError('merk_tipe') ? 'is-invalid' : null ?>" value="<?= $barang->merk_tipe ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('merk_tipe') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jumlah Barang *</label>
                            <input type="text" name="jumlah_barang" class="form-control <?= $validation->hasError('jumlah_barang') ? 'is-invalid' : null ?>" value="<?= $barang->jumlah_barang ?>" id="jumlah">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jumlah_barang') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Satuan *</label>
                            <input type="text" name="satuan" class="form-control <?= $validation->hasError('satuan') ? 'is-invalid' : null ?>" value="<?= $barang->satuan ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('satuan') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Harga Barang *</label>
                            <input type="text" name="harga_barang" class="form-control <?= $validation->hasError('harga_barang') ? 'is-invalid' : null ?>" value="<?= $barang->harga_barang ?>" id="inputAngka">
                            <div class="invalid-feedback">
                                <?= $validation->getError('harga_barang') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Gambar *</label>
                            <input type="file" name="gambar" class="form-control <?= $validation->hasError('gambar') ? 'is-invalid' : null ?>" value="<?= $barang->gambar ?>" id="inputAngka">
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control <?= $validation->hasError('keterangan') ? 'is-invalid' : null ?>"><?= $barang->keterangan ?></textarea>
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