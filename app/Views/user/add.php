<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Tambah Data User &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Create New User</h1>
            <div class="section-header-button">
                <a href="<?= base_url('user/home') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Buat User</h4>
                </div>
                <div class="card-body col-md-6">
                    <?php $validation = \Config\Services::validation(); ?>
                    <form action="<?= site_url('user/proses') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
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
                            <label>Username *</label>
                            <input type="text" name="username" class="form-control <?= $validation->hasError('username') ? 'is-invalid' : null ?>" value="<?= old('username', session('temp_data.username')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('username') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>NIK *</label>
                            <input type="text" name="nik_name" class="form-control <?= $validation->hasError('nik_name') ? 'is-invalid' : null ?>" value="<?= old('nik_name', session('temp_data.nik_name')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nik_name') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama *</label>
                            <input type="text" name="name_user" class="form-control <?= $validation->hasError('name_user') ? 'is-invalid' : null ?>" value="<?= old('name_user', session('temp_data.name_user')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('name_user') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="text" name="email_user" class="form-control <?= $validation->hasError('email_user') ? 'is-invalid' : null ?>" value="<?= old('email_user', session('temp_data.email_user')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('email_user') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password *</label>
                            <input type="text" name="password_user" class="form-control <?= $validation->hasError('password_user') ? 'is-invalid' : null ?>" value="<?= old('password_user', session('temp_data.password_user')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('password_user') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan *</label>
                            <select name="jabatan_user" class="form-control <?= $validation->hasError('jabatan_user') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <option value="ADMIN" <?= old('jabatan_user', session('temp_data.jabatan_user')) ? 'selected' : null ?>>
                                    ADMIN
                                </option>
                                <option value="STAFF" <?= old('jabatan_user', session('temp_data.jabatan_user')) ? 'selected' : null ?>>
                                    STAFF
                                </option>
                                <option value="SECT HEAD" <?= old('jabatan_user', session('temp_data.jabatan_user')) ? 'selected' : null ?>>
                                    SECT HEAD
                                </option>
                                <option value="DEPT HEAD" <?= old('jabatan_user', session('temp_data.jabatan_user')) ? 'selected' : null ?>>
                                    DEPT HEAD
                                </option>
                                <option value="DIV HEAD" <?= old('jabatan_user', session('temp_data.jabatan_user')) ? 'selected' : null ?>>
                                    DIV HEAD
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan_user'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Upload Gambar TTD *</label>
                            <input type="file" name="ttd" class="form-control <?= $validation->hasError('ttd') ? 'is-invalid' : null ?>" value="<?= old('ttd', session('temp_data.ttd')); ?>" id="harga">
                            <div class="invalid-feedback">
                                <?= $validation->getError('ttd') ?>
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