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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
