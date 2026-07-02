<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Assignable Roles
    |--------------------------------------------------------------------------
    |
    | Defines which roles a user with a given role can assign to others.
    | The key is the role name that the current user must have, and the
    | value is an array of role names they are allowed to assign.
    |
    | Example:
    |   'admin' => ['staff', 'encoder'],
    |
    | Users with 'super_admin' can assign any role (handled in code).
    |
    */

    'assignable' => [
        'admin' => ['staff', 'encoder', 'viewer'],
    ],

];
