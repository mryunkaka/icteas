<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Tambah Data Permohonan Email &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Permohonan Email EAS Group</h1>
            <div class="section-header-button">
                <a href="<?= base_url('email/home') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Permohonan</h4>
                </div>
                <div class="card-body col-md-6">
                    <?php $validation = \Config\Services::validation(); ?>
                    <form action="<?= site_url('email/creates') ?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>PT *</label>
                            <select name="id_unit" class="form-control <?= $validation->hasError('id_unit') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <?php foreach ($unit as $key => $value) : ?>
                                    <option value="<?= $value->id_unit ?>" <?= $value->id_unit == session('id_unit') ? 'selected' : null ?>>
                                        <?= $value->nama_unit ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('id_unit'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor Email *</label>
                            <input type="text" name="no_email" class="form-control <?= $validation->hasError('no_email') ? 'is-invalid' : null ?>" value="<?= $max['no_email'] + 1 ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_email') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Email *</label>
                            <input type="date" name="tanggal_email" class="form-control <?= $validation->hasError('tanggal_email') ? 'is-invalid' : null ?>" value="<?= date('Y-m-d') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal_email') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Pemohon *</label>
                            <input type="text" name="nama_pemohon" class="form-control <?= $validation->hasError('nama_pemohon') ? 'is-invalid' : null ?>" value="<?= old('nama_pemohon', session('temp_data.nama_pemohon')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_pemohon') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan *</label>
                            <input type="text" name="jabatan_email" class="form-control <?= $validation->hasError('jabatan_email') ? 'is-invalid' : null ?>" value="<?= old('jabatan_email', session('temp_data.jabatan_email')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan_email') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dept. *</label>
                            <input type="text" name="dept_email" class="form-control <?= $validation->hasError('dept_email') ? 'is-invalid' : null ?>" value="<?= old('dept_email', session('temp_data.dept_email')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('dept_email') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Opsi Pemohon *</label>
                            <select name="opsi_email" class="form-control <?= $validation->hasError('opsi_email') ? 'is-invalid' : null ?>" ?>
                                <option value="Baru" selected>
                                    Baru
                                </option>
                                <option value="Mutasi">
                                    Mutasi
                                </option>
                                <option value="Promosi">
                                    Promosi
                                </option>
                                <option value="Lain2">
                                    Lain2
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('opsi_email'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Opsi Pemohon *</label>
                            <select name="pemohon_email" class="form-control <?= $validation->hasError('pemohon_email') ? 'is-invalid' : null ?>" ?>
                                <option value="E-Mail Account" selected>
                                    E-Mail Account
                                </option>
                                <option value="Perubahan Hask Akses Email Account">
                                    Perubahan Hask Akses Email Account
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('pemohon_email'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pilihan Perangkat *</label>
                            <select name="perangkat_user" class="form-control <?= $validation->hasError('perangkat_user') ? 'is-invalid' : null ?>" ?>
                                <option value="Blackberry">
                                    Blackberry
                                </option>
                                <option value="Android (Samsung, Dll)" selected>
                                    Android (Samsung, Dll)
                                </option>
                                <option value="Apple IOS (Iphone, Dll)">
                                    Apple IOS (Iphone, Dll)
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('perangkat_user'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Akses Email *</label>
                            <select name="akses_email" class="form-control <?= $validation->hasError('akses_email') ? 'is-invalid' : null ?>" ?>
                                <option value="Lokal">
                                    Lokal
                                </option>
                                <option value="Global" selected>
                                    Global
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('akses_email'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Akses Keperluan *</label>
                            <select name="akses_keperluan" class="form-control <?= $validation->hasError('akses_keperluan') ? 'is-invalid' : null ?>" ?>
                                <option value="Hanya bisa terima dan kirim e-mail internal (sesama@easgroup.co.id) ">
                                    Hanya bisa terima dan kirim e-mail internal (sesama@easgroup.co.id)
                                </option>
                                <option value="Hanya bisa kirim e-mail keluar (Diluar domain @easgroup.co.id)" selected>
                                    Hanya bisa kirim e-mail keluar (Diluar domain @easgroup.co.id)
                                </option>
                                <option value="Hanya bisa terima e-mail dari luar (Diluar domain @easgroup.co.id)" selected>
                                    Hanya bisa terima e-mail dari luar (Diluar domain @easgroup.co.id)
                                </option>
                                <option value="Bisa kirim & terima e-mail dari luar (Diluar domain @easgroup.co.id)" selected>
                                    Bisa kirim & terima e-mail dari luar (Diluar domain @easgroup.co.id)
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('akses_keperluan'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Sect. Head *</label>
                            <input type="text" name="nama_sect_head" class="form-control <?= $validation->hasError('nama_sect_head') ? 'is-invalid' : null ?>" value="<?= old('nama_sect_head', session('temp_data.nama_sect_head')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_sect_head') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Div. Head *</label>
                            <input type="text" name="nama_div_head" class="form-control <?= $validation->hasError('nama_div_head') ? 'is-invalid' : null ?>" value="<?= old('nama_div_head', session('temp_data.nama_div_head')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_div_head') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan Sect. Head *</label>
                            <input type="text" name="jabatan_sect_head" class="form-control <?= $validation->hasError('jabatan_sect_head') ? 'is-invalid' : null ?>" value="<?= old('jabatan_sect_head', session('temp_data.jabatan_sect_head')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan_sect_head') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan Div. Head *</label>
                            <input type="text" name="jabatan_div_head" class="form-control <?= $validation->hasError('jabatan_div_head') ? 'is-invalid' : null ?>" value="<?= old('jabatan_div_head', session('temp_data.jabatan_div_head')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan_div_head') ?>
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