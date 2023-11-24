<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function index(): View
    {
        Session::forget('session');
        $data = Sale::with('customer')
        ->get();

        return view('contents.sale.index', compact('data'));
    }

    public function create(): View
    {
        $item = Item::get()
        ->pluck('name', 'id');
        $customer = Customer::get()
        ->pluck('name', 'id');
        $session = Session::get('session');

        return view('contents.sale.create', compact('item', 'session', 'customer'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'tgl' => 'required|date',
            'customer' => 'required|exists:customers,id',
            'total' => 'required|integer'
        ]);

        if ($request->total == 0) {
            return redirect()->back()->with('status', 'sale-error');
        }
        
        $sale = Sale::create([
            'tgl' => $request->tgl,
            'customer_id' => $request->customer,
            'total' => $request->total
        ]);

        $session = Session::get('session');
        foreach ($session as $val) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'item_id' => $val['item'],
                'qty' => $val['qty']
            ]);
        }

        Session::forget('session');

        return redirect()->back()->with('status', 'sale-created');
    }

    public function edit($id): View
    {
        $sale = Sale::where('id', $id)
        ->first();
        $saleItem = SaleItem::where('sale_id', $id)
        ->with('item')
        ->get();
        $item = Item::get()
        ->pluck('name', 'id');
        $customer = Customer::get()
        ->pluck('name', 'id');

        return view('contents.sale.edit', compact('sale', 'saleItem','item', 'customer'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'tgl' => 'required|date',
            'customer' => 'required|exists:customers,id',
            'total' => 'required|integer'
        ]);

        Sale::where('id', $id)
        ->update([
            'tgl' => $request->tgl,
            'customer_id' => $request->customer,
            'total' => $request->total
        ]);

        return redirect()->back()->with('status', 'sale-updated');
    }

    public function destroy($id): RedirectResponse
    {
        Sale::where('id', $id)
        ->delete();

        return redirect()->back();
    }

    public function saleArray(Request $request): RedirectResponse
    {
        $request->validate([
            'item' => 'required|exists:items,id',
            'qty' => 'required|integer'
        ]);

        $item = Item::where('id', $request->item)
        ->first();

        $data = [
            'item' => $request->item,
            'name' => $item->name,
            'price' => $item->price,
            'qty' => $request->qty,
            'total' => $item->price * $request->qty
        ];

        $session = Session::get('session');
        if($session !== null){
            array_push($session, $data);
            Session::put('session', $session);
        } else {
            $session = [];
            array_push($session, $data);
            Session::push('session', $data);
        }

        return redirect()->back();
    }

    public function saleArrayDelete($record_id): RedirectResponse
    {
        $new = array();
        $session = Session::get('session');

        foreach($session as $key=>$val){
            if($key != $record_id){
                $new[$key] = $val;
            }
        }

        Session::forget('session');
        Session::put('session', $new);

        return redirect()->back();
    }

    public function saleAddItem(Request $request): RedirectResponse
    {
        $request->validate([
            'item' => 'required|exists:items,id',
            'qty' => 'required|integer',
            'sale_id' => 'required|exists:sales,id'
        ]);
        
        SaleItem::create([
            'sale_id' => $request->sale_id,
            'item_id' => $request->item,
            'qty' => $request->qty
        ]);

        $total = 0;
        $saleItem = SaleItem::where('id', $request->sale_id)
        ->get();

        foreach ($saleItem as $val) {
            $total += $val->qty * $val->item->price;
        }

        Sale::where('id', $request->sale_id)
        ->update([
            'total' => $total
        ]);

        return redirect()->back();
    }

    public function saleDeleteItem($id): RedirectResponse
    {
        $data = SaleItem::where('id', $id)
        ->first();

        $total = 0;
        $saleItem = SaleItem::where('id', $data->sale_id)
        ->get();

        foreach ($saleItem as $val) {
            $total += $val->qty * $val->item->price;
        }

        Sale::where('id', $data->sale_id)
        ->update([
            'total' => $total
        ]);

        SaleItem::where('id', $id)
        ->delete();

        return redirect()->back();
    }
}
