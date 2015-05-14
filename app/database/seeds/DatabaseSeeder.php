<?php

class DatabaseSeeder extends Seeder {

 public function run()
 {
   Eloquent::unguard();

   $this->call('UserTableSeeder');
 }

}
class UserTableSeeder extends Seeder
{

   public function run(){

          User::create(array(

            'username' => 'admin',
            'email' => 'noni.wiluyo@gmail.com',
            'name' => 'Noni Wiluyo',
            'password' => Hash::make('admin'),

          ));

   }

}
?>