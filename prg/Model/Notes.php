<?php

declare(strict_types=1);

namespace Dto\Model;

use Dto\Controller\Request;
use Dto\Database\DBquery;

class Notes
{
    /*
    private array $configuration;
    private Request $request;
    private DBquery $dbquery;
    */

    public function __construct(array $configuration, Request $request, DBquery $dbquery)
    {
        $this->configuration = $configuration;
        $this->request = $request;
        $this->dbquery = $dbquery;
    }
}

