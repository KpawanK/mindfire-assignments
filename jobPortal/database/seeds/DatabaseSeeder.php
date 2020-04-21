<?php

use App\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory('App\User',20)->create();//create 20 users
        factory('App\Company',20)->create();//create 20 companies
        factory('App\Job',20)->create();//create 20 jobs

        $categories = [
            'Technology',
            'Engineering',
            'Government',
            'Medical',
            'Construction',
            'Software',
        ];
        foreach($categories as $category){
            Category::create(['name'=>$category]);
        }
    }
}
