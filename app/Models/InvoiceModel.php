<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoice';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'invoice', 'jumlah_tagihan', 'status_bayar', 'tanggal_pembayaran','bukti_bayar', 'created_at', 'update_at'
    ];

}
