<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\InvoiceModel;

class WaNotificationFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $invoiceModel = new InvoiceModel();
        $invoices = $invoiceModel->getInvoicesForNotification();

        foreach ($invoices as $invoice) {
            
            if ($invoice['denda'] == 0) {
                $invoiceModel->update($invoice['id'], ['denda' => 100000]);
                // dd($invoice);
                $this->sendWhatsAppMessage($invoice);
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }

    private function sendWhatsAppMessage($invoice)
{
    $token = 'Qu1Grr9BN1g4NC6dfx7h';

    $nomorCustomer = preg_replace('/^08/', '628', $invoice['no_hp']);

    $message = "Halo *{$invoice['nama']}*,\n\n".
        "Tagihan Anda dengan Invoice ID *{$invoice['invoice']}* telah jatuh tempo.\n".
        "💰 *Denda: Rp 100.000*\n".
        "🏠 Alamat: *{$invoice['alamat']}*\n".
        "⚡ ID Meteran: *{$invoice['id_meteran']}*\n\n".
        "Mohon segera lakukan pembayaran!\n\n".
        "Terima kasih 🙏";

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.fonnte.com/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'target' => $nomorCustomer,
            'message' => $message,
        ],
        CURLOPT_HTTPHEADER => ["Authorization: $token"]
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    // dd("Nomor yang dikirim:", $nomorCustomer, "Response dari API:", $response);
}

}
