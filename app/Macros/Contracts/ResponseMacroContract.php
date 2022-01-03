<?php

namespace App\Macros\Contracts;

interface ResponseMacroContract
{
    /**
     * Run macro.
     * 
     * @param ResponseFactory $factory
     * @return void
     */
    public function run($factory);
}