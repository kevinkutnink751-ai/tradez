<?php

return [
    "categories" => [
        [
            "category" => [
                "id" => 1,
                "category" => "Artificial Intelligence"
            ],
            "lessons" => [
                [
                    "id" => 1,
                    "title" => "What is AI?",
                    "description" => "Introduction to Artificial Intelligence",
                    "length" => "10:30",
                    "video_link" => "https://www.youtube.com/embed/ad79nYk2keg",
                    "category" => [
                        "category" => "Artificial Intelligence"
                    ]
                ],
                [
                    "id" => 2,
                    "title" => "Machine Learning Basics",
                    "description" => "Understanding ML fundamentals",
                    "length" => "15:00",
                    "video_link" => "https://www.youtube.com/embed/ukzFI9rgwfU",
                    "category" => [
                        "category" => "Artificial Intelligence"
                    ]
                ]
            ]
        ],
        [
            "category" => [
                "id" => 2,
                "category" => "Web Development"
            ],
            "lessons" => [
                [
                    "id" => 3,
                    "title" => "Laravel Routing",
                    "description" => "Deep dive into Laravel routes",
                    "length" => "12:45",
                    "video_link" => "https://www.youtube.com/embed/MYyJ4PuL4pY",
                    "category" => [
                        "category" => "Web Development"
                    ]
                ],
                [
                    "id" => 4,
                    "title" => "Blade Templates",
                    "description" => "Mastering Blade templating engine",
                    "length" => "08:20",
                    "video_link" => "https://www.youtube.com/embed/8sLCzMwkMos",
                    "category" => [
                        "category" => "Web Development"
                    ]
                ]
            ]
        ]
    ],
    "courses" => [
        [
            "course" => [
                "id" => 1,
                "course_title" => "Introduction to AI",
                "course_image" => "https://via.placeholder.com/400x200?text=AI",
                "amount" => 5000,
                "category" => "Artificial Intelligence",
                "description"=>"Artificial Intelligence (AI) refers to the simulation of human intelligence in machines, enabling them to perform tasks such as learning, reasoning, problem-solving, perception, and decision-making. AI encompasses various subfields including machine learning, deep learning, natural language processing, computer vision, and robotics. It is used in diverse applications such as virtual assistants, recommendation systems, medical diagnosis, autonomous vehicles, and fraud detection.",
                
                 "updated_at" => "2023-01-01T00:00:00Z",
                "created_at" => "2023-01-01T00:00:00Z"
            ],
            "lessons" => [
                ["id" => 1, "title" => "What is AI?",             "description" => "Intro to AI",           "video_link" => "https://www.youtube.com/embed/ad79nYk2keg", "order" => 1,  "length" => "10:30", "locked" => false],
                ["id" => 2, "title" => "Machine Learning Basics", "description" => "ML fundamentals",        "video_link" => "https://www.youtube.com/embed/ukzFI9rgwfU", "order" => 2,  "length" => "10:30", "locked" => false],
                ["id" => 3, "title" => "Neural Networks",         "description" => "Deep learning basics",   "video_link" => "https://www.youtube.com/embed/aircAruvnKk", "order" => 3,  "length" => "10:30", "locked" => false]
            ],
            "users" => [
                ["id" => 1, "name" => "John Doe"],
                ["id" => 2, "name" => "Jane Smith"]
            ]
        ],
        [
            "course" => [
                "id" => 2,
                "course_title" => "Web Development Bootcamp",
                "course_image" => "https://via.placeholder.com/400x200?text=Web+Dev",
                "amount" => 0,
                "category" => "Web Development", 
                'description'=>"Laravel is a free, open-source PHP web framework intended for the development of web applications following the model–view–controller (MVC) architectural pattern. Laravel is created by Taylor Otwell and was launched in 2011. It is a popular framework for developing web applications and has a large community of developers.",       
                "updated_at" => "2023-01-01T00:00:00Z",
                "created_at" => "2023-01-01T00:00:00Z"
            ],
            "lessons" => [
                ["id" => 4, "title" => "HTML Basics",        "description" => "Structure of the web",      "video_link" => "https://www.youtube.com/embed/UB1O30fR-EE", "order" => 1,  "length" => "10:30", "locked" => false],
                ["id" => 5, "title" => "CSS Fundamentals",   "description" => "Styling your pages",        "video_link" => "https://www.youtube.com/embed/yfoY53QXEnI", "order" => 2,  "length" => "10:30", "locked" => false]
            ],
            "users" => [
                ["id" => 3, "name" => "Bob Johnson"]
            ]
        ],
        [
            "course" => [
                "id" => 3,
                "course_title" => "Laravel Mastery",
                "course_image" => "https://via.placeholder.com/400x200?text=Laravel",
                "amount" => 12000,
                "category" => "Laravel",
                'description'=>"Laravel is a free, open-source PHP web framework intended for the development of web applications following the model–view–controller (MVC) architectural pattern. Laravel is created by Taylor Otwell and was launched in 2011. It is a popular framework for developing web applications and has a large community of developers.",
                "updated_at" => "2023-01-01T00:00:00Z",
                "created_at" => "2023-01-01T00:00:00Z"
            ],
            "lessons" => [
                ["id" => 6, "title" => "Routing",        "description" => "Laravel routing deep dive",  "video_link" => "https://www.youtube.com/embed/MYyJ4PuL4pY", "order" => 1, "length" => "10:30", "locked" => false],
                ["id" => 7, "title" => "Eloquent ORM",   "description" => "Database interactions",      "video_link" => "https://www.youtube.com/embed/8sLCzMwkMos", "order" => 2, "length" => "10:30","locked" => false],
                ["id" => 8, "title" => "Blade Templates","description" => "Templating engine mastery",  "video_link" => "https://www.youtube.com/embed/8sLCzMwkMos", "order" => 3, "length" => "10:30","locked" => false],
                ["id" => 9, "title" => "Middleware",     "description" => "Request lifecycle control",  "video_link" => "https://www.youtube.com/embed/8sLCzMwkMos", "order" => 4, "length" => "10:30","locked" => false]
            ],
            "users" => [
                ["id" => 4, "name" => "Alice Brown"],
                ["id" => 5, "name" => "Charlie Wilson"],
                ["id" => 6, "name" => "Diana Prince"]
            ]
        ]
    ]
];