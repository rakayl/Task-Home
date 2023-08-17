<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WalletsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('wallets')->delete();
        
        \DB::table('wallets')->insert(array (
            0 => 
            array (
                'id' => 1,
                'full_name' => 'Raka Yulian',
                'order_id' => '1',
                'amount' => 1000.0,
                'timestamp' => '2023-08-17 17:41:07',
                'created_at' => '2023-08-17 17:41:08',
                'updated_at' => '2023-08-17 17:41:08',
            ),
            1 => 
            array (
                'id' => 2,
                'full_name' => 'Raka Yulian ',
                'order_id' => '2',
                'amount' => 150000.0,
                'timestamp' => '2023-08-17 17:52:01',
                'created_at' => '2023-08-17 17:52:01',
                'updated_at' => '2023-08-17 17:52:01',
            ),
            2 => 
            array (
                'id' => 3,
                'full_name' => 'Yulian Raka',
                'order_id' => '3',
                'amount' => 150000.0,
                'timestamp' => '2023-08-17 17:52:20',
                'created_at' => '2023-08-17 17:52:20',
                'updated_at' => '2023-08-17 17:52:20',
            ),
            3 => 
            array (
                'id' => 4,
                'full_name' => 'Yulian Raka',
                'order_id' => '124124',
                'amount' => -1000.0,
                'timestamp' => '2023-08-17 17:52:42',
                'created_at' => '2023-08-17 17:52:43',
                'updated_at' => '2023-08-17 17:52:43',
            ),
        ));
        
        
    }
}