<?php

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
        DB::table('categories')->insert([
        	'kateqoriya_ad'=>'kateqoriya 1',
	        'slug'=>'kateqoriya-1',
	        'created_at'=>\Carbon\Carbon::now(),
	        'updated_at'=>\Carbon\Carbon::now()
        ]);
	    DB::table('categories')->insert([
		    'kateqoriya_ad'=>'kateqoriya 2',
		    'slug'=>'kateqoriya-2',
		    'created_at'=>\Carbon\Carbon::now(),
		    'updated_at'=>\Carbon\Carbon::now()
	    ]);
    }
}
