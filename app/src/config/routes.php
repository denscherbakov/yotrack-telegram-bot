<?php

return [
    'api' => [
        'users' => [
            'get.current.userdata' => 'admin/users/me?fields=id,login,name,email',
        ],
        'issues' => [
	        'get.for'           => 'issues?fields=id,summary,numberInProject,project(shortName),updated&query=for:+',
        ]
    ]
];