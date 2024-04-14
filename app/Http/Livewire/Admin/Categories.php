<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{
    public $category_id;
    public $name;

    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.admin.categories');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $this->name,
        ]);

        $this->reload();
        $this->resetFormFields();
    }

    public function edit($id)
    {
        $categories = Category::find($id);
        $this->category_id = $categories->id;
        $this->name = $categories->name;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $categories = Category::find($this->category_id);
        $categories->update([
            'name' => $this->name,
        ]);

        $this->reload();
        $this->resetFormFields();
    }

    public function delete($id)
    {
        $categories = Category::find($id);
        $categories->delete();

        $this->reload();
        $this->resetFormFields();
    }

    public function reload()
    {
        $this->categories = Category::all();
    }

    public function resetFormFields()
    {
        $this->category_id = '';
        $this->name = '';
    }
}
