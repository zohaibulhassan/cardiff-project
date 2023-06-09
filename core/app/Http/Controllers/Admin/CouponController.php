<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Admin;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index() {
        $pageTitle    = 'All Users';
        $emptyMessage = 'No coupon found';
        $users = Admin::all();
        // $coupons      = Coupon::query();

        // if ($request->search) {
        //     $coupons->where('name', 'LIKE', "%$request->search%");
        // }

        // $coupons = $coupons->latest()->paginate(getPaginate());
        return view('admin.coupon.index', compact('pageTitle', 'emptyMessage', 'users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required|min:6',
        ]);
        $admin = new Admin;
        $admin->name = $validatedData['name'];
        $admin->email = $validatedData['email'];
        $admin->username = $validatedData['username'];
        $admin->password = bcrypt($validatedData['password']);
        $admin->save();
        $notification = "User created successfully";


        $notify[] = ['success', $notification];
        return back()->withNotify($notify);
    }
    public function delete($id) {
        Admin::find($id)->delete();
        $notification = "User delete successfully";
        $notify[] = ['danger', $notification];
        return back()->withNotify($notify);
    }
}
