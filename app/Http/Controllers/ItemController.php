<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numberCategory = numberPagination(5);
        $numberItem = numberPagination(5);

        $data['category'] = Category::all();
        $data['item'] = Item::with('categories')->get();

        return view('admin.item.index', compact('data', 'numberCategory', 'numberItem'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $item->created_by = \Auth::user()->id;
        $item = new Item;

        $item->name = $request->get('name');
        $item->description = $request->get('description');
        $item->price = $request->get('price');
        $item->stock = $request->get('stock');
        $item->status = $request->get('status');
        $item->created_by = 1;

        $cover = $request->file('cover');

        if ($cover) {
            $cover_path = saveOriginalPhoto($cover, $request->get('name'), 'item-covers');
            $item->cover = $cover_path;

        } else {
            $item->cover = "";
        }

        $item->save();

        $item->categories()->attach($request->get('categories'));

        return redirect()
            ->route('item.index')
            ->with('status', 'Item successfully add');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->get('item_id');
        $name = $request->get('name');
        $description = $request->get('description');
        $price = $request->get('price');
        $status = $request->get('status');
        $categories = $request->get('categories');
        
        $cover = $request->file('cover');

        $item = Item::findOrFail($id);

        $item->name = $name;
        $item->description = $description;
        $item->price = $price;
        $item->status = $status;
        
        if ($cover) {
            if($item->cover && file_exists(storage_path('app/public/' . $item->cover))) {
                Storage::delete('public/' . $item->cover);
            }

            $file = saveOriginalPhoto($cover, $name, 'item-covers');

            $item->cover = $file;
        }
        
        $item->save();

        $item->categories()->sync($categories);

        return redirect()
            ->route('item.index')
            ->with('status', 'Item successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        if ($item->cover != "")
        {
            Storage::delete('public/' . $item->cover);
        }

        $item->categories()->detach();
        $item->delete();

        return redirect()
            ->route('item.index')
            ->with('status', 'Item successfully updated');
    }

    // Update stok item
    public function updateStock(Request $request)
    {
        $id = $request->get('item_id');
        $stock = $request->get('data_stock');

        $item = Item::findOrFail($id);

        $item->stock = $stock;

        $item->save();

        return back()
            ->with('status','Stock succesfully updated');
    }

    // Membuat Kategori Item
    public function storeCategory(Request $request)
    {
        $category = new Category;

        $category->name = $request->get('name');
        $category->save();

        return redirect()
            ->route('item.index')
            ->with('status', 'Category successfully add');
    }

    // Mengedit kategori item
    public function updateCategory(Request $request)
    {
        $id = $request->get('category_id');
        $name = $request->get('name');

        $category = Category::findOrFail($id);

        $category->name = $name;
        $category->save();

        return back()
            ->with('status','Category succesfully updated');
    }

    // Menghapus category
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->items()->detach();
        $category->delete();

        return redirect()
            ->route('item.index')
            ->with('status', 'Category succesfully deleted');
    }

    // Pencarian data dengan ajax
    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');

        $categories = Category::where("name", "LIKE", "%$keyword%")->get();

        return $categories;
    }
}
