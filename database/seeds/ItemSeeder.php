<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = new Item;
        $item->name = "Mencoba";
        $item->description = "Deskripsi Mencoba";
        $item->cover = "NO Image";
        $item->price = 9000;
        $item->stock = 1;
        $item->status = "SHOW";
        $item->created_by = 1;
        $item->save();

        $item->categories()->attach([1, 2]);

        $this->command->info("Item berhasil di insert");
    }
}
