<?php

/*
 * This file is part of HTMLPurifier Bundle.
 * (c) 2012 Maxime Dizerens
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
	'encoding' => 'UTF-8',
	'finalize' => true,
	'preload'  => false,
	'settings' => [
		'default' => [
			'HTML.Doctype'				=> 'XHTML 1.0 Strict',
			'HTML.Allowed'				=> 'div,b,strong,i,em,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',
			'CSS.AllowedProperties'		=> 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
			'AutoFormat.AutoParagraph'	=> true,
			'AutoFormat.RemoveEmpty'	=> true,
			'Cache.SerializerPath'		=> storage_path().'/purifier',
		],
		'markdown' => [
			'HTML.Doctype'				=> 'XHTML 1.0 Strict',
			'HTML.Allowed'				=> 'div,b,strong,i,em,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src],*[style|class],pre,code,h1,h2,h3,h4,h5,h6,blockquote',
			'CSS.AllowedProperties'		=> 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
			'AutoFormat.AutoParagraph'	=> true,
			'AutoFormat.RemoveEmpty'	=> true,
			'Cache.SerializerPath'		=> storage_path().'/purifier',
			'URI.AllowedSchemes'		=> ['http', 'https', 'steam'],
		],
		'shout' => [
			'HTML.Doctype'				=> 'XHTML 1.0 Strict',
			'HTML.Allowed'				=> 'b,strong,i,em,a[href|title]',
			'CSS.AllowedProperties'		=> '',
			'AutoFormat.AutoParagraph'	=> false,
			'AutoFormat.RemoveEmpty'	=> true,
			'AutoFormat.Linkify'		=> true,
			'Cache.SerializerPath'		=> storage_path().'/purifier',
			'URI.AllowedSchemes'		=> ['http', 'https', 'steam'],
		],
		'feedbackpreview' => [
			'HTML.Doctype'				=> 'XHTML 1.0 Strict',
			'HTML.Allowed'				=> 'b,strong,i,em',
			'CSS.AllowedProperties'		=> '',
			'AutoFormat.AutoParagraph'	=> false,
			'AutoFormat.RemoveEmpty'	=> true,
			'AutoFormat.Linkify'		=> false,
			'Cache.SerializerPath'		=> storage_path().'/purifier',
			'URI.AllowedSchemes'		=> ['http', 'https', 'steam'],
			],
	],
];
