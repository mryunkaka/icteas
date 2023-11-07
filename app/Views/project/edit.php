<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Edit Data Project ICT &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Project Fasilitas ICT</h1>
            <div class="section-header-button">
                <a href="<?= base_url('project/home') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Buat PFI</h4>
                </div>
                <div class="card-body col-md-6">
                    <?php $validation = \Config\Services::validation(); ?>
                    <form action="<?= site_url('project/editP/' . $project->id_project) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Unit *</label>
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
                            <label>Nama Project *</label>
                            <input type="text" name="nama_project" class="form-control <?= $validation->hasError('nama_project') ? 'is-invalid' : null ?>" value="<?= $project->nama_project ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_project') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No ICT *</label>
                            <input type="text" name="no_ict" class="form-control <?= $validation->hasError('no_ict') ? 'is-invalid' : null ?>" value="<?= $project->no_ict ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_ict') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Pekerjaan *</label>
                            <input type="text" name="jenis_pekerjaan" class="form-control <?= $validation->hasError('jenis_pekerjaan') ? 'is-invalid' : null ?>" value="<?= $project->jenis_pekerjaan ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jenis_pekerjaan') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Estimasi Waktu Pekerjaan *</label>
                            <input type="text" name="estimasi" class="form-control <?= $validation->hasError('estimasi') ? 'is-invalid' : null ?>" value="<?= $project->estimasi ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('estimasi') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>R.A.B dan Gambar Kerja *</label>
                            <input type="file" name="rab" class="form-control <?= $validation->hasError('rab') ? 'is-invalid' : null ?>" value="<?= $project->rab ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('rab') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>B.A.P.P *</label>
                            <input type="file" name="bapp" class="form-control <?= $validation->hasError('bapp') ? 'is-invalid' : null ?>" value="<?= $project->bapp ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('bapp') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>B.A.S.T *</label>
                            <input type="file" name="bast" class="form-control <?= $validation->hasError('bast') ? 'is-invalid' : null ?>" value="<?= $project->bast ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('bast') ?>
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