<?php

namespace App\Tests\AtomicDesign\Components;

class ButtonComponent extends \QuentinMachard\Bundle\AtomicDesignBundle\Model\Component
{

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'Atoms|Button';
    }

    /**
     * @inheritDoc
     */
    public function getStories(): array
    {
        return [
            'Default' => 'default', // This will call `$this->default()` method.
            'Colors' => 'colors',   // This will call `$this->colors()` method.
        ];
    }
    /**
     * A simple story.
     *
     * @return string
     */
    public function default(): string
    {
        return $this->render('components/atoms/button/button.html.twig', [
            'props' => [
                'label' => 'My awesome button',
            ]
        ]);
    }

    /**
     * A full example story.
     *
     * @return string
     */
    public function colors(): string
    {
        $colors = ['primary', 'secondary'];

        $buttons = [];

        foreach ($colors as $color) {
            $buttons[] = $this->render('components/atoms/button/button.html.twig', [
                'props' => [
                    'label' => ucfirst($color),
                    'class_modifiers' => [$color]
                ]
            ]);
        }

        return join(' ', $buttons);
    }
}