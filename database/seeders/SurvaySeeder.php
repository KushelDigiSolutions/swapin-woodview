<?php

namespace Database\Seeders;

use App\Models\Survey;
use App\Models\SurveyCategory;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SurvaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Delete data instead of truncating
        DB::table('survey_categories')->truncate();
        $this->command->warn("Survey Category table truncated!");

        DB::table('surveys')->truncate();
        $this->command->warn("Survey table truncated!");


        SurveyCategory::create(['name' => 'jan']);
        SurveyCategory::create(['name' => 'feb']);

        $this->command->info("Survey Category 'jan' ,'feb' seeded successfully!");

        $faker = Faker::create();

        // Get category ids
        $janCategoryId = SurveyCategory::where('name', 'jan')->first()->id;
        $febCategoryId = SurveyCategory::where('name', 'feb')->first()->id;

        $user = User::where('role_id', 1)->first();

        // Create 25 surveys
        for ($i = 0; $i < 25; $i++) {
            $endDate = $faker->dateTimeBetween('now', '+1 year');
            Survey::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'user_id' => $user->id, // Assuming users exist
                'category_id' => $faker->randomElement([$janCategoryId, $febCategoryId]),
                'end_date' => $endDate,
                'status' => $faker->randomElement(['active', 'inactive'])
            ]);
        }
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->command->info('Survay seeded successfully!');
        $this->command->info('Developed by Swapin Vidya (c) 2024 for LaravelOne.in.');
    }
}
