<?php

use App\Course;
use App\Lesson;
use App\User;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        User::truncate();
        Course::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        factory(User::class, 15)->create();
        $courses = factory(Course::class, 10)->create();


        $courses->each(function ($course) {
            $course->enrollment()->syncWithoutDetaching(
                User::where('role', 'Student')
                    ->inRandomOrder()
                    ->limit(rand(1, 5))
                    ->get()->pluck('id')->toArray(),

                User::where('role', 'Teacher')
                    ->inRandomOrder()
                    ->limit(rand(1, 2))
                    ->get()->pluck('id')->toArray());

        });
        factory(Course::class)->create();

    }
}
