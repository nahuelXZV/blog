<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;

    //resetea la pagina para buscar en cualquier lado 
    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name', 'like', '%'.$this->search.'%')
                ->orwhere('email', 'like', '%'.$this->search.'%')
                ->paginate();
        return view('livewire.admin.users-index',compact('users'));
    }
}
