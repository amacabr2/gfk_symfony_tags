<?php

namespace Amacabr2\TagBundle\Concern;

trait Taggable {

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Amacabr2\TagBundle\Entity\Tag", cascade={"persist"})
     */
    private $tags;

    /**
     * Add tag
     *
     * @param \Amacabr2\TagBundle\Entity\Tag $tag
     *
     * @return Post
     */
    public function addTag(\Amacabr2\TagBundle\Entity\Tag $tag) {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Amacabr2\TagBundle\Entity\Tag $tag
     */
    public function removeTag(\Amacabr2\TagBundle\Entity\Tag $tag) {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags() {
        return $this->tags;
    }

}