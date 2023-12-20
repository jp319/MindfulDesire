<?php

namespace App\Livewire\Forms\user;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;

class NewCategoryForm extends Form
{
    public string $name = '';
    public string $color = '#6590D5';
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255|unique:categories,name',
            'color' => 'required|string|min:3|max:255',
        ];
    }
    public function create(): bool
    {
        $this->validate();
        $created = Category::create([
            'name' => $this->name,
            'slug' => \Str::slug($this->name),
            'color' => $this->color,
        ])->save();
        $this->reset();
        return $created;
    }
}
