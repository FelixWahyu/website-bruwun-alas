<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::latest()->paginate(8);

        return view('admin.payment.payment-page', compact('paymentMethods'));
    }

    public function create()
    {
        return view('admin.payment.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:50',
            'account_number' => 'required|string|max:50',
            'account_name' => 'required|string|max:100',
            'logo' => 'nullable|image|mimes:jpeg,jpg,webp,png|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('bank_logos', 'public');
        }

        PaymentMethod::create([
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'logo' => $logoPath,
            'is_active' => true,
        ]);

        return redirect()->route('admin.payment-method.index')->with('success', 'Berhasil tambah data rekening baru');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment.edit', compact('paymentMethod'));
    }

    public function update(PaymentMethod $paymentMethod, Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string|max:50',
            'account_number' => 'required|string|max:50',
            'account_name' => 'required|string|max:100',
            'logo' => 'nullable|image|mimes:jpeg,jpg,webp,png|max:2048',
        ]);

        $data = [
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'is_active' => $request->has('is_active')
        ];

        if ($request->hasFile('logo')) {
            if ($paymentMethod->logo && Storage::disk('public')->exists($paymentMethod->logo)) {
                Storage::disk('public')->delete($paymentMethod->logo);
            }
            $data['logo'] = $request->file('logo')->store('bank_logos', 'public');
        }

        $paymentMethod->update($data);

        return redirect()->route('admin.payment-method.index')->with('success', 'Berhasil rubah data rekening');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->logo && Storage::disk('public')->exists($paymentMethod->logo)) {
            Storage::disk('public')->delete($paymentMethod->logo);
        }

        $paymentMethod->delete();

        return redirect()->back()->with('success', 'Berhasil hapus data rekening.');
    }
}
