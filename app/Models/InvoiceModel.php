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

    public function getInvoiceDetails($id_meteran)
    {
        return $this->select('
                invoice.*, 
                transaksi.id_meteran, 
                pengguna.nama, 
                pengguna.alamat
            ')
            ->join('transaksi', 'transaksi.invoice = invoice.invoice', 'left') 
            ->join('pengguna', 'pengguna.id_meteran = transaksi.id_meteran', 'left')
            ->where('transaksi.id_meteran', $id_meteran)
            ->orderBy('invoice.id', 'ASC') // Urutkan dari yang paling lama ke terbaru
            ->offset(1) // Lewati baris pertama
            ->limit(100) // Batasi jumlah data agar offset berfungsi dengan baik
            ->findAll();
    }

    public function getPembayaranBulanan()
    {
        return $this->select('invoice.*, transaksi.*, pengguna.nama, pengguna.alamat')
            ->join('transaksi', 'transaksi.invoice = invoice.invoice')
            ->join('pengguna', 'pengguna.id_meteran = transaksi.id_meteran')
            ->where('invoice.status_bayar', 'belum lunas')
            ->where('invoice.tanggal_pembayaran IS NOT NULL', null, false) 
            ->findAll();
    
    }

}


