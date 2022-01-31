<?php

namespace App\Providers;

use App\Models\Place;
use App\Models\Thing;
use App\Models\UseModel;
use App\Models\User;
use App\Policies\PlacePolicy;
use App\Policies\ThingPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Thing::class => ThingPolicy::class,
        Place::class => PlacePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-panel', function (User $user) {
           if ($user->role_id == '1') {
               return true;
           }
           else {
               return false;
           }
        });

//        Gate::define('delete-update', function (User $user, Thing $thing) {
//
//            $masters = DB::table("use_models")
//                ->where('thing_id', $thing->id)
//                ->where('user_id', auth()->user()->id)
//                ->select('use_models.*')
//                ->get();
//
//            if (auth()->user()->id == $thing->master_id) {
//                return true;
//            }
//
//            else {
//                if (count($masters) != 0) {
//                    foreach ($masters as $master) {
//                        if ($master->user_id == auth()->user()->id) {
//                            return true;
//                        }
//                    }
//                }
//            }
//
//            return false;
//        });
    }
}
