<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['description' => 'Noticias',]);
        Category::create(['description' => 'Entrevistas',]);
        Category::create(['description' => 'Resúmenes',]);
        Category::create(['description' => 'Trailers',]);
        Category::create(['description' => 'Análisis de películas',]);
        Category::create(['description' => 'Perfiles de cineastas',]);
        Category::create(['description' => 'Listas y rankings',]);
        Category::create(['description' => 'Eventos de cine',]);
        Category::create(['description' => 'Detrás de cámaras',]);
        Category::create(['description' => 'Clásicos del cine',]);
        Category::create(['description' => 'Tecnología y efectos especiales',]);
        Category::create(['description' => 'Tendencias y temas',]);
        Category::create(['description' => 'Recomendaciones',]);
        Category::create(['description' => 'Adaptaciones',]);
    }
}
