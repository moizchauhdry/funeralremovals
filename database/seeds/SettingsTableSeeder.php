<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();
        DB::table('settings')->insert([
            [
                'key' => 'site_title',
                'value' => 'Universal removals'
            ],
            [
                'key' => 'site_logo',
                'value' => asset('logo-black.png'),
            ],
            [
                'key' => 'site_email_logo',
                'value' => asset('logo-white.png'),
            ],
            [
                'key' => 'site_icon',
                'value' => asset('favicon.ico'),
            ],
            [
                'key' => 'site_copyright',
                'value' => '&copy; '.date('Y').''
            ],
            [
                'key' => 'provider_select_timeout',
                'value' => 60
            ],
            [
                'key' => 'provider_search_radius',
                'value' => 100
            ],
            [
                'key' => 'base_price',
                'value' => 50
            ],
            [
                'key' => 'price_per_minute',
                'value' => 50
            ],
            [
                'key' => 'tax_percentage',
                'value' => 0
            ],
            [
                'key' => 'stripe_secret_key',
                'value' => ''
            ],
            [
                'key' => 'stripe_publishable_key',
                'value' => ''
            ],
            [
                'key' => 'CASH',
                'value' => 1
            ],
            [
                'key' => 'CARD',
                'value' => 1
            ],
            [
                'key' => 'manual_request',
                'value' => 0
            ],
            [
                'key' => 'default_lang',
                'value' => 'en'
            ],
            [
                'key' => 'currency',
                'value' => '$'
            ],
            [
                'key' => 'distance',
                'value' => 'Km'
            ],
            [
                'key' => 'scheduled_cancel_time_exceed',
                'value' => 10
            ],
            [
                'key' => 'price_per_kilometer',
                'value' => 10
            ],
            [
                'key' => 'commission_percentage',
                'value' => 0
            ],
            [
                'key' => 'store_link_android',
                'value' => ''
            ],
            [
                'key' => 'user_refer_point',
                'value' => 0
            ],
            [
                'key' => 'driver_refer_point',
                'value' => 0
            ],
            [
                'key' => 'store_link_ios',
                'value' => ''
            ],
            [
                'key' => 'daily_target',
                'value' => 0
            ],
            [
                'key' => 'surge_percentage',
                'value' => 0
            ],
            [
                'key' => 'surge_trigger',
                'value' => 0
            ],
            [
                'key' => 'demo_mode',
                'value' => 0
            ],
            [
                'key' => 'booking_prefix',
                'value' => 'TRNX'
            ],
            [
                'key' => 'referal_prefix',
                'value' => 'TRNX'
            ],
            [
                'key' => 'sos_number',
                'value' => '911'
            ],
            [
                'key' => 'contact_number',
                'value' => ''
            ],
            [
                'key' => 'contact_email',
                'value' => ''
            ],
            [
                'key' => 'social_login',
                'value' => 0
            ],
            [
                'key' => 'map_key',
                'value' => 'AIzaSyDGKun2rZAP3vRpYjjEkp5MVT7kvC6h-mU'
            ],
            [
                'key' => 'fb_app_version',
                'value' => 'v9.0'
            ],
            [
                'key' => 'fb_app_id',
                'value' => '407132567127319'
            ],
            [
                'key' => 'fb_app_secret',
                'value' => '70c2bba149dff99f0ef64ed0f1b56985'
            ],
            [
                'key' => 'provider_welcome_email',
                'value' => 'Hello,
Welcome to Xeride, To complete your signup process please send your following documents to&nbsp;info@venturecab.net
Document #1
Document #2
Document #3

Thank you and Good Luck!'
            ]
        ]);
    }
}
