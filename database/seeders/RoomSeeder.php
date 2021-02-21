<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'room_name' => 'Single',
            'room_price_night' => '50',
            'room_short_description' => 'A room assigned to one person.',
            'room_description' => 'May have one or more beds.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        DB::table('rooms')->insert([
            'room_name' => 'Double',
            'room_price_night' => '50',
            'room_short_description' => 'A room assigned to two persons.',
            'room_description' => 'May have one or more beds.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        DB::table('rooms')->insert([
            'room_name' => 'Triple',
            'room_price_night' => '80',
            'room_short_description' => 'A room assigned to three persons.',
            'room_description' => 'May have two or more beds.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        
        DB::table('rooms')->insert([
            'room_name' => 'Quad',
            'room_price_night' => '100',
            'room_short_description' => 'A room assigned to four persons.',
            'room_description' => 'May have two or more beds.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        DB::table('rooms')->insert([
            'room_name' => 'Queen',
            'room_price_night' => '50',
            'room_short_description' => 'A room with a queen-sized bed.',
            'room_description' => 'May be occupied by one or more people.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        
        DB::table('rooms')->insert([
            'room_name' => 'King',
            'room_price_night' => '50',
            'room_short_description' => 'A room with a king-sized bed.',
            'room_description' => 'May be occupied by one or more people.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('rooms')->insert([
            'room_name' => 'Twin',
            'room_price_night' => '60',
            'room_short_description' => 'A room with a two beds.',
            'room_description' => 'May be occupied by one or more people.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        
        DB::table('rooms')->insert([
            'room_name' => 'Double-double',
            'room_price_night' => '110',
            'room_short_description' => 'A room with two double (or perhaps queen) beds.',
            'room_description' => 'May be occupied by one or more people.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

                
        DB::table('rooms')->insert([
            'room_name' => 'Studio',
            'room_price_night' => '40',
            'room_short_description' => ' A room with a studio bed – a couch that can be converted into a bed.',
            'room_description' => 'May also have an additional bed.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);




    }
}
