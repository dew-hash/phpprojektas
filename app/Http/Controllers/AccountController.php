<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\User;
use App\Models\Transfer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AccountController extends Controller
{
    public function index(){
        $accounts=Account::where('user_id', Auth::id())->get();
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
        $transfersFromMyAccount = DB::table('transfers')
            ->where('from', '=', $accounts->iban)->whereBetween('time', [$daysAgo, $today]);
        $transfersWithoutNames = DB::table('transfers')
            ->where('to', '=', $accounts->iban)->whereBetween('time', [$daysAgo, $today])
            ->union($transfersFromMyAccount);
        $tranfers = DB::table('accounts')->joinSub($transfersWithoutNames, 'transfersWithoutNames', function ($join) {
                $join->on('accounts.iban', '=', 'transfersWithoutNames.to');
                })->select('transfersWithoutNames.*', 'accounts.user_id as to_user_id');  
        $tranfersWithToNames = DB::table('users')->joinSub($tranfers, 'tranfers', function ($join) {
                $join->on('user.id', '=', 'tranfers.to_user_id');
                })->select('tranfers.*', 'users.name as to_name'); 
        $tranfers = DB::table('accounts')->joinSub($tranfersWithToNames, 'tranfersWithToNames', function ($join) {
                $join->on('accounts.iban', '=', 'tranfersWithToNames.from');
                })->select('tranfersWithToNames.*', 'accounts.user_id as from_user_id');
        $tranfersWithNames = DB::table('users')->joinSub($tranfers, 'tranfers', function ($join) {
                $join->on('user.id', '=', 'tranfers.from_user_id');
                })->select('tranfers.*', 'users.name as from_name')->orderBy('time', 'desc')->paginate(30);

        /* $transfersFromAccount = DB::table('transfers')->leftJoin('accounts', function ($join) {
            $join->on('transfers.from', '=', 'accounts.iban')->orOn('transfers.to', '=', 'accounts.iban')
            ->where('to', '=', $accounts->iban)->whereBetween('time', [$daysAgo, $today]);
            })->select('transfers.*', 'accounts.user_id');
        $transfersToAccount = DB::table('transfers')->Join('accounts', function ($join) {
            $join->on('transfers.from', '=', 'accounts.iban')->orOn('transfers.to', '=', 'accounts.iban')
            ->where('from', '=', $accounts->iban)->whereBetween('time', [$daysAgo, $today]);
            })->select('transfers.*', 'accounts.user_id');                       
                
        $transfersWithToNames = DB::table('accounts')->join('users', 'accounts.user_id', '=', 'users.id')
            ->joinSub($transfersWithoutNames, 'transfersWithoutNames', function ($join) {
                $join->on('accounts.iban', '=', 'transfersWithoutNames.to');
                })->select('transfersWithoutNames.*', 'users.name as to_name');
        $transfersWithNames = DB::table('accounts')->join('users', 'accounts.user_id', '=', 'users.id')
            ->joinSub($transfersWithToNames, 'transfersWithToNames', function ($join) {
                $join->on('accounts.iban', '=', 'transfersWithToNames.from');
                })->select('transfersWithToNames.*', 'users.name as from_name')->orderBy('time', 'desc');
      
        $fromAccountWithName = DB::table('accounts')->join('users', 'accounts.user_id', '=', 'users.id')
        ->joinSub($transfersFromAccount, 'latest_transfers_from', function ($join) {
            $join->on('accounts.iban', '=', 'latest_transfers_from.to');
            })->select('latest_transfers_from.*', 'users.name as to_name');
        $transfersToAccount = DB::table('transfers')->where('to', '=', $accounts->iban)->whereBetween('time', [$daysAgo, $today]);
        $toAccountWithName = DB::table('accounts')
            ->join('users', 'accounts.user_id', '=', 'users.id')
            ->leftJoinSub($transfersToAccount, 'latest_transfers_to', function ($join) {
            $join->on('accounts.iban', '=', 'latest_transfers_to.from')->orOn('accounts.iban', '=', 'latest_transfers_to.to');
            })->select('latest_transfers_to.*', 'users.name as from_name');
        $transfers = $toAccountWithName->union($fromAccountWithName)->orderBy('time', 'desc')->paginate(30);*/
        dd($tranfersWithNames->all());
        return view('pages.records', compact('tranfersWithNames')); 
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




