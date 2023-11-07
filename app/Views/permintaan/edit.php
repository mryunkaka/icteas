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
                    <form action="<?= site_url('permintaan/' . $nama_data->id_pfi) ?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Unit *</label>
                            <select name="id_unit" class="form-control <?= $validation->hasError('id_unit') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <?php foreach ($unit as $key => $value) : ?>
                                    <option value="<?= $value->id_unit ?>" <?= $nama_data->id_unit == $value->id_unit ? 'selected' : null ?>>
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
                            <input type="date" name="tanggal_pfi" class="form-control <?= $validation->hasError('tanggal_pfi') ? 'is-invalid' : null ?>" value="<?= $nama_data->tanggal_pfi ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal_pfi') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor PFI *</label>
                            <input type="text" name="no_pfi" class="form-control <?= $validation->hasError('no_pfi') ? 'is-invalid' : null ?>" value="<?= $nama_data->no_pfi ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_pfi') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Prioritas *</label>
                            <select name="prioritas" class="form-control <?= $validation->hasError('prioritas') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <option value="0" <?= $nama_data->prioritas == '0' ? 'selected' : null ?>>
                                    NORMAL
                                </option>
                                <option value="1" <?= $nama_data->prioritas == '1' ? 'selected' : null ?>>
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
                                <option value="0" <?= $nama_data->type == '0' ? 'selected' : null ?>>
                                    SOFTWARE
                                </option>
                                <option value="1" <?= $nama_data->type == '1' ? 'selected' : null ?>>
                                    HARDWARE
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('type'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pengguna *</label>
                            <input type="text" name="pengguna" class="form-control <?= $validation->hasError('pengguna') ? 'is-invalid' : null ?>" value="<?= $nama_data->pengguna ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('pengguna') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dept *</label>
                            <input type="text" name="dept" class="form-control <?= $validation->hasError('dept') ? 'is-invalid' : null ?>" value="<?= $nama_data->dept ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('dept') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alasan Kebutuhan</label>
                            <textarea name="alasan_kebutuhan" class="form-control <?= $validation->hasError('alasan_kebutuhan') ? 'is-invalid' : null ?>"><?= $nama_data->alasan_kebutuhan ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('alasan_kebutuhan') ?>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> Update</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>