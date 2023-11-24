<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(): View
    {
        $data = Customer::all();

        return view('contents.customer.index', compact('data'));
    }

    public function create(): View
    {
        return view('contents.customer.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'domisili' => 'required',
            'gender' => 'required|in:PRIA,WANITA'
        ]);

        Customer::create([
            'name' => $request->name,
            'domisili' => $request->domisili,
            'gender' => $request->gender
        ]);

        return redirect()->back()->with('status', 'customer-created');
    }

    public function edit($id): View
    {
        $data = Customer::where('id', $id)
        ->first();

        return view('contents.customer.edit', compact('data'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'domisili' => 'required',
            'gender' => 'required|in:PRIA,WANITA'
        ]);

        Customer::where('id', $id)
        ->update([
            'name' => $request->name,
            'domisili' => $request->domisili,
            'gender' => $request->gender
        ]);

        return redirect()->back()->with('status', 'customer-updated');
    }

    public function destroy($id): RedirectResponse
    {
        Customer::where('id', $id)
        ->delete();

        return redirect()->back();
    }
}
