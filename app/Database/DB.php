<?php
/* we need singel database connection and make avialable anywhere needed in the application instead provid 
it inside any file like controller and when you need it in any different file you will dublicate the code 
of pdo connection and you will make many connections with data base */

declare(strict_types=1);

namespace App\Database;

use PDO;

/*If you go to any method used from App::db you will find highlited but still work 
this is highlighting because phpstorm doesn't know that we're practicing these calls to the
pdo class what we can do is that we can simply add a mixin doctype here with the pdo and now this should fix this issue
the @mixin tag to indicate that the class to which it is applied can be treated as if it were an instance of the PDO class.
The @mixin tag is typically used to indicate that a class is implementing or extending another class or has similar functionality, 
allowing IDEs to provide code suggestions and methods from the referenced class.
*/

/**
 * @mixin PDO
 */

class DB
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        $defaultOptions = [
            /*I disabled emulates here to prevent dublicated parameters names so now i can't 
            set same parameters to differents columns when excuting a statmenr 
            also an advantage when disable emulate prepares the ids comback as an inteders instead of strings
            and any columns use integers and floats will get response back as integers and floats and not strings*/
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new PDO(
                $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'],
                $config['user'],
                $config['pass'],
                $config['options'] ?? $defaultOptions
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

    /* in the App class we take an instance from this DB class and this class 
    dosen't return PDO object because pdo is a privete proparty and we don't make it accesable for 
    any thing so this mean the db instance from App class dosen't provide any method from PDO object like prepare and excecute 
    and we can solve this by extending PDO class in DB class so everu method in PDO now providede because DB have all methods in 
    PDO class now or we can make getter method to get this pdo private property but we will choose __call() solution
    what's happening here is that when we call a method on the db object that does
    not exist it's going to trigger this magic call method and because this
    method doesn't exist on this class we're going to proxy that call to the pdo object and
    execute it on that pdo object passing along the arguments 
    */
    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }
}
