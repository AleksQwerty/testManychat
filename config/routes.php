<?php

return [
    'departments/([0-9]+)'        => 'departments/view/$1',
    'departments/create'         => 'departments/create/',
    'departments/update/([0-9]+)' => 'departments/update/$1',
    'departments/delete/([0-9]+)' => 'departments/delete/$1',
    'departments'                 => 'departments/index',

    'employees/([0-9]+)'        => 'employees/view',
    'employees/create'         => 'employees/create/',
    'employees/update/([0-9]+)' => 'employees/update/$1',
    'employees/delete/([0-9]+)' => 'employees/delete/$1',
    'employees/department-filter/([0-9]+)' => 'departmentFilter/index/$1',
    'employees/project-filter/([0-9]+)' => 'projectFilter/index/$1',
    'employees'                 => 'employees/index',

    'projects/([0-9]+)'        => 'projects/view',
    'projects/create'         => 'projects/create/',
    'projects/update/([0-9]+)' => 'projects/update/$1',
    'projects/delete/([0-9]+)' => 'projects/delete/$1',
    'projects'                 => 'projects/index',

    'reports' => 'reports/index',

    '' => 'employees/index'
];

