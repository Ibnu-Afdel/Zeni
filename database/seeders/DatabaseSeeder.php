<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('');
        $this->command->info('╔═══════════════════════════════════════════════════════════╗');
        $this->command->info('║           CREATING USERS WITH CREDENTIALS                 ║');
        $this->command->info('╚═══════════════════════════════════════════════════════════╝');
        $this->command->info('');

        // Create Admin User
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@zeni.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'status' => 'approved',
        ]);

        $this->command->info('🔑 ADMIN ACCOUNT:');
    $this->command->line('   Email: admin@zeni.com');
        $this->command->line('   Password: password');
        $this->command->info('');

        // Create Instructor User
        $instructor = User::factory()->create([
            'name' => 'John Instructor',
            'username' => 'instructor',
            'email' => 'instructor@zeni.com',
            'password' => bcrypt('password'),
            'role' => 'instructor',
            'status' => 'approved',
        ]);

        $this->command->info('👨‍🏫 INSTRUCTOR ACCOUNT:');
    $this->command->line('   Email: instructor@zeni.com');
        $this->command->line('   Password: password');
        $this->command->info('');

        // Create Student User
        $student = User::factory()->create([
            'name' => 'Jane Student',
            'username' => 'student',
            'email' => 'student@zeni.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'status' => 'approved',
        ]);

        $this->command->info('🎓 STUDENT ACCOUNT:');
    $this->command->line('   Email: student@zeni.com');
        $this->command->line('   Password: password');
        $this->command->info('');

        // Create Pro Student User
        $proStudent = User::factory()->create([
            'name' => 'Pro Student',
            'username' => 'prostudent',
            'email' => 'prostudent@zeni.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'status' => 'approved',
            'is_pro' => true,
        ]);

        $this->command->info('⭐ PRO STUDENT ACCOUNT (Has premium access):');
    $this->command->line('   Email: prostudent@zeni.com');
        $this->command->line('   Password: password');
        $this->command->info('');

        $this->command->info('═══════════════════════════════════════════════════════════');
        $this->command->info('');

        // Run the course seeder
        $this->call([
            CourseSeeder::class,
        ]);

        $this->command->info('');
        $this->command->info('╔═══════════════════════════════════════════════════════════╗');
        $this->command->info('║              SEEDING COMPLETED SUCCESSFULLY!              ║');
        $this->command->info('╚═══════════════════════════════════════════════════════════╝');
        $this->command->info('');
        $this->command->info('You can now login with any of the accounts above.');
        $this->command->info('All passwords are: password');
        $this->command->info('');
    }
}
