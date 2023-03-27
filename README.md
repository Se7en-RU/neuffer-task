# Neuffer task

### Description

It is a small php-script, which should be started in console.

As result of the command execution should be csv file with three columns: first number, second number, and result. In CSV-file should be written **ONLY** numbers greater than null. If result less than null - it should be written in logs.


### Installation

```bash
docker-compose build
docker-compose run php composer install
```

### Using
```bash
docker-compose run php php console.php --action {action}  --file {file}
```

`{file}` - csv-source file with numbers, where each row contains two numbers between -100 and 100, and

`{action}` - what action should we do with numbers from `{file}`, and can take next values:

* <b>plus</b> - to count summ of the numbers on each row in the {file}
* <b>minus</b> - to count difference between first number in the row and second
* <b>multiply</b> - to multiply the numbers on each row in the {file}
* <b>division</b> - to divide  first number in the row and second

### Tools

#### PHPUnit
```bash
docker-compose run php php vendor/bin/phpunit tests
```

#### PHPStan
```bash
docker-compose run php php vendor/bin/phpstan analyse src tests --level 5
```

#### PHP CS fixer
```bash
docker-compose run php php vendor/bin/php-cs-fixer fix src
```

### Todo list

- More tests
- Better app structure
