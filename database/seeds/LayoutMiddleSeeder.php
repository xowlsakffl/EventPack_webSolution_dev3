<?php

use App\LayoutMiddle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayoutMiddleSeeder extends Seeder
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
                <div id="home">
                    <div class="top">
                        <div class="title-banner">
                            <div class="title">Welcome to Try Everything</div>
                            <div class="date">October 23 - 25, 2021</div>
                            <input class="register-btn" type="button" value="Registration"/>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="contents">
                            <div class="subtitle">Overview</div>
                            <div class="content">
                    
                            </div>
                            <div class="icons">
                                <div class="icon-box">
                                    <div class="icon">
                                    </div>
                                    <div class="text">Welcome Message</div>
                                </div>
                                <div class="icon-box">
                                    <div class="icon">
                                    </div>
                                    <div class="text">Online Registration</div>
                                </div>
                                <div class="icon-box">
                                    <div class="icon">
                                    </div>
                                    <div class="text">General Information</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        ',
        '
                <div id="contents">
                    <div class="content">
                        <div class="content__title">Board</div>
                        <div class="content__board">
                            <div class="search-box">
                                <input class="search-box__text-box" type="text" placeholder="키워드"/>
                                <input class="search-box__search-btn" type="button" value="찾기"/>
                            </div>
                            <table class="board-table">
                                <thead>
                                    <tr>
                                        <th class="table-header__number">번호</th>
                                        <th class="table-header__title">제목</th>
                                        <th class="table-header__writer">작성자</th>
                                        <th class="table-header__file">파일</th>
                                        <th class="table-header__view">조회</th>
                                        <th class="table-header__date">날짜</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="table-body__number"></td>
                                        <td class="table-body__title">제목</td>
                                        <td class="table-body__writer">작성자</td>
                                        <td class="table-body__file">파일</td>
                                        <td class="table-body__view">조회</td>
                                        <td class="table-body__date">날짜</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="page-box">
                                <div class="btn-box">
                                    <input class="page-btn" type="button" value="<"/>
                                    <input class="page-btn" type="button" value="1"/>
                                    <input class="page-btn" type="button" value="2"/>
                                    <input class="page-btn" type="button" value="3"/>
                                    <input class="page-btn" type="button" value="4"/>
                                    <input class="page-btn" type="button" value="5"/>
                                    <input class="page-btn" type="button" value=">"/>
                                </div>
                                <input class="create-btn" type="button" value="CREATE"/>
                            </div>
                        </div>
                    </div>
                </div>
        '],
            'css' => [
        '
            /* 박스설정 */
            #home{
                width: 100%;
            }
            #home> .top {
                background-image: url(\'../../_img/main_pc_bg.jpg\');
                height: 366px;
            }
            #home> .top> .navigation-box {
                width: 100%;
                height: 80px;
                padding: 0 25px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            /* 로고 */
            #home> .top> .navigation-box> .navigation__logo {
                color: white;
                font-size: 20px;
                font-weight: bold;
            }
            /* 리스트 */
            #home> .top> .navigation-box> .navigation__list> .item {
                color: white;
                font-size: 15px;
                margin-right: 20px;
                font-weight: 500;
            }
            /* 로그인버튼 */
            #home> .top> .navigation-box> .navigation__list> .login-btn {
                background-color: #EA2461;
                color: white;
                padding: 5px 15px;
                border: none;
                border-radius: 20px;
            }
            #home> .top> .navigation-box> .navigation__list> .icon {
                color: white;
            }
            /* 타이틀배너 */
            #home> .top> .title-banner {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            #home> .top> .title-banner> .title {
                margin-top: 80px;
                color: white;
                font-size: 30px;
                font-weight: bold;
                text-align: center;
            }
            #home> .top> .title-banner> .date {
                margin-top: 10px;
                color: white;
            }
            #home> .top> .title-banner> .register-btn {
                background-color: #EA2461;
                color: white;
                border: none;
                border-radius: 5px;
                padding: 5px 15px;
                margin-top: 30px; 
            }
            /* 컨텐츠 */
            #home> .bottom> .contents {
                padding: 40px 80px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            #home> .bottom> .contents> .subtitle {
                font-size: 30px;
                margin-bottom: 60px;
            }
            #home> .bottom> .contents> .content {
                margin-bottom: 60px;
                word-break: break-all;
            }
            #home> .bottom> .contents> .icons {
                display: flex;
            }
            #home> .bottom> .contents> .icons> .icon-box {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 0 40px;
            }
            #home> .bottom> .contents> .icons> .icon-box> .icon {
                width: 100px;
                height: 100px;
                background-color: red;
                margin-bottom: 30px;
            }
            /* 반응형 */
            @media screen and (max-width : 767px) {
            #home> .top> .title-banner> .title {
                margin-top: 40px;
                font-size: 30px;
            }
            #home> .bottom> .contents {
                padding: 20px 15px;
            }
            
            #home> .bottom> .contents> .subtitle {
                font-size: 20px;
                margin-bottom: 20px;
            }
            #home> .bottom> .contents> .content {
                margin-bottom: 20px;
            }
            #home> .bottom> .contents> .icons> .icon-box {
                padding: 0 10px;
            }
            #home> .bottom> .contents> .icons> .icon-box> .icon {
                width: 10vw;
                height: 10vw;
                background-color: red;
                margin-bottom: 10px;
            }
            #home> .bottom> .contents> .icons> .icon-box> .text {
                font-size: 10px;
                text-align: center;
            }
            }
        ',
        '
            #contents {
                width: 100%;
            }
            /* 컨텐츠 가로크기 설정 */
            #contents> .content {
                width: 1200px;
                height: 100%;
                margin: 0 auto;
                padding-top: 80px;
                padding-bottom: 80px;
            }
            /* 컨텐츠 제목 */
            #contents> .content> .content__title {
                text-align: center;
                margin-bottom: 80px;
                font-size: 30px;
                font-weight: bold;
            }
            /* 서치박스 */
            #contents> .content> .content__board {
                
            }
            #contents> .content> .content__board> .search-box {
                width: 100%;
                height: 30px;
                display: flex;
                justify-content: flex-end;
            }
            #contents> .content> .content__board> .search-box> .search-box__text-box {
                height: 100%;
                border: 1px solid #16AAD8;
                border: 1px solid var(--button-color);
            }
            #contents> .content> .content__board> .search-box> .search-box__search-btn {
                width: 55px;
                height: 100%;
                background-color: #16AAD8;
                background-color: var(--background-color);
                color: white;
                border: 1px solid #16AAD8;
                border: 1px solid var(--button-color);
            }
            /* 테이블 */
            #contents> .content> .content__board> .board-table {
                width: 100%;
                margin: 10px 0 20px 0;
                border-collapse: collapse;
                border-top: 2px solid #777777;
            }
            #contents> .content> .content__board th, 
            #contents> .content> .content__board td {
                padding: 5px;
                font-weight: normal;
                border-top: 1px solid lightgray;
                border-bottom: 1px solid lightgray;
                border-right: 1px solid lightgray;
            }
            /* 테이블 헤더 간격 */
            #contents> .content> .content__board> .board-table thead> tr {text-align: center;}
            #contents> .content> .content__board> .board-table thead> tr> .table-header__number {
                width: 100px;
            }
            /* #contents> .content> .content__board> .board-table thead> tr> .table-header__title {} */
            #contents> .content> .content__board> .board-table thead> tr> .table-header__writer {
                width: 100px;
            }
            #contents> .content> .content__board> .board-table thead> tr> .table-header__file {
                width: 70px;
            }
            #contents> .content> .content__board> .board-table thead> tr> .table-header__view {
                width: 100px;
            }
            #contents> .content> .content__board> .board-table thead> tr> .table-header__date {
                width: 200px;
            }
            /* 테이블 컬럼 설정 */
            #contents> .content> .content__board> .board-table tbody> tr> .table-body__number {
                text-align: center;
            }
            /* #contents> .content> .content__board> .board-table tbody> tr> .table-body__title {} */
            #contents> .content> .content__board> .board-table tbody> tr> .table-body__writer {
                text-align: center;
            }
            #contents> .content> .content__board> .board-table tbody> tr> .table-body__file {
                text-align: center;
            }
            #contents> .content> .content__board> .board-table tbody> tr> .table-body__view {
                text-align: center;
            }
            #contents> .content> .content__board> .board-table tbody> tr> .table-body__date {
                text-align: center;
            }
            /* 페이지 */
            #contents> .content> .content__board> .page-box {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            /* 페이지 버튼 */
            #contents> .content> .content__board> .page-box> .btn-box> .page-btn {
                width: 40px;
                height: 40px;
                background-color: white;
                border: none;
                border-top: 1px solid #777777;
                border-left: 1px solid #777777;
                border-bottom: 1px solid #777777;
            }
            #contents> .content> .content__board> .page-box> .btn-box> .page-btn:nth-last-child(1) {
                border-right: 1px solid #777777;
            }
            /* 생성 버튼 */
            #contents> .content> .content__board> .page-box> .create-btn {
                width: 160px;
                height: 40px;
                background-color: #16AAD8;
                background-color: var(--button-color);
                color:white;
                border: none;
            
            }
            /* 반응형 */
            @media screen and (max-width : 1200px) {
                #contents> .content {
                    width: 100%;
                    padding-left: 20px;
                    padding-right: 20px;
                }
            }
            @media screen and (max-width : 767px) {
                #contents {
                    height: calc(100% - 220px);
                    overflow: scroll;
                }
                #contents> .content {
                    padding-top: 20px;
                    padding-bottom: 0px;
                }
                #contents> .content> .content__title {
                    margin-bottom: 20px;
                }
                #contents> .content> .content__board{
                    padding-bottom: 20px;
                }
                #contents> .content> .content__board> .board-table thead> tr> .table-header__date {
                    width: 100px;
                }
                #contents> .content> .content__board> .page-box> .btn-box> .page-btn {
                    width: 25px;
                    height: 25px;
                }
                #contents> .content> .content__board> .page-box> .create-btn {
                    width: 100px;
                    height: 30px;
                    background-color: #16AAD8;
                    background-color: var(--button-color);
                    color:white;
                    border: none;
                }
            }
        ']
        ];

        for ($i = 0;$i < count($datas['html']);$i++) {
            DB::table("layout_middles")->insert([
                'category' => 0,
                'name_ko' => '중단레이아웃_'.$i,
                'name_en' => 'Middle_'.$i,
                'code' => $faker->randomNumber,
                'html' => $datas['html'][$i],
                'css' => $datas['css'][$i],
                'state' => $faker->randomElement([LayoutMiddle::NORMAL, LayoutMiddle::UNPRINT, LayoutMiddle::STOP, LayoutMiddle::DELETE])
            ]);
        }
    }
}
