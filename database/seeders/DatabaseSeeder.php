<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([ /* この順番でマイグレーションしないとエラーが発生するので注意 */
            UserSeeder::class,
            SeriesSeeder::class,
            OutputSettingTemplateSeeder::class,
            NovelSeeder::class,
            NovelSettingTemplateSeeder::class,
            ShortcutSeeder::class,
            FunctionButtonSeeder::class,
        ]);
    }
}
