<?php

namespace Database\Seeders;

use App\Models\JobVacancy;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobVacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_seed = [
            [
                "id"         => "this-is-first-job",
                "user_id"    => 'this-is-admin-user',
                "title"      => "Backend Developer - Co-op/Internship - job post",
                "job_no"     => 15454500,
                'created_at' => now(),
                "body"       => "FlashBox is a last-mile delivery start-up headquartered in Toronto. We have rapidly grown to deliver products across the GTA through our offering of low prices and high-quality service. What sets us apart from the competition is that we develop our software in-house; this allows us to develop new products based on customer requests. In addition, our solutions are available to every business, regardless of their size or industry."
            ],
            [
                "id"         => "this-is-full-job",
                "user_id"    => 'this-is-admin-user',
                "title"      => "Intermediate Vue Developer - Frontend (Remote) - job post",
                "job_no"     => 988784,
                'created_at' => now(),
                "body"       => "Rivalry has been pushing the boundaries on what an esports betting product can be, and we’ve been doing it well. As our user base grows and we enter new global regions, the demand to create new and better products is increasing. We're focused on having the best product in the gambling space. We aren’t willing to accept being marginally better. "
            ],
            [
                "id"      => "this-is-second-job",
                "user_id" => 'this-is-admin-user',
                "title"   => "Intermediate Remote Yii/Laravel Developer PHP - job post",
                "job_no"  => 1075445,
                'created_at' => now(),
                "body"    => "Mindfield Consulting Corporation (MCC) creates mission-critical technologies for our client’s strategic teams. Expect a fair and equitable environment to help meet your flexible work-life requirements. Our team is growing and seeking seeking a number of enthusiastic programmers with strong MVC, PHP, and MS/My SQL skills to support key client projects that will make a difference in their day-to-day operations and strategic initiatives. Clients trust Mindfield with their most critical systems and digital transformations so that they can lead their industries with technology. The successful candidate will work remotely as part of a nimble team to deliver key features. As our team continues to grow there will be options for work from home and part-time/full-time roles available."
            ],
            [
                "id"         => "this-is-third-job",
                "user_id"    => 'this-is-admin-user',
                "title"      => "Full Stack PHP Developer - job post",
                "job_no"     => 452424222,
                'created_at' => now(),
                "body"       => "5 or more years of professional experience as a PHP and Javascript developer with some experience in Laravel, multiple JS Frameworks & Libraries, HTML or CSS (LESS & SASS).Able to understand and work with complex code and solve complex problems in Javascript and Shopify Integrations. Able to trace through unclean code to debug and find solutions quickly."
            ],
            [
                "id"         => "this-is-a-job",
                'created_at' => now(),
                "user_id"    => 'this-is-admin-user',
                "title"      => "Software Engineer - Full Stack (Remote) - job post",
                "job_no"     => 144524442,
                "body"       => " Want to join a team where your work makes a significant impact and is seen by millions of users? Our full stack engineers work across all areas of product development. You will build the features and applications that make Yelp the best place to find and support Local Businesses. Our goal is to provide an excellent experience for our users, and our full stack engineers dive into any area of the web stack to make it happen."
            ]

        ];
        JobVacancy::insert($job_seed);
        JobVacancy::find('this-is-a-job')->tags()->create(['name' => 'laravel']
        );
        JobVacancy::find('this-is-second-job')->tags()->create(
            ['name' => 'laravel']
        );
        JobVacancy::find('this-is-second-job')->tags()->create(['name' => 'php']
        );
        JobVacancy::find('this-is-first-job')->tags()->create(['name' => 'php']
        );
    }
}
