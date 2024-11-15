[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![GitHub release](https://img.shields.io/github/release/ralphmoran/aeros-app.svg)](https://github.com/ralphmoran/aeros-app/releases)
[![GitHub tag](https://img.shields.io/github/tag/ralphmoran/aeros-app.svg)](https://github.com/ralphmoran/aeros-app/tags)
[![GitHub downloads](https://img.shields.io/github/downloads/ralphmoran/aeros-app/total.svg)](https://github.com/ralphmoran/aeros-app/releases)
[![GitHub language count](https://img.shields.io/github/languages/count/ralphmoran/aeros-app.svg)](https://github.com/ralphmoran/aeros-app)
[![GitHub stars](https://img.shields.io/github/stars/ralphmoran/aeros-app.svg?style=social)](https://github.com/ralphmoran/aeros-app/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/ralphmoran/aeros-app.svg?style=social)](https://github.com/ralphmoran/aeros-app/network/members)

# Aeros Blueprint for Aeros framework

Working on it

# Setup

- Run `vagrant up`. If required, authorize NFS configuration
- Add .env file and update database section
- SSH to VM: `vagrant ssh`
- CD into `cd /var/www/html` then
- Run `composer install`
- Run `composer cc && composer dump -o`
- Run next command from within working directory `php aeros run:app`
