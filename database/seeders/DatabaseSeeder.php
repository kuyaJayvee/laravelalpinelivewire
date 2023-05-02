<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
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
        // \App\Models\User::factory(5)->create();

        $user = User::factory()->create([
             'name' => 'John Doe',
             'email' => 'john@email.com'
        ]);
        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Listing::create([
        //     'title' => 'Laravel Senior Developer',
        //     'tags' => 'laravel, javascript',
        //     'company' => 'Acme Corp',
        //     'location' => 'Boston, MA',
        //     'email' => 'email1@email.com',
        //     'website' => 'https://www.acme.com',
        //     'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempora corrupti quibusdam dolor facere, voluptatibus aliquid perspiciatis eos quas incidunt. Ea expedita provident similique recusandae a aspernatur libero, labore sunt deserunt!'
        // ]);
        // Listing::create([
        //     'title' => 'Full Stack Developer',
        //     'tags' => 'laravel, api, javascript',
        //     'company' => 'Acme Corp',
        //     'location' => 'Boston, MA',
        //     'email' => 'email1@email.com',
        //     'website' => 'https://www.acme.com',
        //     'description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempora corrupti quibusdam dolor facere, voluptatibus aliquid perspiciatis eos quas incidunt. Ea expedita provident similique recusandae a aspernatur libero, labore sunt deserunt!'
        // ]);
    }
}
