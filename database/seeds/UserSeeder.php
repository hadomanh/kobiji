<?php

use App\Models\Lesson;
use App\Models\Skill;
use App\Models\Subject;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email = 'manager@gmail.com';
        $user->name = 'Manager';
        $user->role = 'manager';
        $user->password = bcrypt('12345678');
        $user->avatar = 'bower_components/admin-lte/dist/img/user2-160x160.jpg';

        $user->save();

        $user = new User();
        $user->email = 'admin@gmail.com';
        $user->name = 'Admin';
        $user->role = 'admin';
        $user->password = bcrypt('12345678');
        $user->avatar = 'bower_components/admin-lte/dist/img/user2-160x160.jpg';

        $user->save();

        $subject = new Subject();
        $subject->name = 'Math';
        $subject->code = 'IT1102';
        $subject->description = 'Math';
        $subject->teacher = 'Mr. Quang';
        $subject->target = 'Naiteisha';
        $subject->session = 15;
        $subject->from = now();
        $subject->to = now()->addDays(10);
        $subject->limit = 20;

        $subject->save();
        $subject->refresh();

        for ($i = 0; $i < 10; $i++) {
            $lesson = new Lesson();
            $lesson->title = 'Lesson ' . $i;
            $lesson->date = date('Y-m-d');
            $lesson->from = date('H:i');
            $lesson->to = date('H:i', strtotime('+1 hour'));
            $lesson->subject()->associate($subject);
            $lesson->save();
            $lesson->refresh();
        }

        for ($i = 0; $i < 3; $i++) {
            $skill = new Skill();
            $skill->name = 'Skill ' . $i;
            $skill->ratio = mt_rand() / mt_getrandmax();
            $skill->subject()->associate($subject);
            $skill->save();
            $skill->refresh();
        }




        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->email = 'student' . $i . '@gmail.com';
            $user->name = 'Student ' . $i;
            $user->role = 'student';
            $user->password = bcrypt('12345678');
            $user->avatar = 'bower_components/admin-lte/dist/img/user2-160x160.jpg';

            $user->save();

            $subject->students()->attach($user->id, [
                'midterm' => mt_rand(1, 10),
                'endterm' => mt_rand(1, 10),
                'attendance' => mt_rand(1, 10),
            ]);

            foreach ($subject->lessons as $lesson) {
                $lesson->students()->attach($user->id, [
                    'status' => 'PRESENT',
                ]);
            }

            foreach ($subject->skills as $skill) {
                $skill->students()->attach($user->id, [
                    'grade' => mt_rand(1, 10),
                ]);
            }
        }

        // seed 10 subjects
        for ($i = 0; $i < 10; $i++) {
            $subject = new Subject();
            $subject->name = 'Subject ' . $i;
            $subject->code = 'IT120' . $i;
            $subject->teacher = 'Mr. Quang';
            $subject->target = 'Naiteisha';
            $subject->session = 15;
            $subject->description = 'Math';
            $subject->from = now();
            $subject->to = now()->addDays(10);
            $subject->limit = 20;

            $subject->save();
            $subject->refresh();
        }

    }
}
