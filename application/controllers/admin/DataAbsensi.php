<?php

class DataAbsensi extends CI_Controller {
    
    public function index()
    {
        $data['title'] = "Data Absensi Pegawai";

        // Filter Absensi
        if (isset($_GET['bulan']) && isset($_GET['tahun'])){
            $bulan = $this->input->get('bulan');
            $tahun = $this->input->get('tahun');

            $bulantahun = $bulan.$tahun;
        } else {
            $currMonth = date('m');
            $currYear = date('Y');
            redirect("admin/dataAbsensi?bulan=$currMonth&tahun=$currYear");
        }

        $data['jumlah_pegawai'] = $this->db->query("SELECT * FROM data_pegawai")->result();
        $data['absensi'] = $this->db->query("
            SELECT data_kehadiran.*,
            data_pegawai.nama_pegawai,
            data_pegawai.jenis_kelamin,
            data_pegawai.jabatan
            FROM data_kehadiran
            INNER JOIN data_pegawai ON data_kehadiran.nik = data_pegawai.nik
            INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
            WHERE data_kehadiran.bulan = '$bulantahun'
            ORDER BY data_pegawai.nama_pegawai ASC
        ")->result();

        $this->load->view('header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/dataAbsensi', $data);
        $this->load->view('footer');
    }

    public function inputAbsensi()
    { 
        if ($this->input->post('submit', TRUE) == 'submit'){
            $post = $this->input->post();
            
            foreach ($post['bulan'] as $key => $value) {
                if($post['bulan'][$key] != '' || $nik['bulan'][$key] != ''){
                    $simpan[] = array(
                        'bulan'          => $post['bulan'][$key],
                        'nik'            => $post['nik'][$key],
                        'nama_pegawai'   => $post['nama_pegawai'][$key],
                        'jenis_kelamin'  => $post['jenis_kelamin'][$key],
                        'nama_jabatan'   => $post['nama_jabatan'][$key],
                        'hadir'          => $post['hadir'][$key],
                        'sakit'          => $post['sakit'][$key],
                        'alpha'          => $post['alpha'][$key]
                    );
                }
            }
            // Fetch data bulan & tahun
            $bulan = substr(($post['bulan'][0]),0,2);
            $tahun = substr(($post['bulan'][0]),2,4);

            $this->penggajianModel->insert_batch('data_kehadiran', $simpan);
            $this->session->set_flashdata('pesan','
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data Berhasil Ditambahkan!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
            ');
            redirect('admin/dataAbsensi?bulan='.$bulan.'&tahun='.$tahun);
        }

        $data['title'] = "Form Input Absensi";

        // Filter Absensi
        if (isset($_GET['bulan']) && isset($_GET['tahun'])){
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan.$tahun;
        } else { 
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan.$tahun;
        }

        // Tampilkan data selain yang sudah diinput
        $data['input_absensi'] = $this->db->query("
        SELECT data_pegawai.*, 
        data_jabatan.nama_jabatan
        FROM data_pegawai
        INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
        WHERE NOT EXISTS (
            SELECT * FROM data_kehadiran 
            WHERE bulan='$bulantahun' 
            AND data_pegawai.nik = data_kehadiran.nik
            )
        ORDER BY data_pegawai.nama_pegawai ASC
        ")->result()
        ;

        $this->load->view('header', $data);
        $this->load->view('templates_admin/sidebar');
        $this->load->view('admin/formInputAbsensi', $data);
        $this->load->view('footer');
    }
}