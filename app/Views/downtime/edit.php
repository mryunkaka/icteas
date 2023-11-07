<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Create Downtime Jaringan & CCTV &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Create Downtime Jaringan & CCTV</h1>
            <div class="section-header-button">
                <a href="<?= base_url('downtime') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Downtime</h4>
                </div>
                <div class="card-body col-md-6">
                    <?php $validation = \Config\Services::validation(); ?>
                    <form action="<?= site_url('downtime/' . $downtime->id_downtime) ?>" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Unit *</label>
                            <select name="id_unit" class="form-control <?= $validation->hasError('id_unit') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <?php foreach ($unit as $key => $value) : ?>
                                    <option value="<?= $value->id_unit ?>" <?= $downtime->id_unit == $value->id_unit ? 'selected' : null ?>>
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
                            <input type="date" name="tanggal_input" class="form-control <?= $validation->hasError('tanggal_input') ? 'is-invalid' : null ?>" value="<?= $downtime->tanggal_input ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal_input') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Down Awal *</label>
                            <input type="datetime-local" name="down_awal" class="form-control <?= $validation->hasError('down_awal') ? 'is-invalid' : null ?>" value="<?= $downtime->down_awal ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('down_awal') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Down Akhir </label>
                            <input type="datetime-local" name="down_akhir" class="form-control <?= $validation->hasError('down_akhir') ? 'is-invalid' : null ?>" value="<?= $downtime->down_akhir ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('down_akhir') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control"><?= $downtime->keterangan ?></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-warning"><i class="fas fa-download"></i> Update</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>