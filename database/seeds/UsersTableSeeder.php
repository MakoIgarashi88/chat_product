<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new User;
        $model->name = 'guest';
        $model->nickname = 'ゲスト';
        $model->detail = '初心者です';
        $model->email = '';
        $model->image_id = 1;
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'tanjiro';
        $model->nickname = '竈門炭治郎';
        $model->detail = '15歳/鬼殺隊所属/妹がいます';
        $model->image_id = 2;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'yuji';
        $model->nickname = '虎杖悠仁';
        $model->detail = '呪術高専東京校一年';
        $model->image_id = 3;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'deku';
        $model->nickname = '緑谷出久';
        $model->detail = '雄英高校ヒーロー科1年A組18番';
        $model->image_id = 4;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'allmight';
        $model->nickname = 'オールマイト';
        $model->detail = '元NO.1ヒーロー/現雄英高校教師';
        $model->image_id = 5;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'shinobu';
        $model->nickname = '胡蝶しのぶ';
        $model->detail = '蟲柱';
        $model->image_id = 6;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'katsuki';
        $model->nickname = '爆豪勝己';
        $model->detail = '雄英高校ヒーロー科1年A組17番';
        $model->image_id = 7;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'toru';
        $model->nickname = '及川徹';
        $model->detail = '青葉城西高校3年6組/セッター(S)';
        $model->image_id = 8;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'kenma';
        $model->nickname = '孤爪研磨';
        $model->detail = '音駒高校2年3組/セッター(S)';
        $model->image_id = 9;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();
    }
}
