<?php

use App\LayoutTop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayoutTopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $datas = [
            'html' => [
                '
                <header id="header">
                    <div class="header-box">
                        <div class="header__menu">
                            
                        </div>
                        <div class="header__items">
                            <div class="item">로그인</div>
                            <div class="item">가입</div>
                            <div class="item">English</div>
                        </div>
                    </div>
                </header>
        '],
            'css' => [
        '
            #header {
                width: 100%;
                height: 40px;
            }
            /* 박스설정 */
            #header> .header-box {
                width: inherit;
                height: inherit;
                background-color: #16AAD8;
                background-color: var(--background-color);
                color: #ffffff;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            /* 메뉴버튼 */
            #header> .header-box> .header__menu {
                width: 40px;
                height: 40px;
                background-color: rgba(0, 0, 0, 0.1);
                display: flex;
                justify-content: center;
                align-items: center;
            }
            /* 아이템 박스 */
            #header> .header-box> .header__items {
                display: flex;
            }
            #header> .header-box> .header__items> .item {
                margin-right: 25px;
                font-size: 13px;
                color: white;
            }
        ']
        ];

        for ($i = 0;$i < count($datas['html']);$i++) {
            DB::table("layout_tops")->insert([
                'category' => 0,
                'name_ko' => '상단레이아웃_'.$i,
                'name_en' => 'Top_'.$i,
                'code' => $faker->randomNumber,
                'html' => $datas['html'][$i],
                'css' => $datas['css'][$i],
                'state' => $faker->randomElement([LayoutTop::NORMAL, LayoutTop::UNPRINT, LayoutTop::STOP, LayoutTop::DELETE])
            ]);
        }
    }
}
