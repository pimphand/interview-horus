<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\VoucherClaim;
use Illuminate\Http\Request;

class VoucherClaimController extends Controller
{
    public function index()
    {
        return VoucherClaim::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'voucher_id' => 'required|exists:vouchers,id'
        ]);

        $voucher = Voucher::find($request->voucher_id);
        $voucher->claim()->create();

        return response()->json($voucher, 201);
    }

    public function show($id)
    {
        return VoucherClaim::find($id);
    }

    public function update(Request $request, $id)
    {
        $voucherClaim = VoucherClaim::findOrFail($id);
        $voucherClaim->update($request->all());
        return response()->json($voucherClaim, 200);
    }

    public function destroy($id)
    {
        $voucher = Voucher::find($id);
        $voucher->claim()->delete();
        return response()->json(null, 204);
    }
}
