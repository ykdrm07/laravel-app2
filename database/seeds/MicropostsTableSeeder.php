<?php

use Illuminate\Database\Seeder;
use App\Micropost; # 追加

class MicropostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $microposts = [
          [
            'user_id'   => 1,
            'content'   => 'これはテスト投稿1',
          ],
          [
            'user_id'   => 1,
            'content'   => 'これはテスト投稿2',
          ],
          [
            'user_id'   => 2,
            'content'   => 'これはテスト投稿3',
          ],
        ];
 
        foreach ($microposts as $micropost) {
          Micropost::create($micropost);
        }
    }
 }