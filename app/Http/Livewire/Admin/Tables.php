<?php

namespace App\Http\Livewire\Admin;

use App\Models\Table;
use Livewire\Component;

class Tables extends Component
{
    public $table_id;
    public $name;
    public $location;
    public $state;

    public $tables;

    public function mount()
    {
        $this->state = 'ACTIVO';
        $this->tables = Table::all();
    }

    public function render()
    {
        return view('livewire.admin.tables');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required',
            'location' => 'required'
        ]);

        Table::create([
            'name' => $this->name,
            'location' => $this->location,
            'state' => $this->state
        ]);

        $this->reload();
        $this->resetFormFields();
    }

    public function edit($id)
    {
        $tables = Table::find($id);
        $this->table_id = $tables->id;
        $this->location = $tables->location;
        $this->name = $tables->name;
        $this->state = $tables->state;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'location' => 'required'
        ]);

        $tables = Table::find($this->table_id);
        $tables->update([
            'name' => $this->name,
            'location' => $this->location,
            'state' => $this->state
        ]);

        $this->reload();
        $this->resetFormFields();
    }

    public function delete($id)
    {
        $tables = Table::find($id);
        $tables->delete();

        $this->reload();
        $this->resetFormFields();
    }

    public function reload()
    {
        $this->tables = Table::all();
    }

    public function resetFormFields()
    {
        $this->table_id = '';
        $this->name = '';
        $this->location = '';
    }
}
