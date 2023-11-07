<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Tambah Data Permohonan Fasilitas ICT &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Create Permohonan Fasilitas ICT</h1>
            <div class="section-header-button">
                <a href="<?= base_url('permintaan') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Buat PFI</h4>
                </div>
                <div class="card-body col-md-6">
                    <?php $validation = \Config\Services::validation(); ?>
                    <form action="<?= site_url('permintaan/create') ?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Unit *</label>
                            <select name="id_unit" class="form-control <?= $validation->hasError('id_unit') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <?php foreach ($unit as $key => $value) : ?>
                                    <option value="<?= $value->id_unit ?>" <?= old('id_unit', session('temp_data.id_unit')) ? 'selected' : null ?>>
                                        <?= $value->nama_unit ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('id_unit'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pengguna *</label>
                            <input type="text" name="pengguna" class="form-control <?= $validation->hasError('pengguna') ? 'is-invalid' : null ?>" value="<?= old('pengguna', session('temp_data.pengguna')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('pengguna') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alasan Kebutuhan</label>
                            <textarea name="alasan_kebutuhan" class="form-control <?= $validation->hasError('alasan_kebutuhan') ? 'is-invalid' : null ?>"><?= old('alasan_kebutuhan', session('temp_data.alasan_kebutuhan')); ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('alasan_kebutuhan') ?>
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