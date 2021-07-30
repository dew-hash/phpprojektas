<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;
use App\Models\Transfer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class TransferController extends Controller
{
    public function makeTransfer(Account $account){
        Transfer::create([
            'fromiban'=> $account->iban,
            'toiban' => request('to'),
            'purpose' => request('purpose'),
            'currency' => request('currency'),
            'amount' => request('amount'),
            'time' => date("Y-m-d H:i:s")
        ]);
        return back();
    }
}
