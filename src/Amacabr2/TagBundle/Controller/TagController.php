<?php

namespace Amacabr2\TagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class TagController extends Controller {

    /**
     * Va générer du json pour envoyer les tags existant
     * @Route("/tags.json", name="tag.index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request) {
        $tagRepository = $this->getDoctrine()->getRepository('TagBundle:Tag');
        if ($q = $request->get('q')) {
            $tags = $tagRepository->search($q);
        } else {
            $tags = $tagRepository->findAll();
        }

        return $this->json($tags, 200, [], ['groups' => ['public']]);
    }

}
