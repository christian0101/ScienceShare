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
        // make view objects
        factory(App\View::class, 60)->make()->each(function ($view) {
            // add only unique views
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
