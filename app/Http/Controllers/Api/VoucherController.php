<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index(Request $request)
    {
        $voucher = Voucher::query();

        if ($request->category_id) {
            $voucher->where('category_id', $request->category_id);
        }

        if ($request->history == 0) {
            $voucher->doesntHave('claim');
            $total =  Voucher::doesntHave('claim')->count();
        } else {
            $total =  Voucher::has('claim')->count();
            $voucher->has('claim');
        }

        $resuslt = $voucher->paginate(10);


        return response()->json([
            'status' => 'success',
            'data' => $resuslt,
            'total' => $total,
        ]);
    }


    public function store(Request $request)
    {
        $voucher = Voucher::create($request->all());
        return response()->json($voucher, 201);
    }

    public function show($id)
    {
        return Voucher::find($id);
    }

    public function update(Request $request, $id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->update($request->all());
        return response()->json($voucher, 200);
    }

    public function destroy($id)
    {
        $voucher = Voucher::find($id);
        $voucher->claim()->delete();
        return response()->json(null, 204);
    }
}
