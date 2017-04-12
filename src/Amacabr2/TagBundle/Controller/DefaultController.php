<?php

namespace Amacabr2\TagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TagBundle:Default:index.html.twig');
    }
}
