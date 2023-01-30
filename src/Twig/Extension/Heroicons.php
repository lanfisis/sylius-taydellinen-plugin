<?php

/*
 * This file is part of Medisafe corporate website.
 *
 * (c) Medisafe <sylius+medisafe@monsieurbiz.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MonsieurBiz\SyliusTaydellinenPlugin\Twig\Extension;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class Heroicons extends AbstractExtension
{
    private const OUTLINE_TYPE = 'outline';
    private const SOLID_TYPE = 'solid';

    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('heroicons', [$this, 'getIcon'], ['is_safe' => ['html']]),
        ];
    }

    public function getIcon(string $name, int $size, string $type = self::OUTLINE_TYPE): string
    {
        $type = $type === self::OUTLINE_TYPE ? self::OUTLINE_TYPE : self::SOLID_TYPE;
        $path = '@MonsieurBizSyliusTaydellinenPlugin/Icons/Heroicons/' . $type .'/' . $name . '.svg.twig';
        try {
            return $this->twig->render($path, ['size' => $size]);
        } catch (LoaderError $e) {
            return '';
        }
    }
}
