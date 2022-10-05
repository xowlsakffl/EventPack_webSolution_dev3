<?php

use App\LayoutNavigation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayoutNavigationSeeder extends Seeder
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
                <nav id="navigation">
                    <div class="navigation-box">
                    <a href="/"><span class="navigation__logo">Try Everything</span></a>
                    <div class="navigation__list">
                        <span class="item">Overview</span>
                        <span class="item">Program</span>
                        <span class="item">Speakers</span>
                        <span class="item">Sponsorship</span>
                        <span class="item">General Infomation</span>
                        <input class="login-btn" type="button" value="Login">
                    </div>
                    </div>
                </nav>
            '],
            'css' => [
            '
            #navigation {
                width: 100%;
                height: 80px;
            }
            /* 박스설정 */
            #navigation> .navigation-box {
                width: inherit;
                height: inherit;
                padding: 0 25px;
                background-color: rgba(255, 255, 255, 0.1);
                border-bottom: 1px solid lightgray;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            /* 로고 */
            #navigation> .navigation-box> .navigation__logo {
                font-size: 20px;
                font-weight: bold;
            }
            /* 리스트 */
            #navigation> .navigation-box> .navigation__list> .item {
                font-size: 15px;
                margin-right: 20px;
                font-weight: 500;
            }
            /* 로그인버튼 */
            #navigation> .navigation-box> .navigation__list> .login-btn {
                background-color: #EA2461;
                color: white;
                padding: 5px 15px;
                border: none;
                border-radius: 20px;
            }
            ']
        ];

        for ($i = 0;$i < count($datas['html']);$i++) {
            DB::table("layout_navigations")->insert([
                'category' => 0,
                'name_ko' => '메뉴레이아웃_'.$i,
                'name_en' => 'Navigation_'.$i,
                'code' => $faker->randomNumber,
                'html' => $datas['html'][$i],
                'css' => $datas['css'][$i],
                'state' => $faker->randomElement([LayoutNavigation::NORMAL, LayoutNavigation::UNPRINT, LayoutNavigation::STOP, LayoutNavigation::DELETE])
            ]);
        }
    }
}
