<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiAwalModel extends Model
{
    protected $table = 'transaksi_awal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_meteran', 'nominal', 'status_bayar','bukti_bayar', 'tanggal_pembayaran', 'created_at', 'updated_at'];

    public function getTransaksiWithPengguna()
    {
        return $this->select('
                transaksi_awal.*, 
                pengguna.nama, 
                pengguna.alamat, 
                pengguna.no_hp,
            ')
            ->join('pengguna', 'pengguna.id_meteran = transaksi_awal.id_meteran', 'left')
            ->findAll();
    }

}
