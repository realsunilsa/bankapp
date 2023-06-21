<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $amount;
    public $balance;

    public function mount()
    {
        $deposite = Transaction::where('user_id', Auth::user()->id)->where('ttype', '0')->sum('amount');
        $withdraw = Transaction::where('user_id', Auth::user()->id)->where('ttype', '1')->sum('amount');

        $this->balance = $deposite - $withdraw;
    }

    public function resetForm()
    {
        $this->amount = null;
        $this->resetErrorBag();
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'amount'  => 'required|string'
        ]);
    }

    public function deposite()
    {
        $this->validate([
            'amount'  => 'required|string'
        ]);

        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->ttype = '0';
        $transaction->amount = $this->amount;
        $transaction->save();
        session()->flash('message', 'Deposite was successfull! 😃');
        $this->resetForm();
        $this->emit('depositeAdded');
    }

    public function withdraw()
    {
        $this->validate([
            'amount'  => 'required|string'
        ]);

        if ($this->amount > $this->balance) {
            $this->addError('amount', 'Insufficient Funds');
            return;
        }

        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->ttype = '1';
        $transaction->amount = $this->amount;
        $transaction->save();
        session()->flash('message', 'Withdraw was successfull! 😃');
        $this->resetForm();
        $this->emit('withdrawAdded');
    }

    public function render()
    {
        $transactions = Transaction::with('user')->orderBy('id', 'DESC')->paginate(2);

        return view('livewire.customer-dashboard-component', compact('transactions'));
    }
}
