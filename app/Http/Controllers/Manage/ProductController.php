<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetails;

class ProductController extends Controller
{
    public function index()
    {
        if (request()->filled('search_word')) {
            request()->flash(); // eski form verisi sayfa yenilendiğinde kalması için requestteki bilgileri sessiona flashladık.
            $search_word = request('search_word');
            $list = Product::where('name', 'like', "%$search_word%")
                ->orWhere('slug', 'like', "%$search_word%")->orderByDesc('created_at')->paginate(8);
        } else {
            $list = Product::orderByDesc('created_at')->paginate(8);
        }

        return view('manage.product.index', compact('list'));
    }

    public function form($id = 0)
    {
        $entry = new Product;
        $product_categories = [];
        if ($id > 0) {
            $entry = Product::find($id);
            $product_categories = $entry->categories()->pluck('category_id')->all();
        }
        $categories = Category::all();
        return view('manage.product.form', compact('entry', 'categories', 'product_categories'));
    }

    public function save($id = 0)
    {
        $data = request()->only('name', 'slug', 'description', 'price');
        if (!request()->filled('slug')) {
            $data['slug'] = str_slug(request('name'));
            request()->merge(['slug' => $data['slug']]);
        }
        $data_detail = request()->only('show_slider', 'show_day_opportunity', 'show_featured', 'show_bestselling', 'show_reduced');


        $this->validate(request(), [
            'name' => 'required',
            'slug' => request('original_slug') != request('slug') ?  'unique:product,slug' : '',
        ]);


        /*if(Category::whereSlug($data['slug'])->count() > 0)
        return back()->withInput()->withErrors(['slug'=>'Slug değer daha önceden kayıtlıdır']);*/

        $categories = request('categories');
        //dd($categories);

        if ($id > 0) { //update
            $entry = Product::where('id', $id)->firstOrFail();
            $entry->update($data);
            $entry->detail()->update($data_detail);
            $entry->categories()->sync($categories); //select2 ile seçilen kategorileri güncellemeyi sağlar. Senkronize eder.
        } else { //create
            $entry = Product::create($data);
            $entry->detail()->create($data_detail);
            $entry->categories()->attach($categories); //select2 ile seçilen kategorileri eklemeyi sağlar.
        }

        if (request()->hasFile('product_image')) {
            $this->validate(request(), [
                'product_image' => 'image|mimes:jpg,png,jpeg|max:4096'
            ]);
            $product_image = request()->file('product_image'); //veya  request()->product_image; $product_image değişleni ile birlikte artık bu resim hakkında çeşitli bilgileri alabileceğim
            $product_image_file_name = $entry->id . "-" . time() . "." . $product_image->extension();

            if ($product_image->isValid()) {
                $product_image->move('uploads/products', $product_image_file_name);
                ProductDetails::updateOrCreate(
                    ['product_id' => $entry->id],
                    ['image_url' => $product_image_file_name]
                );
            }
        }


        return  redirect()->route('manage.product.edit', $entry->id)
            ->with('message', ($id > 0 ? "Güncellendi" : "Yeni bir kayıt oluşturuldu"))
            ->with('message_type', 'success');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->categories()->detach();
        //$product->detail()->delete(); //softdelete kullandığımız için gerek yok
        $product->delete();

        return redirect()->route('manage.product')
            ->with('message_type', 'success')
            ->with('message', 'Kullanıcı silinmiştir.');
    }
}
