<?php

use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->insert([
            ['site_id' => 1,
            'center_id' => 1,],
            ['site_id' => 2,
             'center_id' => 2,],
            ['site_id' => 3,
                'center_id' => 3,]
        ]);
    }
}
