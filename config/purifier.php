<?php

return [
    'encoding'         => 'UTF-8',
    'finalize'         => true,
    'ignoreNonStrings' => false,
    'cachePath'        => storage_path('app/purifier'),
    'cacheFileMode'    => 0755,

    'settings' => [

        /*
         * Default profile — used for article body sanitisation.
         *
         * HTML5 elements (figure, figcaption) and non-HTML4 attributes
         * (img[loading]) are NOT natively known by HTMLPurifier.
         * Adding them to HTML.Allowed alone causes "Element X is not
         * supported". They must also be registered in custom_definition
         * below, which is a sibling of this array (not nested inside it).
         */
        'default' => [
            'HTML.Doctype'             => 'HTML 4.01 Transitional',

            'HTML.Allowed' =>
                'h2,h3,h4,' .
                'p,br,hr,' .
                'strong,em,b,i,u,s,sub,sup,' .
                'a[href|title|target|rel],' .
                'ul,ol,li,' .
                'blockquote,pre,code,' .
                'img[src|alt|width|height|loading|class|style],' .
                'figure[class],figcaption,' .
                'table,thead,tbody,tfoot,tr,th[scope|colspan|rowspan],td[colspan|rowspan],' .
                'span[class|style],div[class]',

            'CSS.AllowedProperties'    => 'text-align,float,margin,margin-left,margin-right,width,max-width',
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.RemoveEmpty'   => true,
            'HTML.SafeIframe'          => true,
            'URI.SafeIframeRegexp'     => '%^(https?:)?//(www\.youtube\.com/embed/|player\.vimeo\.com/video/)%',
            'Attr.AllowedFrameTargets' => ['_blank'],
            'Attr.AllowedRel'          => 'noopener noreferrer nofollow',
            'URI.AllowedSchemes'       => ['http' => true, 'https' => true, 'mailto' => true],
        ],

        /*
         * Custom HTML element + attribute definitions.
         * Processed by Purifier::addCustomDefinition() — separate from the
         * HTMLPurifier config directives above.
         *
         * 'debug' => false  = use the file cache (faster in production).
         *                     Set to true temporarily if you need to force
         *                     the definition to rebuild without clearing cache.
         *
         * 'elements' format: [name, type, content_model, attr_collections, attributes]
         * 'attributes' format: [element, attribute, validation]
         */
        'custom_definition' => [
            'id'    => 'hlr-article-body',
            'rev'   => 1,
            'debug' => false,

            'elements' => [
                // HTML5 block — figure can wrap an image + optional caption
                [
                    'figure',
                    'Block',
                    'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow',
                    'Common',
                    [],
                ],
                // HTML5 inline — caption text inside a figure
                [
                    'figcaption',
                    'Inline',
                    'Flow',
                    'Common',
                    [],
                ],
            ],

            'attributes' => [
                // img[loading] is not in HTML 4.01 — register it explicitly
                ['img', 'loading', 'Enum#eager,lazy,auto'],
            ],
        ],

    ],
];
