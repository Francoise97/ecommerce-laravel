<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    // Télécharger la facture PDF d'une commande
    public function download($id)
    {
        $order = Order::with('items')->findOrFail($id);

        // Sécurité : seul l'admin ou le propriétaire peut télécharger
        $user = Auth::user();
        if (!$user->is_admin && $order->user_id !== $user->id) {
            abort(403, 'Accès non autorisé.');
        }

        // Charger la vue et générer le PDF
        $pdf = Pdf::loadView('invoices.order', compact('order'));

        // Options (format A4, orientation portrait)
        $pdf->setPaper('A4', 'portrait');

        // Télécharger avec un nom propre
        $filename = 'facture-commande-' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . '.pdf';

        return $pdf->download($filename);
    }
}
