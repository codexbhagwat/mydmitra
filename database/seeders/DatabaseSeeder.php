<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'first_name' => 'Admin',
            'last_name'  => 'Mydmitra',
            'email'      => 'admin@mydmitra.com',
            'phone'      => '9999999999',
            'password'   => Hash::make('Admin@1234'),
            'role'       => 'admin',
        ]);

        // Demo user
        User::create([
            'first_name' => 'Priyanshu',
            'last_name'  => 'Mahato',
            'email'      => 'priyanshuumahato@gmail.com',
            'phone'      => '9876543210',
            'password'   => Hash::make('password'),
            'role'       => 'user',
        ]);

        $services = [
            ['name' => 'Birth Certificate',     'description' => 'Apply for an official birth certificate for newborns or for record correction.',           'price' => 199, 'icon' => 'bi-file-earmark-person'],
            ['name' => 'PAN Card Application',  'description' => 'Apply for a new PAN card or request corrections to existing PAN details.',                'price' => 499, 'icon' => 'bi-credit-card'],
            ['name' => 'Bank Account Opening',  'description' => 'Assisted service for opening a new bank account with major public and private banks.',     'price' => 299, 'icon' => 'bi-bank'],
            ['name' => 'Passport Application',  'description' => 'End-to-end assistance with passport applications, renewals, and document verification.',   'price' => 999, 'icon' => 'bi-journal-bookmark'],
            ['name' => 'Aadhaar Card Update',   'description' => 'Update your address, phone number, or biometrics on your Aadhaar card.',                  'price' => 149, 'icon' => 'bi-person-vcard'],
            ['name' => 'Income Certificate',    'description' => 'Official income certificate issuance for scholarship and government scheme eligibility.',  'price' => 249, 'icon' => 'bi-receipt'],
            ['name' => 'Driving Licence',       'description' => 'Apply for a learner\'s licence or permanent driving licence with RTO assistance.',         'price' => 799, 'icon' => 'bi-car-front'],
            ['name' => 'Voter ID Registration', 'description' => 'New voter ID registration or update existing voter card information.',                     'price' => 99,  'icon' => 'bi-box-arrow-in-right'],
        ];

        foreach ($services as $service) {
            Service::create(array_merge($service, ['is_active' => true]));
        }
    }
}
