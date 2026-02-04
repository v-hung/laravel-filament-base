<?php

namespace App\Data;

use App\Enums\ShowcaseType;

class ShowcaseSearchParams extends SearchParams
{
    public ?ShowcaseType $type = null;
}
