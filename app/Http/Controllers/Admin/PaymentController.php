<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function paymentPage(){
        return view('admin.payments.index');
    }

    public function store(Request $request) 
    {
        $request->validate([
        'private_key'     => 'required|string',
        'secret_key'      => 'required|string',
    ]);

    $data = $request->only(['private_key', 'secret_key']);

    Payment::create($data);

    return back()->with('success', 'Payment added successfully!');
  }


    

}
