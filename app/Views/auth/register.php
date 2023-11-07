<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; SI ICT</title>

    <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template/node_modules/@fortawesome/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>/template/assets/css/style.css">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <img src="<?= base_url() ?>template/assets/img/eas.jpg" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register </h4>
                            </div>
                            <div class="card-body">
                                <?php if (session()->getFlashdata('success')) : ?>
                                    <div class="alert alert-success alert-dismissible show fade">
                                        <div class="alert-body">
                                            <button class="close" data-dismiss="alert">x</button>
                                            <b>Success !</b>
                                            <?= session()->getFlashdata('success') ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <form action="<?= site_url('auth/proses') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <?php $validation = \Config\Services::validation(); ?>
                                    <div class="form-group">
                                        <label>Nama Lengkap *</label>
                                        <input type="text" name="name_user" class="form-control <?= $validation->hasError('name_user') ? 'is-invalid' : null ?>" value="<?= old('name_user', session('temp_data.name_user')); ?>" autofocus>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('name_user') ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Nomor Induk Karyawan (NIK) *</label>
                                        <input type="text" name="nik_name" class="form-control <?= $validation->hasError('nik_name') ? 'is-invalid' : null ?>" value="<?= old('nik_name', session('temp_data.nik_name')); ?>">
                                        <div class=" invalid-feedback">
                                            <?= $validation->getError('nik_name') ?>
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
                                        <label>Email *</label>
                                        <input type="email" name="email_user" class="form-control <?= $validation->hasError('email_user') ? 'is-invalid' : null ?>" value="<?= old('email_user', session('temp_data.email_user')); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email_user') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Password *</label>
                                        <input type="password" name="password_user" class="form-control <?= $validation->hasError('password_user') ? 'is-invalid' : null ?>" value="<?= old('password_user'); ?>">
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('password_user'); ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Unit *</label>
                                            <select name="id_unit" class="form-control <?= isset($errors['id_unit']) ? 'is-invalid' : null ?>">
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
                                        <div class="form-group col-6">
                                            <label>Jabatan *</label>
                                            <select name="jabatan_user" class="form-control <?= isset($errors['jabatan_user']) ? 'is-invalid' : null ?>">
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
                                                <option value="DIRECTUR" <?= old('jabatan_user', session('temp_data.jabatan_user')) ? 'selected' : null ?>>
                                                    DIRECTUR
                                                </option>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('jabatan_user'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Sudah memiliki Akun? <a href="<?= site_url('auth/login') ?>">Kembali ke Login</a>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Stisla 2018
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="../node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="../node_modules/selectric/public/jquery.selectric.min.js"></script>

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="../assets/js/page/auth-register.js"></script>
</body>

</html>