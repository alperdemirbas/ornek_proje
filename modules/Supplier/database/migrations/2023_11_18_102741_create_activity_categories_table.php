<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Rezyon\Supplier\Models\ActivityCategoryType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ActivityCategoryType::class);
            $table->string('name');
            $table->string('icon');

        });
//        $this->seedCategories();
//        $this->seedSubcategories();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_categories');
    }



    private function seedCategories(): void
    {
        $categories = [
            ["name" => "Şehir Turları", "icon" => "fas fa-city"],
            ["name" => "Doğa ve Macera", "icon" => "fas fa-tree"],
            ["name" => "Deniz ve Plaj Tatilleri", "icon" => "fas fa-umbrella-beach"],
            ["name" => "Kültür ve Festival Turları", "icon" => "fas fa-theater-masks"],
            ["name" => "Tarih ve Arkeoloji", "icon" => "fas fa-archway"],
            ["name" => "Lüks ve Spa Tatilleri", "icon" => "fas fa-spa"],
            ["name" => "Yerel Lezzetler", "icon" => "fas fa-utensils"],
            ["name" => "Aktivite ve Eğlence Parkları", "icon" => "fas fa-roller-coaster"],
            ["name" => "Dil ve Kültür Programları", "icon" => "fas fa-language"],
            ["name" => "Gece Hayatı", "icon" => "fas fa-cocktail"],
        ];

        foreach ($categories as $category) {
            $insertData = [
                'name' => ['tr' => $category['name']], 'icon' => $category['icon'], 'slug' => ['tr' => Str::slug($category['name'])]
            ];
            //DB::table('activity_category_types')->insert($insertData);
        }

    }
    private function seedSubcategories()
    {
        $subcategories = [
            ["activity_category_type_id" => 1, "name" => "Tarihî Yerler", "icon" => "fas fa-landmark"],
            ["activity_category_type_id" => 1, "name" => "Mimari Tur", "icon" => "fas fa-building"],
            ["activity_category_type_id" => 1, "name" => "Kültür ve Sanat Turu", "icon" => "fas fa-paint-brush"],
            ["activity_category_type_id" => 1, "name" => "Alışveriş Turu", "icon" => "fas fa-shopping-bag"],
            ["activity_category_type_id" => 1, "name" => "Lezzet Turu", "icon" => "fas fa-utensils"],

            ["activity_category_type_id" => 2, "name" => "Dağcılık ve Trekking", "icon" => "fas fa-mountain"],
            ["activity_category_type_id" => 2, "name" => "Rafting ve Su Sporları", "icon" => "fas fa-umbrella-beach"],
            ["activity_category_type_id" => 2, "name" => "Doğa Yürüyüşleri", "icon" => "fas fa-hiking"],
            ["activity_category_type_id" => 2, "name" => "Safari Turları", "icon" => "fas fa-binoculars"],
            ["activity_category_type_id" => 2, "name" => "Balon Turları", "icon" => "fas fa-hot-air-balloon"],

            ["activity_category_type_id" => 3, "name" => "Plaj Dinlenme", "icon" => "fas fa-sun"],
            ["activity_category_type_id" => 3, "name" => "Dalış Turları", "icon" => "fas fa-swimmer"],
            ["activity_category_type_id" => 3, "name" => "Yat Turu", "icon" => "fas fa-ship"],
            ["activity_category_type_id" => 3, "name" => "Şnorkelle Dalış", "icon" => "fas fa-snorkel-mask"],
            ["activity_category_type_id" => 3, "name" => "Deniz Kenarı Eğlenceleri", "icon" => "fas fa-beach-ball"],

            ["activity_category_type_id" => 4, "name" => "Yerel Festivaller", "icon" => "fas fa-flag"],
            ["activity_category_type_id" => 4, "name" => "Etnik Gruplar ve Kültürler", "icon" => "fas fa-users"],
            ["activity_category_type_id" => 4, "name" => "Sanat ve Performans Gösterileri", "icon" => "fas fa-music"],
            ["activity_category_type_id" => 4, "name" => "Geleneksel El Sanatları", "icon" => "fas fa-scroll"],

            ["activity_category_type_id" => 5, "name" => "Antik Kent Turları", "icon" => "fas fa-archway"],
            ["activity_category_type_id" => 5, "name" => "Müze Ziyaretleri", "icon" => "fas fa-university"],
            ["activity_category_type_id" => 5, "name" => "Arkeolojik Kazılar", "icon" => "fas fa-tools"],
            ["activity_category_type_id" => 5, "name" => "Tarihî Bölgeler", "icon" => "fas fa-map-marker-alt"],

            ["activity_category_type_id" => 6, "name" => "Lüks Oteller ve Konaklamalar", "icon" => "fas fa-hotel"],
            ["activity_category_type_id" => 6, "name" => "Spa ve Wellness", "icon" => "fas fa-spa"],
            ["activity_category_type_id" => 6, "name" => "Gastronomi Turları", "icon" => "fas fa-wine-glass"],

            ["activity_category_type_id" => 7, "name" => "Gastronomi Turu", "icon" => "fas fa-utensils"],
            ["activity_category_type_id" => 7, "name" => "Yemek Pişirme Dersleri", "icon" => "fas fa-chef-hat"],
            ["activity_category_type_id" => 7, "name" => "Şarap Turları", "icon" => "fas fa-wine-bottle"],
            ["activity_category_type_id" => 7, "name" => "Yerel Mutfak Deneyimleri", "icon" => "fas fa-cocktail"],

            ["activity_category_type_id" => 8, "name" => "Tema Parkları", "icon" => "fas fa-funnel-dollar"],
            ["activity_category_type_id" => 8, "name" => "Su Parkları", "icon" => "fas fa-swimming-pool"],
            ["activity_category_type_id" => 8, "name" => "Eğlence Kompleksleri", "icon" => "fas fa-chess-knight"],
            ["activity_category_type_id" => 8, "name" => "Hayvanat Bahçeleri", "icon" => "fas fa-paw"],

            ["activity_category_type_id" => 9, "name" => "Dil Kursları", "icon" => "fas fa-language"],
            ["activity_category_type_id" => 9, "name" => "Yerel Kültür Tanıtımları", "icon" => "fas fa-globe"],
            ["activity_category_type_id" => 9, "name" => "Yerel Halkla Etkileşim", "icon" => "fas fa-handshake"],
            ["activity_category_type_id" => 9, "name" => "Yerel El Sanatları Atölyeleri", "icon" => "fas fa-paint-brush"],

            ["activity_category_type_id" => 10, "name" => "Bar ve Kulüp Turları", "icon" => "fas fa-cocktail"],
            ["activity_category_type_id" => 10, "name" => "Canlı Müzik Gösterileri", "icon" => "fas fa-music"],
            ["activity_category_type_id" => 10, "name" => "Gece Yürüyüşleri", "icon" => "fas fa-walking"],

        ];

        foreach ($subcategories as $subcategory) {
            $insertData = [
                'name' => ['tr' => $subcategory['name']], 'icon' => $subcategory['icon'], 'activity_category_type_id' => $subcategory['activity_category_type_id']
            ];
            //DB::table('activity_categories')->insert($insertData);
        }
    }
};
