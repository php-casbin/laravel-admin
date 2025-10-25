<?php

use Faker\Factory as FakerFactory;
use Illuminate\Support\Collection;

class TestFactoryBuilder
{
    private $class;
    private $count;
    private $definitions;
    private $faker;

    public function __construct($class, $count, $definitions, $faker)
    {
        $this->class = $class;
        $this->count = max(1, (int) $count);
        $this->definitions = $definitions;
        $this->faker = $faker;
    }

    protected function buildAttributes()
    {
        if (!isset($this->definitions[$this->class])) {
            return [];
        }

        $def = $this->definitions[$this->class];
        return is_callable($def) ? $def($this->faker) : (array) $def;
    }

    protected function makeOne()
    {
        $attributes = $this->buildAttributes();
        $model = new $this->class();

        foreach ($attributes as $key => $val) {
            $model->setAttribute($key, $val);
        }

        return $model;
    }

    public function make()
    {
        if ($this->count > 1) {
            $items = [];
            for ($i = 0; $i < $this->count; $i++) {
                $items[] = $this->makeOne();
            }
            return new Collection($items);
        }

        return $this->makeOne();
    }

    public function create()
    {
        $made = $this->make();
        if ($made instanceof Collection) {
            $made->each(function ($m) {
                $m->save();
            });
            return $made;
        }

        $made->save();
        return $made;
    }

    public function raw()
    {
        if ($this->count > 1) {
            $items = [];
            for ($i = 0; $i < $this->count; $i++) {
                $items[] = $this->buildAttributes();
            }
            return new Collection($items);
        }
        return $this->buildAttributes();
    }
}

function factory($class, $count = 1)
{
    static $faker = null;
    static $definitions = null;

    if ($faker === null) {
        $faker = FakerFactory::create();
    }

    if ($definitions === null) {
        $definitions = [
            Tests\Models\User::class => function ($faker) {
                return [
                    'username' => $faker->userName,
                    'email'    => $faker->email,
                    'mobile'   => $faker->phoneNumber,
                    'avatar'   => $faker->imageUrl(),
                    'password' => '$2y$10$U2WSLymU6eKJclK06glaF.Gj3Sw/ieDE3n7mJYjKEgDh4nzUiSESO',
                ];
            },
            Tests\Models\Profile::class => function ($faker) {
                return [
                    'first_name' => $faker->firstName,
                    'last_name'  => $faker->lastName,
                    'postcode'   => $faker->postcode,
                    'address'    => $faker->address,
                    'latitude'   => $faker->latitude,
                    'longitude'  => $faker->longitude,
                    'color'      => $faker->hexColor,
                    'start_at'   => $faker->dateTime,
                    'end_at'     => $faker->dateTime,
                ];
            },
            Tests\Models\Tag::class => function ($faker) {
                return [
                    'name' => $faker->word,
                ];
            },
        ];
    }

    return new TestFactoryBuilder($class, $count, $definitions, $faker);
}
