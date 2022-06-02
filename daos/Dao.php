<?php

class Dao
{
    public function db()
    {
        return Manager::getInstance()->db();
    }
}