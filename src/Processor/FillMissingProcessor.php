<?php

/*
 * This file is part of the BibTex Parser.
 *
 * (c) Renan de Lima Barbosa <renandelima@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RenanBr\BibTexParser\Processor;

class FillMissingProcessor
{
    use TagCoverageTrait;

    protected $missingFields;

    public function __construct($missingFields)
    {
        $this->missingFields = $missingFields;

        $this->setTagCoverage(['author', 'editor']);
    }

    public function __invoke(array $entry)
    {
        foreach ($this->missingFields as $tag => $value) {
            if(!array_key_exists($tag, $entry)) {
                $entry[$tag] = $value;
            }
        }

        return $entry;
    }
}
