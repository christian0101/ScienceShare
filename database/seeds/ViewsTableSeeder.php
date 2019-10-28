<?php

use App\View;
use Illuminate\Database\Seeder;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\View::class, 60)->make()->each(function ($view) {
            View::firstOrCreate(
            [
              'identifier' => $view->identifier,
              'post_id' => $view->post_id
            ],
            [
              'identifier' => $view->identifier,
              'post_id' => $view->post_id
            ]);
        });
    }
}
