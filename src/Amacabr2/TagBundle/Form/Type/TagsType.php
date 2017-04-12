<?php

namespace Amacabr2\TagBundle\Form\Type;

use Amacabr2\TagBundle\Form\DataTransformer\TagsTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TagsType extends AbstractType {

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

    public function getParent() {
        return TextType::class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->addModelTransformer(new CollectionToArrayTransformer(), true);
        $builder->addModelTransformer(new TagsTransformer($this->em), true);
    }

}