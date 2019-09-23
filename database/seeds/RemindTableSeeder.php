<?php

use Illuminate\Database\Seeder;

class RemindTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reminds = [
            [
                'title' => 'Remind 1',
                'user_id' => 1,
                'vocabs' => '[0,2,3,4]',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Remind 2',
                'user_id' => 2,
                'vocabs' => '[1,2,3,4]',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Remind 3',
                'user_id' => 3,
                'vocabs' => '[1,2,3,4]',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach($reminds as $rm) {
            DB::table('reminds')->insert($rm);
        }

    }
}
