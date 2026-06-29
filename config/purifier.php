<?php

return [
    'encoding'          => 'UTF-8',
    'finalize'          => true,
    'ignoreNonStrings'  => false,
    'cachePath'         => storage_path('app/purifier'),
    'cacheFileMode'     => 0755,

    'settings' => [
        'default' => [
            'HTML.Doctype'             => 'HTML 4.01 Transitional',
            'HTML.Allowed'             =>
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
    ],
];
