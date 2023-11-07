<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Edit Data Aset ICT &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Aset ICT</h1>
            <div class="section-header-button">
                <a href="<?= base_url('aset/home') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Data</h4>
                </div>
                <div class="card-body col-md-6">
                    <?php $validation = \Config\Services::validation(); ?>
                    <form action="<?= site_url('aset/editP/' . $aset->id_aset) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Unit *</label>
                            <select name="id_unit" class="form-control <?= $validation->hasError('id_unit') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <?php foreach ($unit as $key => $value) : ?>
                                    <option value="<?= $value->id_unit ?>" <?= $value->id_unit == $aset->id_unit ? 'selected' : null ?>>
                                        <?= $value->nama_unit ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('id_unit'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No Aset SAP *</label>
                            <input type="text" name="no_aset" class="form-control <?= $validation->hasError('no_aset') ? 'is-invalid' : null ?>" value="<?= $aset->no_aset ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_aset') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Form B.A.S.T *</label>
                            <input type="file" name="form_bast" class="form-control <?= $validation->hasError('form_bast') ? 'is-invalid' : null ?>" value="<?= $aset->no_aset ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('form_bast') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Desc. Aset * </label>
                            <textarea name="desc_aset" class="form-control <?= $validation->hasError('desc_aset') ? 'is-invalid' : null ?>"><?= $aset->desc_aset ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('desc_aset') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Lokasi *</label>
                            <input type="text" name="lokasi" class="form-control <?= $validation->hasError('lokasi') ? 'is-invalid' : null ?>" value="<?= $aset->lokasi ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('lokasi') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>User *</label>
                            <input type="text" name="user" class="form-control <?= $validation->hasError('user') ? 'is-invalid' : null ?>" value="<?= $aset->user ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('user') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Foto Aset *</label>
                            <input type="file" name="foto_aset" class="form-control <?= $validation->hasError('foto_aset') ? 'is-invalid' : null ?>" value="<?= $aset->foto_aset ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('foto_aset') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tahun Perolehan *</label>
                            <input type="date" name="tahun_perolehan" class="form-control <?= $validation->hasError('tahun_perolehan') ? 'is-invalid' : null ?>" value="<?= $aset->tahun_perolehan ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tahun_perolehan') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Usia *</label>
                            <input type="number" name="usia" class="form-control <?= $validation->hasError('usia') ? 'is-invalid' : null ?>" value="<?= $aset->usia ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('usia') ?>
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