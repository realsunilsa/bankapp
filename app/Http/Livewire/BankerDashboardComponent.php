<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class BankerDashboardComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $transactions = [];

    public function resetForm()
    {
        $this->transactions = [];
    }

    public function view($id)
    {
        $user = User::findOrFail($id);
        $this->transactions = $user->transactions()->orderByDesc('created_at')->get();
    }

    public function render()
    {
        $users = User::where('utype', '1')->orderBy('id', 'DESC')->paginate(2);

        return view('livewire.banker-dashboard-component', compact('users'));
    }
}
