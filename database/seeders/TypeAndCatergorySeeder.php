<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeAndCatergorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::create([
            'key' => 'sell',
            'name_ar' => 'بيع',
            'name_en' => 'Sell',
        ]);
        Type::create([
            'key' => 'Rent',
            'name_ar' => 'إيجار',
            'name_en' => 'Rent',
        ]);
        Type::create([
            'key' => 'investment_opportunity',
            'name_ar' => 'فرصة استثمارية',
            'name_en' => 'Investment opportunity',
        ]);
        $categories = [
            'palace' => 'قصر',
            'resort' => 'منتجع',
            'building' => 'مبنى',
            'villa' => 'فيلا',
            'duplex' => 'دوبلكس',
            'apartment' => 'شقة',
            'retreat' => 'ملاذ',
            'chalet' => 'شاليه',
            'farm' => 'مزرعة',
            'yard' => 'ساحة',
            'Office' => 'مكتب',
            'Shop' => 'متجر',
            'Showroom' => 'معرض',
            'Floor' => 'طابق',
            'Studio' => 'استوديو',
            'Compound' => 'مجمع',
            'Warehouse' => 'مستودع',
            'Station' => 'محطة',
            'land' => 'أرض',
            'auction' => 'مزاد',
            'tower' => 'برج',
            'development_project' => 'مشروع تطوير',
            'partnership' => 'شراكة',
            'other' => 'أخرى',
        ];
        $categories_two = [];

        foreach ($categories as $key => $name_ar) {
            Category::create([
                'key' => $key,
                'name_ar' => $name_ar,
                'name_en' => $key,
            ]);
        }
    }
}
