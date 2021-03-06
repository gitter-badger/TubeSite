<?php

namespace Siplo\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Siplo\MediaBundle\Form\Type\CountryType;
use Siplo\MediaBundle\Entity\Country;
use Symfony\Component\Validator\Constraints\Count;

class CountryController extends Controller
{

    /**
     * @Route("/")
     *
     */
    public function viewCountryAction()
    {
        $countries = $this->getDoctrine()
            ->getRepository('SiploMediaBundle:Country')->findBy(
                array(),
                array('name' => 'ASC')
            );

        if (!$countries) {
            $this->render('AppBundle::emptycontent.html.twig');
        }
//        $path= $video;//->getVideoFile();//.mozFullPath;

//        $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
//        $path = $helper->asset($countries, 'videoFile');


        //$path = "videos/sample.mp4";
        return $this->render('AppBundle::countries.html.twig',array(
            'countries' => $countries));
    }

    /**
     * @Route("/create/country")
     *
     */
    public function createAction(Request $request)
    {

        $form = $this->createForm(new CountryType(), new Country());
        $form->handleRequest($request);
        if ($form->isValid()) {


            $country = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($country);
            $em->flush();

            return $this->render('SiploMediaBundle::upload_successful.html.twig');

        }

        return $this->render(
            '@SiploMedia/form.html.twig',
            array('form' => $form->createView())
        );

    }
}
