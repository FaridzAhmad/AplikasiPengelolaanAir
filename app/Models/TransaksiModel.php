<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_meteran', 'invoice','meteran_awal', 'Meteran_akhir', 'jumlah_pakai','jumlah_tagihan', 'periode_bulan','periode_tahun', 'created_at', 'updated_at'];

}
