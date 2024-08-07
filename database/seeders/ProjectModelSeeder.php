<?php

namespace Database\Seeders;

use App\Models\ProjectModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        ProjectModel::create([
            'parent_id' => '3',
            'route_key' => 'users',
            'title_ar' => 'المستخدمين',
            'title_en' => 'Users',
            "is_menu" => '1',
            "icon" =>  'fas fa-users',
            "order_by" => '1'
        ]);
        ProjectModel::create([
            'parent_id' => '3',
            'route_key' => 'settings',
            'title_ar' => 'الإعدادات',
            'title_en' => 'Settings',
            "is_menu" => '1',
            "icon" =>  'fas fa-cogs',
            "order_by" => '3'
        ]);
        ProjectModel::create([
            'parent_id' => '0',
            'title_ar' => 'النظام',
            'title_en' => 'System',
            "is_menu" => '1',
            "icon" =>  'fas fa-users-cog',
            "order_by" => '1'
        ]);

        ProjectModel::create([
            'parent_id' => '0',
            'title_ar' => 'الصفحات',
            'title_en' => 'Pages',
            "is_menu" => '1',
            "icon" =>  'fas fa-users',
            "order_by" => '1'
        ]);

        ProjectModel::create([
            'parent_id' => '4',
            'title_ar' => 'صفحة عن اصولكم',
            'route_key' => 'about',
            'title_en' => 'About',

            "is_menu" => '1',
            "icon" =>  'fas fa-users',
            "order_by" => '1'
        ]);

        ProjectModel::create([
            'parent_id' => '4',
            'title_ar' => 'صفحة الاسئلة',
            'route_key' => 'faqs',
            'model' => 'Faq',
            'model_name' => 'App\Models\Faq',
            'title_en' => 'Faqs',
            "is_menu" => '1',
            "icon" =>  'fas fa-users',
            "order_by" => '1'
        ]);

        ProjectModel::create([
            'parent_id' => '0',
            'route_key' => 'reservations',
            'title_ar' => 'الحجوزات',
            'title_en' => 'Reservations',
            "is_menu" => '1',
            "icon" =>  'fa fa-briefcase',
            "order_by" => '1'
        ]);

        ProjectModel::create([
            'parent_id' => '0',
            'title_ar' => 'إنضم إلينا',
            'route_key' => 'join_us',
            'title_en' => 'Join Us',
            "is_menu" => '1',
            "icon" =>  'fas fa-users',
            "order_by" => '1'
        ]);
    }
}
