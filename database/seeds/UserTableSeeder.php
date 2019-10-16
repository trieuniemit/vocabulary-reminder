<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $users = [
            [
                'email' => 'trieuniemit@gmail.com',
                'username' => 'trieuniemit',
                'fullname' => 'Triệu Tài Niêm',
                'avartar' => 'https://www.travelcontinuously.com/wp-content/uploads/2018/04/empty-avatar.png',
                'gender' => 0,
                'password' => bcrypt('12345'),
                'role' => 1,
                'birthday' => '1998-02-08',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'email' => 'phamhoangdung198@gmail.com',
                'username' => 'phamhoangdung',
                'fullname' => 'Phạm Hoàng Dũng',
                'avartar' => 'https://www.travelcontinuously.com/wp-content/uploads/2018/04/empty-avatar.png',
                'gender' => 0,
                'password' => bcrypt('12345'),
                'role' => 1,
                'birthday' => '1998-02-08',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'email' => 'hoangthuc@gmail.com',
                'username' => 'hoangthuc',
                'fullname' => 'Hoàng Văn Thực',
                'avartar' => 'https://www.travelcontinuously.com/wp-content/uploads/2018/04/empty-avatar.png',
                'gender' => 0,
                'password' => bcrypt('12345'),
                'role' => 1,
                'birthday' => '1998-02-08',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
