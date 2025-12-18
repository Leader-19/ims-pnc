<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            /**
             * users permission
             */
            "users.view",
            "users.create",
            "users.edit",
            "users.delete",
            /**
             * role permission
             */
            "roles.view",
            "roles.create",
            "roles.edit",
            "roles.delete",

            /**
             * Worklog permission
             */

            "worklog.upload",
            "worklog.edit",
            "worklog.delete",
            "worklog.view",

            /**
             * slide permission
             */

            "slide.upload",
            "slide.edit",
            "slide.delete",
            "slide.view",

            /**
             * final report permission
             */

            "report.upload",
            "report.edit",
            "report.delete",
            "report.view",

            /**
             * contact supervisor permission
             */

            "supervisorContact.create",
            "supervisorContact.edit",
            "supervisorContact.delete",
            "supervisorContact.view",

            /**
             * company interview permission
             */

            "companyInterview.create",
            "companyInterview.edit",
            "companyInterview.delete",
            "companyInterview.view",

            /**
             * company internship permission
             */

            "companyInternship.create",
            "companyInternship.edit",
            "companyInternship.delete",
            "companyInternship.view",

            /**
             * score permission
             */

            "score.create",
            "score.edit",
            "score.delete",
            "score.view"
        ];

        // foreach ($permissions as $key => $value) {

        //     Permission::create(["name" => $value, 'guard_name' => 'web',]);
        // }

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'web']
            );
        }
    }
}
