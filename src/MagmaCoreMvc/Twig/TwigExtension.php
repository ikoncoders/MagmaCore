<?php

declare(strict_types=1);

namespace Ikonc\MagmaCoreMvc\Twig;


use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class TwigExtension extends AbstractExtension implements GlobalsInterface
{

    public function getGlobals(): array
    {
        return [

        ];
    }
}