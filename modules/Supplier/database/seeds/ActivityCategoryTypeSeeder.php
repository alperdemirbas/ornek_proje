<?php

namespace Rezyon\Supplier\Database\Seeds;

use Illuminate\Database\Seeder;
use Rezyon\Supplier\Models\ActivityCategory;

class ActivityCategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            ["activity_category_type_id" => 1, "name" => ["tr" => "Tarihî Yerler", "en" => "Historical Sites"], "icon" => "fas fa-landmark"],
            ["activity_category_type_id" => 1, "name" => ["tr" => "Mimari Tur", "en" => "Architectural Tour"], "icon" => "fas fa-building"],
            ["activity_category_type_id" => 1, "name" => ["tr" => "Kültür ve Sanat Turu", "en" => "Culture and Art Tour"], "icon" => "fas fa-paint-brush"],
            ["activity_category_type_id" => 1, "name" => ["tr" => "Alışveriş Turu", "en" => "Shopping Tour"], "icon" => "fas fa-shopping-bag"],
            ["activity_category_type_id" => 1, "name" => ["tr" => "Lezzet Turu", "en" => "Taste Tour"], "icon" => "fas fa-utensils"],
            ["activity_category_type_id" => 2, "name" => ["tr" => "Dağcılık ve Trekking", "en" => "Mountaineering and Trekking"], "icon" => "fas fa-mountain"],
            ["activity_category_type_id" => 2, "name" => ["tr" => "Rafting ve Su Sporları", "en" => "Rafting and Water Sports"], "icon" => "fas fa-umbrella-beach"],
            ["activity_category_type_id" => 2, "name" => ["tr" => "Doğa Yürüyüşleri", "en" => "Nature Walks"], "icon" => "fas fa-hiking"],
            ["activity_category_type_id" => 2, "name" => ["tr" => "Safari Turları", "en" => "Safari Tours"], "icon" => "fas fa-binoculars"],
            ["activity_category_type_id" => 2, "name" => ["tr" => "Balon Turları", "en" => "Balloon Tours"], "icon" => "fas fa-hot-air-balloon"],

            ["activity_category_type_id" => 3, "name" => ["tr" => "Plaj Dinlenme", "en" => "Beach Relaxation"], "icon" => "fas fa-sun"],
            ["activity_category_type_id" => 3, "name" => ["tr" => "Dalış Turları", "en" => "Diving Tours"], "icon" => "fas fa-swimmer"],
            ["activity_category_type_id" => 3, "name" => ["tr" => "Yat Turu", "en" => "Boat Tours"], "icon" => "fas fa-ship"],
            ["activity_category_type_id" => 3, "name" => ["tr" => "Şnorkelle Dalış", "en" => "Snorkeling"], "icon" => "fas fa-snorkel-mask"],
            ["activity_category_type_id" => 3, "name" => ["tr" => "Deniz Kenarı Eğlenceleri", "en" => "Seaside Entertainment"], "icon" => "fas fa-beach-ball"],
            ["activity_category_type_id" => 4, "name" => ["tr" => "Yerel Festivaller", "en" => "Local Festivals"], "icon" => "fas fa-flag"],
            ["activity_category_type_id" => 4, "name" => ["tr" => "Etnik Gruplar ve Kültürler", "en" => "Ethnic Groups and Cultures"], "icon" => "fas fa-users"],
            ["activity_category_type_id" => 4, "name" => ["tr" => "Sanat ve Performans Gösterileri", "en" => "Art and Performance Shows"], "icon" => "fas fa-music"],
            ["activity_category_type_id" => 4, "name" => ["tr" => "Geleneksel El Sanatları", "en" => "Traditional Handicrafts"], "icon" => "fas fa-scroll"],

            ["activity_category_type_id" => 5, "name" => ["tr" => "Antik Kent Turları", "en" => "Ancient City Tours"], "icon" => "fas fa-archway"],
            ["activity_category_type_id" => 5, "name" => ["tr" => "Müze Ziyaretleri", "en" => "Museum Visits"], "icon" => "fas fa-university"],
            ["activity_category_type_id" => 5, "name" => ["tr" => "Arkeolojik Kazılar", "en" => "Archaeological Excavations"], "icon" => "fas fa-tools"],
            ["activity_category_type_id" => 5, "name" => ["tr" => "Tarihî Bölgeler", "en" => "Historical Areas"], "icon" => "fas fa-map-marker-alt"],
            ["activity_category_type_id" => 6, "name" => ["tr" => "Lüks Oteller ve Konaklamalar", "en" => "Luxury Hotels and Accommodations"], "icon" => "fas fa-hotel"],
            ["activity_category_type_id" => 6, "name" => ["tr" => "Spa ve Wellness", "en" => "Spa and Wellness"], "icon" => "fas fa-spa"],
            ["activity_category_type_id" => 6, "name" => ["tr" => "Gastronomi Turları", "en" => "Gastronomy Tours"], "icon" => "fas fa-wine-glass"],

            ["activity_category_type_id" => 7, "name" => ["tr" => "Gastronomi Turu", "en" => "Gastronomy Tour"], "icon" => "fas fa-utensils"],
            ["activity_category_type_id" => 7, "name" => ["tr" => "Yemek Pişirme Dersleri", "en" => "Cooking Classes"], "icon" => "fas fa-chef-hat"],
            ["activity_category_type_id" => 7, "name" => ["tr" => "Şarap Turları", "en" => "Wine Tours"], "icon" => "fas fa-wine-bottle"],
            ["activity_category_type_id" => 7, "name" => ["tr" => "Yerel Mutfak Deneyimleri", "en" => "Local Kitchen Experiences"], "icon" => "fas fa-cocktail"],
            ["activity_category_type_id" => 8, "name" => ["tr" => "Tema Parkları", "en" => "Theme Parks"], "icon" => "fas fa-funnel-dollar"],
            ["activity_category_type_id" => 8, "name" => ["tr" => "Su Parkları", "en" => "Water Parks"], "icon" => "fas fa-swimming-pool"],
            ["activity_category_type_id" => 8, "name" => ["tr" => "Eğlence Kompleksleri", "en" => "Entertainment Complexes"], "icon" => "fas fa-chess-knight"],
            ["activity_category_type_id" => 8, "name" => ["tr" => "Hayvanat Bahçeleri", "en" => "Zoos"], "icon" => "fas fa-paw"],

            ["activity_category_type_id" => 9, "name" => ["tr" => "Dil Kursları", "en" => "Language Courses"], "icon" => "fas fa-language"],
            ["activity_category_type_id" => 9, "name" => ["tr" => "Yerel Kültür Tanıtımları", "en" => "Local Culture Introductions"], "icon" => "fas fa-globe"],
            ["activity_category_type_id" => 9, "name" => ["tr" => "Yerel Halkla Etkileşim", "en" => "Interaction with Local People"], "icon" => "fas fa-handshake"],
            ["activity_category_type_id" => 9, "name" => ["tr" => "Yerel El Sanatları Atölyeleri", "en" => "Local Handicraft Workshops"], "icon" => "fas fa-paint-brush"],

            ["activity_category_type_id" => 10, "name" => ["tr" => "Bar ve Kulüp Turları", "en" => "Bar and Club Tours"], "icon" => "fas fa-cocktail"],
            ["activity_category_type_id" => 10, "name" => ["tr" => "Canlı Müzik Gösterileri", "en" => "Live Music Shows"], "icon" => "fas fa-music"],
            ["activity_category_type_id" => 10, "name" => ["tr" => "Gece Yürüyüşleri", "en" => "Night Walks"], "icon" => "fas fa-walking"],

        ];

        foreach ($subcategories as $subcategory) {
            ActivityCategory::query()->updateOrCreate([
                'icon' => $subcategory['icon'],
            ], $subcategory);
        }
    }
}
