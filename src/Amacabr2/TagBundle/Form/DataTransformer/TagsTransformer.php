<?php

namespace Amacabr2\TagBundle\Form\DataTransformer;


use Amacabr2\TagBundle\Entity\Tag;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class TagsTransformer implements DataTransformerInterface {

    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * TagsTransformer constructor.
     * @param ObjectManager $em
     */
    function __construct(ObjectManager $em) {
        $this->em = $em;
    }

    public function transform($value): String {
        return implode(',', $value);
    }

    public function reverseTransform($value): array {
        $names = array_unique(array_filter(array_map('trim', explode(',', $value))));
        $tags = $this->em->getRepository('TagBundle:Tag')->findByName($names);
        $newNames = array_diff($names, $tags);
        foreach ($newNames as $name) {
            $tag = new Tag();
            $tag->setName($name);
            $tags[] = $tag;
        }
        return $tags;
    }

}