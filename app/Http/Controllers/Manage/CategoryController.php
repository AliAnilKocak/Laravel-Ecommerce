<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        if (request()->filled('search_word') || request()->filled('parent_id')) {
            request()->flash(); // eski form verisi sayfa yenilendiğinde kalması için requestteki bilgileri sessiona flashladık.
            $search_word = request('search_word');
            $parent_id = request('parent_id');
            $list = Category::with('parent_category')
                ->where('name', 'like', "%$search_word%")
                ->Where('parent_id',  $parent_id)
                ->orderByDesc('created_at')
                ->paginate(8)
                ->appends(['search_word'=>$search_word,'parent_id'=>$parent_id]);

        } else {
            request()->flush(); // eski form verisi sayfa yenilendiğinde silinmesi için requestteki bilgileri sessiondan kaldırdık.

            $list = Category::with('parent_category')
                ->orderByDesc('created_at')
                ->paginate(8);
        }

        $categories = Category::whereRaw('parent_id is null')->get();

        return view('manage.category.index', compact('list', 'categories'));
    }

    public function form($id = 0)
    {
        $entry = new Category;
        if ($id > 0) {
            $entry = Category::find($id);
        }
        $categories = Category::all();
        return view('manage.category.form', compact('entry', 'categories'));
    }

    public function save($id = 0)
    {
        $data = request()->only('name', 'slug', 'parent_id');
        if (!request()->filled('slug')) {
            $data['slug'] = str_slug(request('name'));
            request()->merge(['slug' => $data['slug']]);
        }


        $this->validate(request(), [
            'name' => 'required',
            'slug' => request('original_slug') != request('slug') ?  'unique:category,slug' : '',
        ]);


        /*if(Category::whereSlug($data['slug'])->count() > 0)
        return back()->withInput()->withErrors(['slug'=>'Slug değer daha önceden kayıtlıdır']);*/

        if ($id > 0) { //update
            $entry = Category::where('id', $id)->firstOrFail();
            $entry->update($data);
        } else { //create
            $entry = Category::create($data);
        }
        return  redirect()->route('manage.category.edit', $entry->id)
            ->with('message', ($id > 0 ? "Güncellendi" : "Yeni bir kayıt oluşturuldu"))
            ->with('message_type', 'success');
    }

    public function delete($id)
    {


        $category = Category::find($id);
        $category->products()->detach(); //kategoriye ait ürünleri siler
        $category->delete();

        return redirect()->route('manage.category')
            ->with('message_type', 'success')
            ->with('message', 'Kategori silinmiştir.');
    }
}
