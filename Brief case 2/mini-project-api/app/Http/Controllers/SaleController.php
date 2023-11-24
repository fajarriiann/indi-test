<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(): JsonResponse
    {
        $data = Sale::with('saleItem')
        ->get();

        return response()->json([
            'message' => 'Sale successfully taken.',
            'data' => $data
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
            'tgl' => 'required|date',
            'saleItem' => 'required|array',
            'saleItem.*.item_id' => 'required|integer',
            'saleItem.*.qty' => 'required|integer'
        ]);

        $total = 0;
        foreach ($request->saleItem as $val) {
            $item = Item::where('id', $val['item_id'])
            ->first();

            $total += $item->price * $val['qty'];
        }

        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'tgl' => $request->tgl,
            'total' => $total
        ]);

        foreach ($request->saleItem as $val) {
            $sale->saleItem()->create([
                'sale_id' => $sale->id,
                'item_id' => $val['item_id'],
                'qty' => $val['qty']
            ]);
        }

        return response()->json([
            'message' => 'Sale successfully created.',
            'data' => $sale->where('id', $sale->id)->with('saleItem')->first()
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
            'tgl' => 'required|date',
            'saleItem' => 'required|array',
            'saleItem.*.item_id' => 'required|integer',
            'saleItem.*.qty' => 'required|integer'
        ]);

        $total = 0;
        foreach ($request->saleItem as $val) {
            $item = Item::where('id', $val['item_id'])
            ->first();

            $total += $item->price * $val['qty'];
        }

        Sale::where('id', $id)
        ->update([
            'customer_id' => $request->customer_id,
            'tgl' => $request->tgl,
            'total' => $total
        ]);

        SaleItem::where('sale_id', $id)
        ->delete();

        foreach ($request->saleItem as $val) {
            SaleItem::create([
                'sale_id' => $id,
                'item_id' => $val['item_id'],
                'qty' => $val['qty']
            ]);
        }

        return response()->json([
            'message' => 'Sale successfully updated.',
            'data' => Sale::where('id', $id)
            ->with('saleItem')
            ->first()
        ], 201);
    }

    public function destroy($id): JsonResponse
    {
        Sale::find($id)
        ->delete();

        return response()->json([
            'message' => 'Sale successfully deleted.',
        ], 200);
    }
}
