<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;
use App\Models\Transfer;
use Illuminate\Support\Auth;

class AccountController extends Controller
{
    public function index(){
        $accounts=Accounts::where('user_id', Auth::id())->get();
        return view('pages.home', compact('accounts'));
    }

    public function transfer(){
        return view('pages.transfer');
    }

    public function transferToMyAccount(){
        return view('pages.transfer-my-account');
    }

    public function saveTransfer(Request $request){
        $validateData = $request->validate([
            'from'=>'required|max:22',
            'to'=>'required|max:22',
            'purpose'=>'max:500',
            'amount'=>'required'  
        ]);
        if(Account::where('iban', request('to'))->get()){
            Transfer::create([
                'from'=>request('from'),
                'to'=>request('to'),
                'purpose'=>request('purpose'), 
                'time'=>date("Y-m-d H:i:s"),
                'amount'=>request('amount')
            ]);
            $account = request('from');
            $accountBalance = Account::where('iban', request('from'))->value('balance');
            $accountBalance = $accountBalance + request('amount');
            $recipientBalance = Account::where('iban', request('to'))->value('balance');
            $recipientBalance = $recipientBalance - request('amount');
            Account::where('iban', request('from'))->update(['balance' => $accountBalance]);
            Account::where('iban', request('to'))->update(['balance' => $recipientBalance]);
            return redirect('/');
        }
        else{
            dd("Klaida. Neteisingai nurodyta gavėjo sąskaita."); 
        }
    }

    public function showAccount(Account $account){
        dd($account->all());
        $today = date("Y-m-d H:i:s");
        $daysAgo = mktime(0, 0, 0, date("m"), date("d")-2, date("Y"));
        $transfers = Transfer::where('from', $account->iban)->whereBetween('time', [$daysAgo, $today])->orWhere(function($query) {
            $query->where('to', $account->iban)->whereBetween('time', [$daysAgo, $today]);
            })->paginate(30);
        return view('pages.records', compact('transfers'));
    }

    public function cancelTransfer(Transfer $transfer){
        $account = $transfer->from;
        $accountBalance = Account::where('iban',$transfer->from)->value('balance');
        $accountBalance = $accountBalance + $transfer->amount;
        $recipientBalance = Account::where('iban',$transfer->to)->value('balance');
        $recipientBalance = $recipientBalance - $transfer->amount;
        Account::where('iban',$transfer->from)->update(['balance' => $accountBalance]);
        Account::where('iban',$transfer->to)->update(['balance' => $recipientBalance]);
        $transfer->delete();
        return redirect('/'.$account);
    }

    public function orderRecords(){
        return view('pages.order-records');
    }

    public function showRecords(Request $request){
        dd($request->all());
        $transfers = Transfer::where('from', $account->iban)->whereBetween('time', [$request->start, $request->end])
        ->orWhere(function($query) {
            $query->where('to', $account->iban)->whereBetween('time', [$request->start, $request->end]);
        })->paginate(30);
        return view('pages.records', compact('transfers'));
    }

    public function addAccount(){
        return view('pages.home');
    }

    public function myInfo(){
        return view('pages.my-info');
    }
}




