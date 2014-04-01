# Database migration and seeder for Kohana's Minion task runner.

---

- [Introduction](#introduction)
- [Creating Migrations](#creating-migrations)
- [Running Migrations](#running-migrations)
- [Rolling Back Migrations](#rollback)
- [Database Seeding](#database-seeding)

<a name="introduction"></a>
## Introduction

The Minion Database module provides a database agnostic way of modifying the database schema and staying up to date on the current schema state.

<a name="creating-migrations"></a>
## Creating Migrations

To create a migration, you may use the `migration:make` task on the Minion CLI:

    minion migration:make --group=foo

The migration will be placed in the `application/database/migrations/foo` directory, and the file name will be a timestamp.

You may also specify a `--description` option when creating a migration to provide context. The description will be appended to the migration filename and included in the migration class comment.

	minion migration:make --group=foo --description="Creating foo table"

<a name="running-migrations"></a>
## Running Migrations

Running all required migrations:

	minion db:migrate

Running all required migrations for a specific group:

    minion db:migrate --group=foo

Running all required migrations for a multiple groups:

    minion db:migrate --group=foo,bar

Running a specific migration:

    minion db:migrate --to=20140327143111

Running the next `n` migrations:

    minion db:migrate --to=+3

<a name="rollback"></a>
## Rolling Back Migrations

Rolling back the last migration:

    minion db:migrate --to=-1

Rolling back to a specific migration:

    minion db:migrate --to=20140327143111

Rolling back the last `n` migrations:

    minion db:migrate --to=-3

<a name="database-seeding"></a>
## Database Seeding

This module also includes a simple way to seed your database with test data using seed classes. All seed classes are stored in `application/database/seeds`. Seed classes are split into groups just like migrations and may have any name you wish, but probably should follow some sensible convention, such as UserTableSeeder, etc. A DatabaseSeeder class is required for each group and it's from this class that you may use the call method to run other seed classes, allowing you to control the seeding order.

To seed your database, you may use the db:seed command on the Artisan CLI:

	minion db:seed

You may also specify a single group or multiple groups to seed:

    minion db:seed --group=foo
    minion db:seed --group=foo,bar