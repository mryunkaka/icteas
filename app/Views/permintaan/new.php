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
                    <form action="<?= site_url('permintaan/addproses') ?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <input type="hidden" name="nama_staff" class="form-control" value="<?= session('nama') ?>">
                        <div class="form-group">
                            <label>Unit *</label>
                            <select name="id_unit" class="form-control <?= $validation->hasError('id_unit') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <?php foreach ($unit as $key => $value) : ?>
                                    <option value="<?= $value->id_unit ?>" <?= session('id_unit') == $value->id_unit ? 'selected' : null ?>>
                                        <?= $value->nama_unit ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('id_unit'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal *</label>
                            <input type="date" name="tanggal_pfi" class="form-control <?= $validation->hasError('tanggal_pfi') ? 'is-invalid' : null ?>" value="<?= date('Y-m-d'); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal_pfi') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor PFI *</label>
                            <input type="text" name="no_pfi" class="form-control <?= $validation->hasError('no_pfi') ? 'is-invalid' : null ?>" value="<?= $pfi['no_pfi'] + 1 ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_pfi') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Prioritas *</label>
                            <select name="prioritas" class="form-control <?= $validation->hasError('prioritas') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <option value="0" selected <?= old('prioritas', session('temp_data.prioritas')) ? 'selected' : null ?>>
                                    NORMAL
                                </option>
                                <option value="1" <?= old('prioritas', session('temp_data.prioritas')) ? 'selected' : null ?>>
                                    URGENT
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('prioritas'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Type *</label>
                            <select name="type" class="form-control <?= $validation->hasError('type') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <option value="0" <?= old('type', session('temp_data.type')) ? 'selected' : null ?>>
                                    SOFTWARE
                                </option>
                                <option value="1" selected <?= old('type', session('temp_data.type')) ? 'selected' : null ?>>
                                    HARDWARE
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('type'); ?>
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
                            <label>Dept *</label>
                            <input type="text" name="dept" class="form-control <?= $validation->hasError('dept') ? 'is-invalid' : null ?>" value="<?= old('dept', session('temp_data.dept')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('dept') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Manager FAT *</label>
                            <select name="nama_fat" class="form-control <?= $validation->hasError('nama_fat') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <?php foreach ($user as $key) : ?>
                                    <option value="<?= $key->name_user ?>">
                                        <?= $key->name_user ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_fat'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama GM *</label>
                            <select name="nama_gm" class="form-control <?= $validation->hasError('nama_gm') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <?php foreach ($user as $key) : ?>
                                    <option value="<?= $key->name_user ?>">
                                        <?= $key->name_user ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_gm'); ?>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>