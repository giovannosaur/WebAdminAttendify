<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(\Kreait\Firebase\Firestore::class, function ($app) {
            $factory = (new Factory)->withServiceAccount(storage_path('app/firebase.json'));
            return $factory->createFirestore();
        });
    }
}
