<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CategoryVoucher;
use Illuminate\Http\Request;

class CategoryVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = CategoryVoucher::withCount(['vouchers' => function ($query) use ($request) {
            if ($request->history == 0) {
                $query->doesntHave('claim');
            } else {
                $query->has('claim');
            }
        }])->get();
        return $categories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
