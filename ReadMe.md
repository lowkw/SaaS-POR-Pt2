# Books, Authors and a Library to Go!

# About
SaaS-POR-Pt2

Demonstrating web based back-end interface and code for a small application.

To develop this application we are using:
- [Laravel (v10.12)](https://laravel.com)
- [Laravel Sanctum (v3.2.5)] (https://laravel.com/docs/10.x/sanctum) 
- [Postman (v10.14.6)] (https://www.postman.com)
- [Blade (v1.21)] (https://laravel.com/docs/10.x/blade)
- [Tailwind CSS (v3.3.2)](https://tailwindui.com/documentation)
- [Scribe (v4.21)] (https://scribe.knuckles.wtf/laravel/)

## Table of Contents

- [About](#about)
- [Requirements](#requirements)
- [Installing](#installation)
- [Usage](#how-to-use)
- [Credits](#credits)
- [Contributing](#contributing)
- [License](#license)

## Requirements

- Docker (https://www.docker.com/)
- PhpStorm or similar IDE (https://www.jetbrains.com/toolbox-app/)
- Ubuntu or similar Linux OS (https://ubuntu.com/)

## Installation

Windows 10/11
- cd /mnt/c/Users/YOUR_USER_ID/Source/Respos/SaaS
- curl -s https://laravel.build/SaaS-POR-Pt2?with=mariadb,redis,memcached,meilisearch,selenium,minio,mailhog | bash
- cd SaaS-POR-Pt2
- sail up
- sail composer require laravel/breeze
- sail artisan breeze:install
- sail npm install
- sail npm run dev

## How to use

Project documentation (http://localhost/docs#introduction)
- User API URL http://localhost/api/users
- Publisher API URL http://localhost/api/publishers
- Genre API URL http://localhost/api/genres

## Credits

Adrian Gould (https://github.com/AdyGCode/ICT50120-SaaS-Library)
Adrian Gould (https://blackboard.northmetrotafe.wa.edu.au/webapps/collab-ultra/tool/collabultra?course_id=_28977_1&mode=view)
Adrian Gould (https://www.diigo.com/profile/ady_gould)

### Contributing

Contributors to this project are:
- Arian Gould(Lecturer, North Metropolitan TAFE, Perth, WA, AU)
- Low, Kok Wei, 20103560@tafe.wa.edu.au

## License
MIT License
