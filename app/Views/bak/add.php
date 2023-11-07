<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Tambah Data Berita Acara ICT &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Create Permohonan Berita Acara ICT</h1>
            <div class="section-header-button">
                <a href="<?= base_url('bak/home') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Buat PFI</h4>
                </div>
                <div class="card-body col-md-6">
                    <?php $validation = \Config\Services::validation(); ?>
                    <form action="<?= site_url('bak/create') ?>" method="post" autocomplete="off">
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
                            <label>Nomor Berita Acara *</label>
                            <input type="text" name="no_bak" class="form-control <?= $validation->hasError('no_bak') ? 'is-invalid' : null ?>" value="<?= $nama_data['no_bak'] + 1 ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_bak') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal BAK *</label>
                            <input type="date" name="tanggal_bak" class="form-control <?= $validation->hasError('tanggal_bak') ? 'is-invalid' : null ?>" value="<?= date('Y-m-d') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal_bak') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dilaporkan Oleh *</label>
                            <input type="text" name="dilaporkan_oleh" class="form-control <?= $validation->hasError('dilaporkan_oleh') ? 'is-invalid' : null ?>" value="<?= old('dilaporkan_oleh', session('temp_data.dilaporkan_oleh')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('dilaporkan_oleh') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dept. Pelapor *</label>
                            <input type="text" name="dept_pelapor" class="form-control <?= $validation->hasError('dept_pelapor') ? 'is-invalid' : null ?>" value="<?= old('dept_pelapor', session('temp_data.dept_pelapor')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('dept_pelapor') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Barang *</label>
                            <input type="text" name="jenis_barang" class="form-control <?= $validation->hasError('jenis_barang') ? 'is-invalid' : null ?>" value="<?= old('jenis_barang', session('temp_data.jenis_barang')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jenis_barang') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Merk/Tipe *</label>
                            <input type="text" name="merk_tipe" class="form-control <?= $validation->hasError('merk_tipe') ? 'is-invalid' : null ?>" value="<?= old('merk_tipe', session('temp_data.merk_tipe')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('merk_tipe') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nomor Aset *</label>
                            <input type="text" name="no_aset" class="form-control <?= $validation->hasError('no_aset') ? 'is-invalid' : null ?>" value="<?= old('no_aset', session('temp_data.no_aset')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_aset') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Serial Number *</label>
                            <input type="text" name="serial_number" class="form-control <?= $validation->hasError('serial_number') ? 'is-invalid' : null ?>" value="<?= old('serial_number', session('temp_data.serial_number')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('serial_number') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Pengguna Aset *</label>
                            <input type="text" name="pengguna_aset" class="form-control <?= $validation->hasError('pengguna_aset') ? 'is-invalid' : null ?>" value="<?= old('pengguna_aset', session('temp_data.pengguna_aset')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('pengguna_aset') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Uraian Kejadian *</label>
                            <textarea name="uraian_kejadian" class="form-control <?= $validation->hasError('uraian_kejadian') ? 'is-invalid' : null ?>"><?= old('uraian_kejadian', session('temp_data.uraian_kejadian')); ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('uraian_kejadian') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tindak Lanjut *</label>
                            <textarea name="tindak_lanjut" class="form-control <?= $validation->hasError('tindak_lanjut') ? 'is-invalid' : null ?>"><?= old('tindak_lanjut', session('temp_data.tindak_lanjut')); ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('tindak_lanjut') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Bisa Diperbaiki *</label>
                            <select name="bisa_diperbaiki" class="form-control <?= $validation->hasError('bisa_diperbaiki') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <option value="1" <?= old('bisa_diperbaiki', session('temp_data.bisa_diperbaiki')) ? 'selected' : null ?>>
                                    Ya
                                </option>
                                <option value="2" <?= old('bisa_diperbaiki', session('temp_data.bisa_diperbaiki')) ? 'selected' : null ?>>
                                    Tidak
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('bisa_diperbaiki'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan Pelapor *</label>
                            <input type="text" name="jabatan_pelapor" class="form-control <?= $validation->hasError('jabatan_pelapor') ? 'is-invalid' : null ?>" value="<?= old('jabatan_pelapor', session('temp_data.jabatan_pelapor')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan_pelapor') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Diketahui Oleh *</label>
                            <input type="text" name="diketahui_oleh" class="form-control <?= $validation->hasError('diketahui_oleh') ? 'is-invalid' : null ?>" value="<?= session('nama') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('diketahui_oleh') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan Menegetahui *</label>
                            <input type="text" name="jabatan_mengetahui" class="form-control <?= $validation->hasError('jabatan_mengetahui') ? 'is-invalid' : null ?>" value="<?= session('jabatan') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan_mengetahui') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ditindak Lanjuti *</label>
                            <input type="text" name="ditindaklanjuti" class="form-control <?= $validation->hasError('ditindaklanjuti') ? 'is-invalid' : null ?>" value="<?= old('ditindaklanjuti', session('temp_data.ditindaklanjuti')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('ditindaklanjuti') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan menindak Lanjuti *</label>
                            <input type="text" name="jabatan_ditindaklanjuti" class="form-control <?= $validation->hasError('jabatan_ditindaklanjuti') ? 'is-invalid' : null ?>" value="<?= old('jabatan_ditindaklanjuti', session('temp_data.jabatan_ditindaklanjuti')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan_ditindaklanjuti') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Diketahui *</label>
                            <input type="text" name="nama_diketahui" class="form-control <?= $validation->hasError('nama_diketahui') ? 'is-invalid' : null ?>" value="<?= old('nama_diketahui', session('temp_data.nama_diketahui')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('nama_diketahui') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan Mengetahui *</label>
                            <input type="text" name="jabatan_diketahui" class="form-control <?= $validation->hasError('jabatan_diketahui') ? 'is-invalid' : null ?>" value="<?= old('jabatan_diketahui', session('temp_data.jabatan_diketahui')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan_diketahui') ?>
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