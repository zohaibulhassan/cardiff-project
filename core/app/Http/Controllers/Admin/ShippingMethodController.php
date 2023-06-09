<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShippingMethod;
use App\Models\queries;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller {
    public function index(Request $request) {
        $pageTitle    = 'All Queries';
        $emptyMessage = 'No shipping methods found';
        $users = Queries::all();
        return view('admin.shipping.index', compact('pageTitle', 'emptyMessage','users'));
    }

    public function store(Request $request, $id = 0) {

        $request->validate([
            'name'  => 'required|max: 40|unique:shipping_methods,name,' . $id,
            'price' => 'required|numeric|min:0',
        ]);

        if ($id) {
            $shipping         = ShippingMethod::findOrFail($id);
            $shipping->status = $request->status ? 1 : 0;
            $notification     = 'Shipping method updated successfully.';
        } else {
            $shipping     = new ShippingMethod();
            $notification = 'Shipping method added successfully.';
        }

        $shipping->name  = $request->name;
        $shipping->price = $request->price;
        $shipping->save();

        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }

}
