<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class AdminCouponController extends Controller
{
    // Liste des coupons
    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    // Formulaire de création
    public function create()
    {
        return view('admin.coupons.create');
    }

    // Enregistrer un coupon
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code',
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0.01',
            'min_amount' => 'nullable|numeric|min:0',
            'expires_at' => 'nullable|date|after:today',
            'max_uses' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['code'] = strtoupper(trim($data['code']));
        $data['min_amount'] = $data['min_amount'] ?? 0;
        $data['is_active'] = $request->has('is_active');

        Coupon::create($data);

        return redirect()->route('admin.coupons')->with('success', 'Code promo créé avec succès !');
    }

    // Formulaire d'édition
    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    // Mettre à jour un coupon
    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code,' . $id,
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0.01',
            'min_amount' => 'nullable|numeric|min:0',
            'expires_at' => 'nullable|date',
            'max_uses' => 'nullable|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['code'] = strtoupper(trim($data['code']));
        $data['min_amount'] = $data['min_amount'] ?? 0;
        $data['is_active'] = $request->has('is_active');

        $coupon->update($data);

        return redirect()->route('admin.coupons')->with('success', 'Code promo modifié.');
    }

    // Supprimer un coupon
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('admin.coupons')->with('success', 'Code promo supprimé.');
    }

    // Activer/désactiver rapidement
    public function toggle($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->is_active = !$coupon->is_active;
        $coupon->save();

        $status = $coupon->is_active ? 'activé' : 'désactivé';
        return redirect()->back()->with('success', "Code promo {$status}.");
    }
}
