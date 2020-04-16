<?php
return [
    'app' => [
        'title' => 'General',
        'desc' => 'All the general settings for application.',
        'icon' => 'fa fa-info-circle',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'app_name', // unique name for field
                'label' => 'App Name', // you know what label it is
                'rules' => 'required|min:2|max:100', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => 'Elzahaby Educations' // default value if you want
            ], [
                'type' => 'file', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'app_logo', // unique name for field
                'rules' => 'required', // validation rule of laravel
                'label' => 'App Logo', // you know what label it is
                'class' => 'logo', // any class for input
//                'value' => asset('/images/w_logo.png') // default value if you want
//                'value' => ('/uploads/logo/default-logo.png') // default value if you want
            ], [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'app_desc', // unique name for field
                'rules' => 'required', // validation rule of laravel
                'label' => 'App Description', // you know what label it is
                'class' => 'form-control', // any class for input
                'value' => 'The Laravel web applications for educations made by @egy.js ' // default value if you want
            ], [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'app_address', // unique name for field
                'rules' => 'required', // validation rule of laravel
                'label' => 'Address', // you know what label it is
                'class' => 'form-control', // any class for input
                'value' => '1234, Cairo, Egypt' // default value if you want
            ]
        ]
    ],
    'contact' => [

        'title' => 'Contact Us',
        'desc' => 'information About your app',
        'icon' => 'fa fa-envelope',
        'row' => true,

        'elements' => [
            [
                'col' => 'col-6',
                'type' => 'email', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'main_email', // unique name for field
                'label' => 'Main Email', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => 'email@gmail.com' // default value if you want
            ], [
                'col' => 'col-6',
                'type' => 'number', // input fields type
                'data' => 'int', // data type, string, int, boolean
                'name' => 'main_phone', // unique name for field
                'label' => 'Main Phone', // you know what label it is
                'rules' => 'numeric', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => '0123456789' // default value if you want
            ], [
                'col' => 'col-12',
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'main_fax', // unique name for field
                'label' => 'Main Fax', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => '05654' // default value if you want
            ]

        ]
    ],
    'socials' => [

        'title' => 'Our Socials',
        'desc' => 'information About your Socials links',
        'icon' => 'fa fa-paper-plane',

        'elements' => [
            [
                'type' => 'url', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'fa-facebook', // unique name for field
                'label' => 'Facebook', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => '' // default value if you want
            ], [
                'type' => 'url', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'fa-twitter', // unique name for field
                'label' => 'Twitter', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => '' // default value if you want
            ], [
                'type' => 'url', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'fa-google', // unique name for field
                'label' => 'Gmail', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => '' // default value if you want
            ], [
                'type' => 'url', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'fa-instagram', // unique name for field
                'label' => 'Instagram', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'form-control', // any class for input
                'value' => '' // default value if you want
            ],

        ]
    ],
//    'about' => [
//
//        'title' => 'About',
//        'desc' => 'information About your Socials links',
//        'icon' => 'fa fa-paper-plane',
//
//        'elements' => [
//            [
//                'type' => 'textarea', // input fields type
//                'data' => 'string', // data type, string, int, boolean
//                'name' => 'whoAreWe', // unique name for field
//                'label' => 'من نحن', // you know what label it is
//                'rules' => '', // validation rule of laravel
//                'class' => '', // any class for input
//                'value' => '' // default value if you want
//            ],             [
//                'type' => 'textarea', // input fields type
//                'data' => 'string', // data type, string, int, boolean
//                'name' => 'Massage', // unique name for field
//                'label' => 'رسالتنا', // you know what label it is
//                'rules' => '', // validation rule of laravel
//                'class' => '', // any class for input
//                'value' => '' // default value if you want
//            ], [
//                'type' => 'textarea', // input fields type
//                'data' => 'string', // data type, string, int, boolean
//                'name' => 'vision', // unique name for field
//                'label' => 'رؤيتنا', // you know what label it is
//                'rules' => '', // validation rule of laravel
//                'class' => '', // any class for input
//                'value' => '' // default value if you want
//            ], [
//                'type' => 'textarea', // input fields type
//                'data' => 'string', // data type, string, int, boolean
//                'name' => 'value', // unique name for field
//                'label' => 'قيمنا', // you know what label it is
//                'rules' => '', // validation rule of laravel
//                'class' => '', // any class for input
//                'value' => '' // default value if you want
//            ],             [
//                'type' => 'textarea', // input fields type
//                'data' => 'string', // data type, string, int, boolean
//                'name' => 'goals', // unique name for field
//                'label' => 'اهدافنا', // you know what label it is
//                'rules' => '', // validation rule of laravel
//                'class' => '', // any class for input
//                'value' => '' // default value if you want
//            ],
//
//        ]
//    ],
    'slider' => [

        'title' => 'Slider ',
        'desc' => 'add image slider',
        'icon' => 'fa fa-file',

        'elements' => [
            [
                'type' => 'file', // input fields type
                'data' => 'json', // data type, string, int, boolean,json
                'name' => 'slider', // unique name for field
                'label' => 'Slider', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => 'slider', // any class for input
                'value' => [] // default value if you want
            ],


        ]
    ],
];
