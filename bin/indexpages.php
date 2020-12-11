<?php
declare(strict_types=1);

require 'vendor/autoload.php';

use App\Command\IndexPages;

(new IndexPages())->execute();
