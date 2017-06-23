miles
=====

A Symfony project.

# Setup

```bash
vagrant up
vagrant provision
vagrant ssh 
cd /var/www
composer install
```

# Run tests

from `/var/www` folder

```bash
bin/phpunit -c app/

bin/behat --colors
```
