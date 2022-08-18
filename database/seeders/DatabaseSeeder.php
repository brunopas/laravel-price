<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Offer;
use App\Models\Store;
use App\Models\Coupon;
use App\Models\OfferLike;
use App\Models\OfferView;
use App\Models\OfferComment;
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
        $numberOfUsers = 10;
        $numberOfStores = 20;

        $offersPerUser = 1;
        $couponsPerUser = 5;

        $commentsPerOfferStart = 0;
        $commentsPerOfferEnd = 10;

        $likesPerOfferStart = 0;
        $likesPerOfferEnd = 10;

        User::factory()->create([
            'name' => 'Administrator',
            'username' => 'administrator',
            'email' => 'administrator@laraprice.com',
        ]);

        User::factory($numberOfUsers)->create();
        Store::factory($numberOfStores)->create();

        for ($iUser = 1; $iUser <= $numberOfUsers; $iUser++) {
            $currentUser = User::find($iUser);

            for ($iOffer = 0; $iOffer < $offersPerUser; $iOffer++) {
                $offerCreated = Offer::factory()->create([
                    'store_id' => rand(1, $numberOfStores),
                    'user_id' => $currentUser->id
                ]);

                $commentsPerOffer = rand($commentsPerOfferStart, $commentsPerOfferEnd);
                $likesPerOffer = rand($likesPerOfferStart, $likesPerOfferEnd);
                $viewsPerOffer = max($commentsPerOffer, $likesPerOffer) * 10;

                for ($iComment = 0; $iComment < $commentsPerOffer; $iComment++) {
                    OfferComment::factory()->create([
                        'offer_id' => $offerCreated->id,
                        'user_id' => rand(1, $numberOfUsers)
                    ]);
                }

                for ($iLike = 0; $iLike < $likesPerOffer; $iLike++) {
                    OfferLike::factory()->create([
                        'offer_id' => $offerCreated->id,
                        'user_id' => $currentUser->id
                    ]);
                }

                for ($iView = 0; $iView < $viewsPerOffer; $iView++) {
                    OfferView::factory()->create([
                        'offer_id' => $offerCreated->id
                    ]);
                }
            }

            for ($iCoupon = 0; $iCoupon < $couponsPerUser; $iCoupon++) {
                Coupon::factory()->create([
                    'store_id' => rand(1, $numberOfStores),
                    'user_id' => $currentUser->id
                ]);
            }
        }
    }
}
