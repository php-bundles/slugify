<?php

namespace SymfonyBundles\Slugify;

class Slugify
{
    /**
     * @var array
     */
    protected const MAP = [' ' => '-', '_' => '-'];

    /**
     * @var string
     */
    protected const OPTIONS = 'Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();';

    /**
     * @param string $source
     * @param string $postfix
     *
     * @return string
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public static function create(string $source, string $postfix = '.html'): string
    {
        $slug = \transliterator_transliterate(static::OPTIONS, $source);

        if (false === $slug) {
            throw new \InvalidArgumentException(sprintf('Incorrect source string "%s".', $source));
        }

        $slug = \strtr($slug, static::MAP);
        $slug = \preg_replace('#^\-|[^a-z0-9\-]|\-$#', '', $slug);

        if (false === \is_string($slug)) {
            throw new \RuntimeException(sprintf('Can not remove special chars from "%s".', $source));
        }

        $slug = \preg_replace('#(\-+)#', '-', $slug);

        if (false === \is_string($slug)) {
            throw new \RuntimeException(sprintf('Can not remove "-" duplicates "%s".', $source));
        }

        return $slug . $postfix;
    }
}
