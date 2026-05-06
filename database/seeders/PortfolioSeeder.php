<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\Setting;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            'Laravel', 'Vue.js', 'Inertia.js', 'React', 'PHP',
            'JavaScript', 'MySQL', 'ESP32', 'Python', 'Java',
            'Git', 'REST APIs', 'Tailwind CSS', 'Linux', 'CompTIA A+'
        ];

        foreach ($skills as $i => $skill) {
            Skill::create(['name' => $skill, 'sort_order' => $i]);
        }

        Setting::set('name', 'Yuvraj Singh');
        Setting::set('title', 'Full Stack Developer & CPIS Student');
        Setting::set('bio', 'CPIS student at Farmingdale State College. I build full-stack web systems using Laravel, Vue, and IoT hardware.');
        Setting::set('location', 'New York, NY');
        Setting::set('linkedin', 'https://linkedin.com/in/yuvrajsingh');
        Setting::set('github_username', 'yuvrajsingh');
        Setting::set('email', 'YOUR_EMAIL_HERE');
        Setting::set('open_to_work', 'true');
        Setting::set('resume_url', '/resume.pdf');
    }
}