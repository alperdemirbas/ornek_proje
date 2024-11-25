<?php

namespace Rezyon\Supplier\Database\Seeds;

use Illuminate\Database\Seeder;
use Rezyon\Supplier\Models\ActivityCategoryType;

class ActivityCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ["name" => ["tr" => "Şehir Turları", "en" => "City Tours"], "icon" => "fas fa-city"],
            ["name" => ["tr" => "Doğa ve Macera", "en" => "Nature and Adventure"], "icon" => "fas fa-tree"],
            ["name" => ["tr" => "Deniz ve Plaj Tatilleri", "en" => "Sea and Beach Holidays"], "icon" => "fas fa-umbrella-beach"],
            ["name" => ["tr" => "Kültür ve Festival Turları", "en" => "Culture and Festival Tours"], "icon" => "fas fa-theater-masks"],
            ["name" => ["tr" => "Tarih ve Arkeoloji", "en" => "History and Archaeology"], "icon" => "fas fa-archway"],
            ["name" => ["tr" => "Lüks ve Spa Tatilleri", "en" => "Luxury and Spa Holidays"], "icon" => "fas fa-spa"],
            ["name" => ["tr" => "Yerel Lezzetler", "en" => "Local Delicacies"], "icon" => "fas fa-utensils"],
            ["name" => ["tr" => "Aktivite ve Eğlence Parkları", "en" => "Activity and Amusement Parks"], "icon" => "fas fa-roller-coaster"],
            ["name" => ["tr" => "Dil ve Kültür Programları", "en" => "Language and Culture Programs"], "icon" => "fas fa-language"],
            ["name" => ["tr" => "Gece Hayatı", "en" => "Nightlife"], "icon" => "fas fa-cocktail"],
        ];

        foreach ($categories as $category) {
            ActivityCategoryType::query()->updateOrCreate(["icon" => $category['icon']], $category);
        }
    }
}
