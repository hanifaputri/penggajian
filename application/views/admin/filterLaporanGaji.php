<div class="container-fluid">

    <div class="card mx-auto" style="max-width:500px;">
        <div class="card-header bg-primary text-white text-center">
            Filter Laporan Gaji Pegawai
        </div>
        <div class="card-body">
        <?php echo $this->session->flashdata('pesan')?>
        <form method="POST" action="<?php echo base_url('admin/laporanGaji/cetakLaporanGaji')?>">
            <div class="form-group row mb-4">
                <label for="inputPassword" class="col-sm-4 col-form-label">Bulan</label>
                <div class="col-sm-8">
                    <select class="form-control" name="bulan" required>
                        <option value="">--Pilih Bulan--</option>
                        <?php
                        $opsiBulan = array(
                            "01" => "Januari",
                            "02" => "Februari",
                            "03" => "Maret",
                            "04" => "April",
                            "05" => "Mei",
                            "06" => "Juni",
                            "07" => "Juli",
                            "08" => "Agustus",
                            "09" => "September",
                            "10" => "Oktober",
                            "11" => "November",
                            "12" => "Desember"
                        );
                        
                        foreach ($opsiBulan as $index => $namaBulan) {
                            echo "<option value='$index'>$namaBulan</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-4 col-form-label">Tahun</label>
                <div class="col-sm-8">
                    <select class="form-control" name="tahun" required>
                        <option value="">--Pilih Tahun--</option>
                        <?php 
                        $tahunSekarang = date('Y');
                        for ($th = $tahunSekarang; $th < $tahunSekarang + 5; $th++) {
                            echo "<option value='$th'>$th</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-block btn-success">
                <i class="fas fa-print mr-3"></i>
                Cetak Laporan Gaji
            </button>
            </form>
        </div>
    </div>

</div>
</div>
<!-- End of Main Content -->