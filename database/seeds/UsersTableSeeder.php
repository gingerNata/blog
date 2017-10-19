<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
         array( [
              'avatar' => 'default.png',
              'name' => 'Guest',
              'email' => 'Guest@mail.com',
              'password' => '$2y$10$JjrQHFQDHSwWtDhvJYTWIeFpPEX.JcW2UdcwiGXOBA.IP9rtRfqgC',
          ],
          [
              'avatar' => 'default.png',
              'name' => 'Admin',
              'email' => 'admin@mail.com',
              'password' => '$2y$10$JjrQHFQDHSwWtDhvJYTWIeFpPEX.JcW2UdcwiGXOBA.IP9rtRfqgC',
          ],
         )
        );
    }
}
