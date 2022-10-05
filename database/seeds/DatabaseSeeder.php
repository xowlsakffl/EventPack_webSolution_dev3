<?php

use App\Layout;
use App\LayoutBottom;
use App\LayoutEtc;
use App\LayoutMiddle;
use App\LayoutNavigation;
use App\LayoutTop;
use App\Pack;
use App\PackBoard;
use App\PackPage;
use App\Site;
use App\SiteLayoutSet;
use App\SiteNavigation;
use App\SiteTask;
use App\SiteUser;
use App\SiteUserCondition;
use App\SiteUserType;
use App\User;
use App\Work;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
     /*    factory(User::class, 10)->create();

        factory(Work::class, 30)->create(); */

        //factory(Site::class, 30)->create();
        /*
        factory(SiteUserType::class, 50)->create();

        factory(SiteUserCondition::class, 50)->create();
*/
        //factory(SiteUser::class, 300)->create();
        
        /* factory(SiteNavigation::class, 50)->create();

        factory(Pack::class, 50)->create();

        factory(SiteTask::class, 50)->create();  */
        
        factory(Layout::class, 1)->create();
        /*
        
        factory(SiteLayoutSet::class, 50)->create(); */

        /* factory(PackPage::class, 50)->create();

        factory(PackBoard::class, 50)->create(); */
    }
}
