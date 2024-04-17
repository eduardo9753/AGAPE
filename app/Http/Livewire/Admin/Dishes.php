<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Dish;
use App\Models\Type;
use Livewire\Component;

class Dishes extends Component
{
    public $dish_id;
    public $name;
    public $price;
    public $category_id;
    public $type_id;
    public $photo;
    public $description;

    public $categories;
    public $types;

    public $dishes;

    public function mount()
    {
        //incializando categorias
        $firstCategory = Category::first();
        $this->category_id = $firstCategory ? $firstCategory->id : null;

        //iniciando tipos
        $firstType = Type::first();
        $this->type_id = $firstType ? $firstType->id : null;

        $this->photo = 'https://cdn-icons-png.flaticon.com/512/5854/5854128.png';
        $this->dishes = Dish::all();
    }

    public function render()
    {
        $this->categories = Category::all();
        $this->types = Type::all();
        return view('livewire.admin.dishes');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required', 
            'type_id' => 'required',
            'photo' => 'required|url',
            'description' => 'required',
        ]);

        Dish::create([
            'name' => $this->name,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'type_id' => $this->type_id,
            'photo' => $this->photo,
            'description' => $this->description,
        ]);

        $this->reload();
        $this->resetFormFields();
    }

    public function edit($id)
    {
        $dishes = Dish::find($id);
        $this->dish_id = $dishes->id;
        $this->name = $dishes->name;
        $this->price = $dishes->price;
        $this->category_id = $dishes->category_id;
        $this->type_id = $dishes->type_id;
        $this->photo = $dishes->photo;
        $this->description = $dishes->description;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'photo' => 'required|url',
            'description' => 'required',
        ]);

        $dish = Dish::find($this->dish_id);
        $dish->update([
            'name' => $this->name,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'type_id' => $this->type_id,
            'photo' => $this->photo,
            'description' => $this->description,
        ]);

        $this->reload();
        $this->resetFormFields();
    }

    public function delete($id)
    {
        $dish = Dish::find($id);
        $dish->delete();

        $this->reload();
        $this->resetFormFields();
    }

    public function reload()
    {
        $this->dishes = Dish::all();
    }

    public function resetFormFields()
    {
        $this->dish_id = '';
        $this->name = '';
        $this->price = '';
        $this->description = '';
    }
}
