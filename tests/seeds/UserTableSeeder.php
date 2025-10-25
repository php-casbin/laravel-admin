<?php

namespace Tests\Seeds;

use Illuminate\Database\Seeder;
use seeds\TagFactory;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        UserFactory::factory()->count(50)->has(ProfileFactory::factory())->has(TagFactory::factory()->count(5))->create();
    }
}
