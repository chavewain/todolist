<?php

use App\Category;
use App\Task;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Eliminamos la data

        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // desactivamos la verificacion de los Foreign Keys

        User::truncate();
        Category::truncate();
        Task::truncate();
        DB::table('category_task')->truncate();

        User::flushEventListeners();
        Category::flushEventListeners();
        Task::flushEventListeners();


        // Catidad de entradas a crear

        $usersQuantity = 1000;
        $CategoriesQuantity = 30;
        $TasksQuantity = 1000;


        // Ejecutamos los Factories

        factory(User::class, $usersQuantity)->create();
        factory(Category::class, $CategoriesQuantity)->create();


		factory(Task::class, $TasksQuantity)->create()->each(function ($task) {

			   	$categories = Category::all()->random(mt_rand(1, 5))->pluck('id');

			    foreach ($categories as $category) 
			    {
				    DB::table('category_task')->insert([
			            'category_id' => $category,
			            'task_id' => $task->id
			        ]);
			     }
		
			}
		); 





    }
}
