<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Paper;

class ItemController extends Controller
{
    // Menampilkan data item barang, kategori dan tipe kertas
    public function index(Request $request)
    {
        $numberCategory = numberPagination(5);
        $numberItem = numberPagination(5);

        $keyword = $request->get('keyword') ? $request->get('keyword') : '';
        
        
        if ($keyword != '') {
            $data['item'] = Item::with('categories')
            ->where("name", "LIKE", "%$keyword%")
            ->paginate(5);
        } else {
            $data['item'] = Item::with('categories')->get();
        }
        
        $data['category'] = Category::all();

        return view('admin.item.index', compact('data', 'numberCategory', 'numberItem'));
    }

    /**
     * * BARANG/ITEM BARANG
     */

    // Menambahkan data item barang
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


    // Update data item barang
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

    
    // Hapus data item barang
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

    /**
     * * STOCK BARANG
     */

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

    /**
     * * KATEGORI
     */

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

    /**
     * * KERTAS
     */

    public function indexPaper(Request $request)
    {
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';
        $keywordType = $request->get('type');

        $numberPaper = numberPagination(3);
        
        if ($keywordType) {
            $data['paper'] = Paper::where("name", "LIKE", "%$keyword%")
            ->where("type", "$keywordType")
            ->paginate(3);

        } else {
            $data['paper'] = Paper::where("name", "LIKE", "%$keyword%")
                ->paginate(3);
        }

        return view('admin.item.paper.index', compact('data', 'numberPaper'));
    }

    // Menambah tipe kertas
    public function storePaper(Request $request)
    {
        $paper = new Paper;

        $paper->name = $request->get('name');
        $paper->price = $request->get('price');
        $paper->type = $request->get('type');
        
        $paper->save();

        return redirect()
            ->route('paper.index')
            ->with('status', 'Paper successfully add');
    }

    // Mengedit tipe kertas
    public function updatePaper(Request $request)
    {
        $id = $request->get('paper_id');

        $paper = Paper::findOrFail($id);
        $paper->name = $request->get('name');
        $paper->price = $request->get('price');
        $paper->type = $request->get('type');

        $paper->save();

        return redirect()
            ->route('paper.index')
            ->with('status', 'Paper successfully updated');

    }

    // Mengedit tipe kertas
    public function deletePaper($id)
    {
        $paper = Paper::findOrFail($id);

        $paper->delete();

        return redirect()
            ->route('paper.index')
            ->with('status', 'Paper successfully deleted');
    }


}
