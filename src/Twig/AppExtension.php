<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [

            new TwigFilter('nombre', [$this, 'getLength']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            //new TwigFunction('function_name', [$this, 'doSomething']),
        ];
    }

    public function getLength(array $tableau)
    {
        return count($tableau);
    }
}

// function reading_time( $content ) {

// 	// Predefined words-per-minute rate.
// 	$words_per_minute = 225;
// 	$words_per_second = $words_per_minute / 60;

// 	// Count the words in the content.
// 	$word_count = str_word_count( strip_tags( $content ) );

// 	// [UNUSED] How many minutes?
// 	$minutes = floor( $word_count / $words_per_minute );

// 	// [UNUSED] How many seconds (remainder)?
// 	$seconds_remainder = floor( $word_count % $words_per_minute / $words_per_second );

// 	// How many seconds (total)?
// 	$seconds_total = floor( $word_count / $words_per_second );

// 	return $seconds_total;
// }