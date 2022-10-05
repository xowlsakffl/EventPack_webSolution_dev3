<?php

use App\LayoutBottom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayoutBottomSeeder extends Seeder
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
                <footer id="footer">
                    <div class="footer-box">
                        <div className="footer__title">Try Everything</div>
                        <div className="footer__add">3F, DONGJU Building 183, Bangbae-ro, Seocho-gu, Seoul, 06572, Republic of Korea</div>
                        <div className="footer__tel">Tel. +82-2-6288-6300 Fax. +82-2-6288-6399</div>
                    </div>
                </footer>
            '],
            'css' => [
            '
            #footer {
                width: 100%;
                height: 100px;
            }
            /* 박스설정 */
            #footer> .footer-box {
                width: inherit;
                height: inherit;
                background-color: #354052;
                color: #676F7C;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            /* 텍스트 설정 */
            #footer> .footer-box> .footer__title {
                font-size: 20px;
                font-weight: 600;
                margin: 0 0 5px 0;
                color: #676F7C;
            }
            #footer> .footer-box> .footer__add,
            #footer> .footer-box> .footer__tel  {
                font-weight: 500;
                font-size: 12px;
                margin: 2px 0 0 0;
                text-align: center;
                color: #676F7C;
            }
            /* 반응형 */
            @media screen and (max-width : 767px) {
                #footer> .footer-box> .footer__add,
            #footer> .footer-box> .footer__tel  {
                font-weight: normal;
                font-size: 10px;
                margin: 2px 0 0 0;
            }
            }
            ']
        ];

        for ($i = 0;$i < count($datas['html']);$i++) {
            DB::table("layout_bottoms")->insert([
                'category' => 0,
                'name_ko' => '하단레이아웃_'.$i,
                'name_en' => 'Bottom_'.$i,
                'code' => $faker->randomNumber,
                'html' => $datas['html'][$i],
                'css' => $datas['css'][$i],
                'state' => $faker->randomElement([LayoutBottom::NORMAL, LayoutBottom::UNPRINT, LayoutBottom::STOP, LayoutBottom::DELETE])
            ]);
        }
    }
}
