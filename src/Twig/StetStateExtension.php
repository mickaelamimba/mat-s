<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class StetStateExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('formatData', [$this, 'setData']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('setData', [$this, 'setData']),
        ];
    }

    public function setData($value): void
    {
        switch($value){
            case 'STOCK':
                echo "En stock";
                break;
            case 'READY':
                echo "Affecté";
                break;
            case 'BEINGDESTROY':
                echo "À détruire";
                break;
            case 'UNLOCK':
                echo "Débloqué";
                break;
            case 'TOBLOCK':
                echo "Bloqué";
                break;
            case 'UNUSABLE':
                echo "Inutilisable";
                break;
        }

    }
}
