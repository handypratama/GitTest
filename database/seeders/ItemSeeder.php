<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\Storage;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'name'=>'Futon',
            'price'=>400000,
            'type'=>'Bed',
            'color'=>'Blue Navy',
            'image'=>'images/Karpet.png'
        ]);

        Item::create([
            'name'=>'Sofa Minimalist',
            'price'=>17000000,
            'type'=>'Sofa',
            'color'=>'Black',
            'image'=>'images/Kursi_1.png'
        ]);

        Item::create([
            'name'=>'Teodores',
            'price'=>395000,
            'type'=>'Chair',
            'color'=>'White',
            'image'=>'images/Kursi_2.png'
        ]);
        Item::create([
            'name'=>'Mammut',
            'price'=>250000,
            'type'=>'Chair',
            'color'=>'White',
            'image'=>'images/Kursi_3.png'
        ]);
        Item::create([
            'name'=>'Antilop',
            'price'=>159000,
            'type'=>'Chair',
            'color'=>'White',
            'image'=>'images/Kursi_bayi.png'
        ]);
        Item::create([
            'name'=>'Vangsta',
            'price'=>1499000,
            'type'=>'Table',
            'color'=>'White',
            'image'=>'images/Meja_1.png'
        ]);
        Item::create([
            'name'=>'Ekedalen',
            'price'=>2999000,
            'type'=>'Table',
            'color'=>'Black',
            'image'=>'images/Meja_Hitam_1.png'
        ]);
        Item::create([
            'name'=>'Sandberg',
            'price'=>499000,
            'type'=>'Table',
            'color'=>'Black',
            'image'=>'images/Meja_Hitam_2.png'
        ]);
        Item::create([
            'name'=>'Nesttun',
            'price'=>2599000,
            'type'=>'Bed',
            'color'=>'White',
            'image'=>'images/Ranjang_Putih_1.png'
        ]);
        Item::create([
            'name'=>'Grimsbu',
            'price'=>1499000,
            'type'=>'Bed',
            'color'=>'White',
            'image'=>'images/Ranjang_Putih_2.png'
        ]);
        Item::create([
            'name'=>'Vuku',
            'price'=>299000,
            'type'=>'Wardrobe',
            'color'=>'White',
            'image'=>'images/Wardrobe.png'
        ]);
    }
}