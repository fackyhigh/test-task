<?php

use Phalcon\Mvc\MongoCollection;

class Users extends MongoCollection
{
    public $ownerID = "SuperUser";
    public $name = "Konstantin";
    public $email = "send@to.konstantin";
}

