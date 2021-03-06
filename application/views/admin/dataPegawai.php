<div class="container-fluid">

    <div class="d-flex">
        <div class="p-2">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
        </div>
        <div class="p-2 ml-auto">
            <!-- Tambah Data -->
            <a class="btn btn-success btn-icon-split mb-4"  href="<?php echo base_url('admin/dataPegawai/tambahData')?>">
                <span class="icon text-white">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text font-weight-bold">Tambah Data</span>
            </a>
        </div>
    </div>

    <!-- Notifikasi -->
    <?php echo $this->session->flashdata('pesan')?>

    <!-- Tabel -->
    <div class="table-responsive p-2 mb-4">
        <table id="dataTable" class="table table-bordered table-striped mt-2">
            <thead class="text-center">
                <tr>
                    <th class="align-middle">No</th>
                    <th class="align-middle">NIK</th>
                    <th class="align-middle">Nama Pegawai</th>
                    <th class="align-middle">Jenis Kelamin</th>
                    <th class="align-middle">Jabatan</th>
                    <th class="align-middle">Status</th>
                    <th class="align-middle">Photo</th>
                    <th class="align-middle">Hak Akses</th>
                    <th class="align-middle">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $no=1; foreach($pegawai as $p) : ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $p->nik ?></td>
                    <td><?php echo $p->nama_pegawai ?></td>
                    <td><?php echo $p->jenis_kelamin ?></td>
                    <td><?php echo $p->jabatan ?></td>
                    <td><?php echo $p->status ?></td>
                    <td><img style="width:75px" src="<?php echo base_url('assets/photo/').$p->photo ?>"></img></td>
                    <td><?php echo ($p->hak_akses == '1')? 'Admin':'Pegawai';?></td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/dataPegawai/updateData/'.$p->id_pegawai)?>"><i class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $no?>"><i class="fas fa-trash"></i></button>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal<?php echo $no?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus data ini? Data yang dihapus tidak dapat dikembalikan.
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-secondary">Tidak</button>
                                <a class="btn btn-danger" href="<?php echo base_url('admin/dataPegawai/deleteData/'.$p->id_pegawai)?>">Hapus Data</a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>


</div>
</div>
<!-- End of Main Content -->

