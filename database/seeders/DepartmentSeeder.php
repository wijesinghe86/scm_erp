<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $department = new Department;
        $department->department_number = "DP001";
        $department->department_name = "IT";
        $department->save();

        $section = new Section;
        $section->section_number  = "SE001";
        $section->department_number =  $department->department_number;
        $section->save();

        $employee = new Employee;
        $employee->employee_fullname = "Employee 1";
        $employee->department = $department->id;
        $employee->branch = $section->id;
        $employee->save();




    }
}
