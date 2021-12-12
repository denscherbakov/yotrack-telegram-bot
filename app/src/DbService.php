<?php

namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Container\Container;
use Illuminate\Database\Schema\Builder;
use Illuminate\Events\Dispatcher;

class DbService
{
    public Capsule $capsule;
    public Builder $schema;

    public function connect()
    {
        $this->capsule = new Capsule();

        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'database',
            'username' => 'root',
            'password' => 'password',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);

        $this->capsule->setEventDispatcher(new Dispatcher(new Container));
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();

        $this->schema = $this->capsule->schema();
    }
}