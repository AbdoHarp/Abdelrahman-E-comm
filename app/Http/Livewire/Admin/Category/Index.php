<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\WithPagination;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $category_id;
    public function deleteCategory($cate_item_id)
    {
        $this->category_id = $cate_item_id;
    }
    public function destroyCategory()
    {
        $category = Category::find($this->category_id);
        $path = 'uploade/category/' . $category->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $category->delete();
        session()->flash('message', 'Category Deleted');
        $this->dispatchBrowserEvent('clase-model');
    }
    public function render()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.admin.category.index', ['categories' => $categories]);
    }
}
