<?php

namespace CommonPlatform\Context\App\Domain\Service;

class TitleSlugService
{
    private string $title;
    private ?string $slug = null;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getSlug(): string
    {
        if ($this->slug) {
            return $this->slug;
        }

        $this->slug = $this->createSlugFromTitle();

        return $this->slug;
    }

    public function getSlugWithRandomHash(): string
    {
        return $this->getSlug() . '-' . $this->getHash();
    }

    private function createSlugFromTitle(): string
    {
        $tmpSlug = str_replace(' ', '-', strtolower($this->title));
        $search = ['á','é','í','ó','ú','à','è','ì','ò','ù','ä','ë','ï','ö','ü','â','ê','î','ô','û'];
        $replace = ['a','e','i','o','u','a','e','i','o','u','a','e','i','o','u','a','e','i','o','u'];
        $tmpSlug = str_replace($search, $replace, $tmpSlug);
        $tmpSlug = str_replace('&', 'and', $tmpSlug);

        $slug = '';
        for ($i = 0 ; $i < strlen($tmpSlug) ; $i++) {
            $char = substr($tmpSlug, $i, 1);
            if (ord($char) == 45 || (ord($char) >= 48 && ord($char) <= 57)) {
                $slug .= substr($tmpSlug, $i, 1);
            }
            if ((ord($char) >= 65 && ord($char) <= 90) || (ord($char) >= 97 && ord($char) <= 122)) {
                $slug .= substr($tmpSlug, $i, 1);
            }
        }

        return $slug;
    }

    private function getHash(): string
    {
        $data = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $hash = '';

        do {
            $hash .= $data[rand(0, strlen($data) -1)];
        } while (strlen($hash) < 5);

        return $hash;
    }
}

