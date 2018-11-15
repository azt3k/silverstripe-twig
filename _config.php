<?php

use Azt3k\SS\Twig\TwigContainer;

// If haml is available allow it to be used
if (class_exists('HamlSilverStripeContainer')) {

    TwigContainer::addExtension('twig', function ($twig, $c) {
        $twig->addExtension(new MtHaml\Support\Twig\Extension);

        return $twig;
    });

    TwigContainer::addExtension('twig.loader', function ($loader, $c) {
        return new MtHaml\Support\Twig\Loader($c['haml.env'], $loader);
    });

    TwigContainer::addShared('haml.env', function ($c) {
        return $c['haml.dic']['environment'];
    });

    TwigContainer::extendConfig(array(
        'haml.dic' => function () {
            return new HamlSilverStripeContainer(array(
                'environment.type' => 'twig'
            ));
        },
        'twig.extensions' => array(
            '.haml',
            '.twig'
        )
    ));
}
