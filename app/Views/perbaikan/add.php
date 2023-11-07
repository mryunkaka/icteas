<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Tambah Data Permohonan Perbaikan &mdash; SI ICT</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Create Permohonan Perbaikan ICT</h1>
            <div class="section-header-button">
                <a href="<?= base_url('perbaikan/home') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Buat PFI</h4>
                </div>
                <div class="card-body col-md-6">
                    <?php $validation = \Config\Services::validation(); ?>
                    <form action="<?= site_url('perbaikan/create') ?>" method="post" autocomplete="off">
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
                            <label>No Perbaikan *</label>
                            <input type="text" name="no_perbaikan" class="form-control <?= $validation->hasError('no_perbaikan') ? 'is-invalid' : null ?>" value="<?= $no_perbaikan['no_perbaikan'] + 1 ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('no_perbaikan') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Perbaikan *</label>
                            <input type="date" name="tanggal_perbaikan" class="form-control <?= $validation->hasError('tanggal_perbaikan') ? 'is-invalid' : null ?>" value="<?= date('Y-m-d') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tanggal_perbaikan') ?>
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
                            <label>Jabatan Pemohon *</label>
                            <input type="text" name="jabatan_pemohon" class="form-control <?= $validation->hasError('jabatan_pemohon') ? 'is-invalid' : null ?>" value="<?= old('jabatan_pemohon', session('temp_data.jabatan_pemohon')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan_pemohon') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dept. Pemohon *</label>
                            <input type="text" name="dept_pemohon" class="form-control <?= $validation->hasError('dept_pemohon') ? 'is-invalid' : null ?>" value="<?= old('dept_pemohon', session('temp_data.dept_pemohon')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('dept_pemohon') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Barang *</label>
                            <select name="jenis_barang" class="form-control <?= $validation->hasError('jenis_barang') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <option value="Komputer" <?= old('jenis_barang', session('temp_data.jenis_barang')) ? 'selected' : null ?>>
                                    Komputer
                                </option>
                                <option value="Printer" <?= old('jenis_barang', session('temp_data.jenis_barang')) ? 'selected' : null ?>>
                                    Printer
                                </option>
                                <option value="Monitor" <?= old('jenis_barang', session('temp_data.jenis_barang')) ? 'selected' : null ?>>
                                    Monitor
                                </option>
                                <option value="Laptop" <?= old('jenis_barang', session('temp_data.jenis_barang')) ? 'selected' : null ?>>
                                    Laptop
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('jenis_barang'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Barang Lainnya</label>
                            <input type="text" name="jb_lainnya" class="form-control <?= $validation->hasError('jb_lainnya') ? 'is-invalid' : null ?>" value="<?= old('jb_lainnya', session('temp_data.jb_lainnya')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jb_lainnya') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Masalah *</label>
                            <select name="masalah" class="form-control <?= $validation->hasError('masalah') ? 'is-invalid' : null ?>" ?>
                                <option value="" hidden></option>
                                <option value="Komputer Mati" selected <?= old('masalah', session('temp_data.masalah')) ? 'selected' : null ?>>
                                    Komputer Mati
                                </option>
                                <option value="Komputer Tidak Mau, Restart/Hang/Error Bunyi" <?= old('masalah', session('temp_data.masalah')) ? 'selected' : null ?>>
                                    Komputer Tidak Mau, Restart/Hang/Error Bunyi
                                </option>
                                <option value="System Operasi Error/Layar Biru" <?= old('masalah', session('temp_data.masalah')) ? 'selected' : null ?>>
                                    System Operasi Error/Layar Biru
                                </option>
                                <option value="Virus Tidak Dapat Dibersihkan" <?= old('masalah', session('temp_data.masalah')) ? 'selected' : null ?>>
                                    Virus Tidak Dapat Dibersihkan
                                </option>
                                <option value="Printer Mati" <?= old('masalah', session('temp_data.masalah')) ? 'selected' : null ?>>
                                    Printer Mati
                                </option>
                                <option value="Head Printer Rusak/Tidak Mau Cetak" <?= old('masalah', session('temp_data.masalah')) ? 'selected' : null ?>>
                                    Head Printer Rusak/Tidak Mau Cetak
                                </option>
                                <option value="Monitor Mati" <?= old('masalah', session('temp_data.masalah')) ? 'selected' : null ?>>
                                    Monitor Mati
                                </option>
                                <option value="Monitor Bergetar" <?= old('masalah', session('temp_data.masalah')) ? 'selected' : null ?>>
                                    Monitor Bergetar
                                </option>
                                <option value="Monitor Bergetar" <?= old('masalah', session('temp_data.masalah')) ? 'selected' : null ?>>
                                    Monitor Bergetar
                                </option>
                                <option value="Monitor Buram" <?= old('masalah', session('temp_data.masalah')) ? 'selected' : null ?>>
                                    Monitor Buram
                                </option>
                                <option value="Laptop Tidak Bisa Menyala" <?= old('masalah', session('temp_data.masalah')) ? 'selected' : null ?>>
                                    Laptop Tidak Bisa Menyala
                                </option>
                                <option value="Laptop Hang/Layar Biru/Hard Disk Berbunyi" <?= old('masalah', session('temp_data.masalah')) ? 'selected' : null ?>>
                                    Laptop Hang/Layar Biru/Hard Disk Berbunyi
                                </option>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('masalah'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Masalah Lainnya</label>
                            <input type="text" name="lainya" class="form-control <?= $validation->hasError('lainya') ? 'is-invalid' : null ?>" value="<?= old('lainya', session('temp_data.lainya')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('lainya') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Masalah Kerusakan*</label>
                            <textarea name="masalah_kerusakan" class="form-control <?= $validation->hasError('masalah_kerusakan') ? 'is-invalid' : null ?>"><?= old('masalah_kerusakan', session('temp_data.masalah_kerusakan')); ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('masalah_kerusakan') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Diperiksa*</label>
                            <input type="text" name="diperiksa" class="form-control <?= $validation->hasError('diperiksa') ? 'is-invalid' : null ?>" value="<?= session('nama') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('diperiksa') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan Pemeriksa</label>
                            <input type="text" name="jabatan_pemeriksa" class="form-control <?= $validation->hasError('jabatan_pemeriksa') ? 'is-invalid' : null ?>" value="<?= session('jabatan') ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan_pemeriksa') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Disetujui</label>
                            <input type="text" name="disetujui" class="form-control <?= $validation->hasError('disetujui') ? 'is-invalid' : null ?>" value="<?= old('disetujui', session('temp_data.disetujui')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('disetujui') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan Menyetujui</label>
                            <input type="text" name="jabatan_menyetujui" class="form-control <?= $validation->hasError('jabatan_menyetujui') ? 'is-invalid' : null ?>" value="<?= old('jabatan_menyetujui', session('temp_data.jabatan_menyetujui')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan_menyetujui') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Diketahui</label>
                            <input type="text" name="diketahui" class="form-control <?= $validation->hasError('diketahui') ? 'is-invalid' : null ?>" value="<?= old('diketahui', session('temp_data.diketahui')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('diketahui') ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jabatan Menegetahui</label>
                            <input type="text" name="jabatan_mengetahui" class="form-control <?= $validation->hasError('jabatan_mengetahui') ? 'is-invalid' : null ?>" value="<?= old('jabatan_mengetahui', session('temp_data.jabatan_mengetahui')); ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('jabatan_mengetahui') ?>
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