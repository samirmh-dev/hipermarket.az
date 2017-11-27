<?php

use Illuminate\Database\Seeder;

class MultiCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('multi_categories')->insert([
        	'kateqoriya_ad'=>'multi kateqoriya 1',
	        'slug'=>'multi-kateqoriya-1',
	        'fk_category_id'=>1,
	        'created_at'=>\Carbon\Carbon::now(),
	        'updated_at'=>\Carbon\Carbon::now()
        ]);

	    DB::table('multi_categories')->insert([
		    'kateqoriya_ad'=>'multi kateqoriya 2',
		    'slug'=>'multi-kateqoriya-2',
		    'fk_category_id'=>1,
		    'created_at'=>\Carbon\Carbon::now(),
		    'updated_at'=>\Carbon\Carbon::now()
	    ]);
    }
}
