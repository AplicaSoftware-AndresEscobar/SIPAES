<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Repositories\UserRepository;

class UserSeeder extends Seeder
{
    /** @var UserRepository */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->userRepository->createFactory(5);
    }
}
