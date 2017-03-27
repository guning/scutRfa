<?php
use Illuminate\Database\Seeder;

class Admin extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Admin::class, 1)->create(array(
            'username' => 'MiniFrog',
            'password' => hash('sha256', 'al3682733')
        ));
        factory(App\Admin::class, 1)->create(array(
            'username' => 'Matafela',
            'password' => hash('sha256', '199611@#')
        ));
        factory(App\Admin::class, 1)->create(array(
            'username' => 'weimian',
            'password' => hash('sha256', '1997.8.26abcd'),
        ));
    }
}
