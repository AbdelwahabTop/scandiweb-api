<?php

declare(strict_types=1);

namespace App\Database;
/* the phpstorm does not know that $config->db property exists so we can use doctyping here to make the
autocomplete work so we'll add property read array db  */
/**
 * @property-read ?array $db
 */

class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        /*inside env you can also put configration of apis or anything else
         so here in config array we spicify key db for another array that have db configration instead of
         puting it directliy in config array, so if you want to add any other config related to apis or 
         anything else you can make a new key for it inside config array*/
        $this->config = [
            'db' => [
                'host' => $env['DB_HOST'],
                'user' => $env['DB_USER'],
                'pass' => $env['DB_PASS'],
                'database' => $env['DB_DATABASE'],
                'driver' => $env['DB_DRIVER'] ?? 'mysql',
            ],
        ];
    }

    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}
