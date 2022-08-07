<?php

namespace App\Interfaces;

interface INewsInterface
{
    public function getAll();

    public function get($id);
}
