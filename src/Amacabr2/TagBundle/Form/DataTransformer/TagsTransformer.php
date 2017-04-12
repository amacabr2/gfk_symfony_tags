<?php

namespace Amacabr2\TagBundle\Form\DataTransformer;


use Amacabr2\TagBundle\Entity\Tag;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TagsTransformer implements DataTransformerInterface {

    public function transform($value): String {
        return implode(',', $value);
    }

    public function reverseTransform($value): array {
        $names = explode(',', $value);
        $tags = array();
        foreach ($names as $name) {
            $tag = new Tag();
            $tag->setName($name);
            $tags[] = $tag;
        }
        return $tags;
    }

}