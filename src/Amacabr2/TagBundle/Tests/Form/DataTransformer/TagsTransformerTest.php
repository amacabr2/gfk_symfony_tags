<?php

namespace Amacabr2\TagBundle\Tests\Form\DataTransformer;

use Amacabr2\TagBundle\Entity\Tag;
use Amacabr2\TagBundle\Form\DataTransformer\TagsTransformer;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use PHPUnit\Framework\TestCase;

class TagsTransformerTest extends TestCase {


    /**
     * Test si les tags sont bien crées
     */
    public function testCreateTagsArrayFromString() {
        $tags = $this->getMockedTransformer()->reverseTransform('Hello, Demo');
        $this->assertCount(2, $tags);
        $this->assertSame('Demo', $tags[1]->getName());
    }

    /**
     * Test si un tag crée et bien réutilisé et donc qu'on en recrée pas un autre
     */
    public function testUseAllreadyDefinedTag() {
        $tag = new Tag();
        $tag->setName('Chat');
        $tags = $this->getMockedTransformer([$tag])->reverseTransform('Chat, Chien');
        $this->assertCount(2, $tags);
        $this->assertSame($tag, $tags[0]);
    }

    /**
     * Test si les tags vides sont enlevés
     */
    public function testRemoveEmptyTags() {
        $tags = $this->getMockedTransformer()->reverseTransform('Hello,, Demo, , ,');
        $this->assertCount(2, $tags);
        $this->assertSame('Demo', $tags[1]->getName());
    }


    /**
     * Test si les tags dupliqués ne sont pas ajoutés en base de données
     */
    public function testRemoveDuplicateTags() {
        $tags = $this->getMockedTransformer()->reverseTransform('Demo,, Demo, , ,');
        $this->assertCount(1, $tags);
        $this->assertSame('Demo', $tags[1]->getName());
    }

    private function getMockedTransformer($result = []) {

        $tagRepository = $this->getMockBuilder(EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $tagRepository->expects($this->any())
            ->method('findBy')
            ->will($this->returnValue([]));

        $entityManager = $this->getMockBuilder(ObjectManager::class)
            ->disableOriginalConstructor()
            ->getMock();
        $entityManager->expects($this->any())
            ->method('getRepository')
            ->will($this->returnValue($tagRepository));

        return new TagsTransformer($entityManager);

    }

}