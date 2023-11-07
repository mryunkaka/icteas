<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Edit Data Permohonan Email &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Permohonan Email EAS Group</h1>
            <div class="section-header-button">
                <a href="<?= base_url('email/home') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Permohonan</h4>
                </div>
                <div class="card-body col-md-6">
                    <?php $validation = \Config\Services::validation(); ?>
                    <form action="<?= site_url('email/editP/' . $email->id_email) ?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>PT *</label>
                            <select name="id_unit" class="form-control <?= $validation->hasError('id_unit') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <?php foreach ($unit as $key => $value) : ?>
                                    <option value="<?= $value->id_unit ?>" <?= $value->id_unit == $email->id_unit ? 'selected' : null ?>>
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
                            <input type="text" name="no_email" class="form-control <?= $validation->hasError('no_email') ? 'is-invalid' : null ?>" value="<?= $email->no_email ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_email') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Email *</label>
                            <input type="date" name="tanggal_email" class="form-control <?= $validation->hasError('tanggal_email') ? 'is-invalid' : null ?>" value="<?= $email->tanggal_email ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal_email') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Pemohon *</label>
                            <input type="text" name="nama_pemohon" class="form-control <?= $validation->hasError('nama_pemohon') ? 'is-invalid' : null ?>" value="<?= $email->nama_pemohon ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_pemohon') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan *</label>
                            <input type="text" name="jabatan_email" class="form-control <?= $validation->hasError('jabatan_email') ? 'is-invalid' : null ?>" value="<?= $email->jabatan_email ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan_email') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dept. *</label>
                            <input type="text" name="dept_email" class="form-control <?= $validation->hasError('dept_email') ? 'is-invalid' : null ?>" value="<?= $email->dept_email ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('dept_email') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Opsi Pemohon *</label>
                            <select name="opsi_email" class="form-control <?= $validation->hasError('opsi_email') ? 'is-invalid' : null ?>" ?>
                                <option value="Baru" <?= old('opsi_email',  session('temp_data.opsi_email')) == $email->opsi_email ? 'selected' : null ?>>
                                    Baru
                                </option>
                                <option value="Mutasi" <?= old('opsi_email',  session('temp_data.opsi_email')) == $email->opsi_email ? 'selected' : null ?>>
                                    Mutasi
                                </option>
                                <option value="Promosi" <?= old('opsi_email',  session('temp_data.opsi_email')) == $email->opsi_email ? 'selected' : null ?>>
                                    Promosi
                                </option>
                                <option value="Lain2" <?= old('opsi_email',  session('temp_data.opsi_email')) == $email->opsi_email ? 'selected' : null ?>>
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
                                <option value="E-Mail Account" <?= old('pemohon_email',  session('temp_data.pemohon_email')) == $email->pemohon_email ? 'selected' : null ?>>
                                    E-Mail Account
                                </option>
                                <option value="Perubahan Hask Akses Email Account" <?= old('pemohon_email',  session('temp_data.pemohon_email')) == $email->pemohon_email ? 'selected' : null ?>>
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
                                <option value="Blackberry" <?= old('perangkat_user',  session('temp_data.perangkat_user')) == $email->perangkat_user ? 'selected' : null ?>>
                                    Blackberry
                                </option>
                                <option value="Android (Samsung, Dll)" <?= old('perangkat_user',  session('temp_data.perangkat_user')) == $email->perangkat_user ? 'selected' : null ?>>
                                    Android (Samsung, Dll)
                                </option>
                                <option value="Apple IOS (Iphone, Dll)" <?= old('perangkat_user',  session('temp_data.perangkat_user')) == $email->perangkat_user ? 'selected' : null ?>>
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
                                <option value="Lokal" <?= old('akses_email',  session('temp_data.akses_email')) == $email->akses_email ? 'selected' : null ?>>
                                    Lokal
                                </option>
                                <option value="Global" <?= old('akses_email',  session('temp_data.akses_email')) == $email->akses_email ? 'selected' : null ?>>
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
                                <option value="Hanya bisa terima dan kirim e-mail internal (sesama@easgroup.co.id)" <?= old('akses_keperluan',  session('temp_data.akses_keperluan')) == $email->akses_keperluan ? 'selected' : null ?>>
                                    Hanya bisa terima dan kirim e-mail internal (sesama@easgroup.co.id)
                                </option>
                                <option value="Hanya bisa kirim e-mail keluar (Diluar domain @easgroup.co.id)" <?= old('akses_keperluan',  session('temp_data.akses_keperluan')) == $email->akses_keperluan ? 'selected' : null ?>>
                                    Hanya bisa kirim e-mail keluar (Diluar domain @easgroup.co.id)
                                </option>
                                <option value="Hanya bisa terima e-mail dari luar (Diluar domain @easgroup.co.id)" <?= old('akses_keperluan',  session('temp_data.akses_keperluan')) == $email->akses_keperluan ? 'selected' : null ?>>
                                    Hanya bisa terima e-mail dari luar (Diluar domain @easgroup.co.id)
                                </option>
                                <option value="Bisa kirim & terima e-mail dari luar (Diluar domain @easgroup.co.id)" <?= old('akses_keperluan',  session('temp_data.akses_keperluan')) == $email->akses_keperluan ? 'selected' : null ?>>
                                    Bisa kirim & terima e-mail dari luar (Diluar domain @easgroup.co.id)
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('akses_keperluan'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Sect. Head *</label>
                            <input type="text" name="nama_sect_head" class="form-control <?= $validation->hasError('nama_sect_head') ? 'is-invalid' : null ?>" value="<?= $email->nama_sect_head ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_sect_head') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Div. Head *</label>
                            <input type="text" name="nama_div_head" class="form-control <?= $validation->hasError('nama_div_head') ? 'is-invalid' : null ?>" value="<?= $email->nama_div_head ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('nama_div_head') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan Sect. Head *</label>
                            <input type="text" name="jabatan_sect_head" class="form-control <?= $validation->hasError('jabatan_sect_head') ? 'is-invalid' : null ?>" value="<?= $email->jabatan_sect_head ?>">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('jabatan_sect_head') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan Div. Head *</label>
                            <input type="text" name="jabatan_div_head" class="form-control <?= $validation->hasError('jabatan_div_head') ? 'is-invalid' : null ?>" value="<?= $email->jabatan_div_head ?>">
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