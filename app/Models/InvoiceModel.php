<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoice';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'invoice', 'jumlah_tagihan','denda','batas_waktu_bayar','status_bayar', 'tanggal_pembayaran','bukti_bayar', 'created_at', 'update_at'
    ];
    
    // public function getInvoicesForNotification()
    // {
    //     return $this->where('batas_waktu_bayar', date('Y-m-d')) 
    //                 ->where('status_bayar', 'belum bayar')
    //                 ->findAll();
    // }

    public function getInvoicesForNotification()
{
    return $this->select('
            invoice.id, 
            invoice.invoice, 
            invoice.jumlah_tagihan, 
            invoice.denda, 
            invoice.batas_waktu_bayar, 
            invoice.status_bayar, 
            transaksi.id_meteran, 
            pengguna.nama, 
            pengguna.alamat, 
            pengguna.no_hp
        ')
        ->join('transaksi', 'transaksi.invoice = invoice.invoice') // Join ke transaksi
        ->join('pengguna', 'pengguna.id_meteran = transaksi.id_meteran') // Join ke pengguna
        ->where('invoice.batas_waktu_bayar', '2025-04-20') // Hanya yang jatuh tempo hari ini
        ->where('invoice.status_bayar', 'belum lunas') // Hanya yang belum bayar
        ->findAll();
}

}


