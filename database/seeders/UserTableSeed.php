<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i !== 4; $i++) {
            $this->userFactory();
        }
    }

    private function userFactory()
    {
        $user = new User();
        $user->name = Str::random(8);
        $user->last_name = Str::random(8);
        $user->save();
    }
}
