<?php
/**
 * @copyright 2015 ortofit_quiz
 * @author Rodion Smakota <rsmakota@gmail.com>
 */

namespace Ortofit\Bundle\SingUpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ortofit\Bundle\SingUpBundle\Entity\Country;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class SingUpController
 * @package Ortofit\Bundle\SingUpBundle\Controller
 */
class SingUpController extends Controller
{
    /**
     * @param string $iso2
     *
     * @return Country
     * @throws \Exception
     */
    private function findCountry($iso2)
    {
        $country = $this->getDoctrine()->getManager()->getRepository(Country::clazz())->findOneBy(['iso2'=>$iso2]);
        if (null == $country) {
            throw new \Exception('Can\'t find country by code ');
        }

        return $country;
    }

    /**
     * @param SessionInterface $session
     */
    private function tokenInit($session)
    {
        if (!$session->has('token')) {
            $session->set('token', md5(time()));
        }
    }


    /**
     * @param Country          $country
     * @param SessionInterface $session
     * @return array
     */
    private function formatData($country, $session)
    {
        return [
            'prefix'  => $country->getPrefix(),
            'pattern' => $country->getPattern(),
            'token'   => $session->get('token'),
            'url'     => $this->generateUrl('ortofit_sing_up_add')
        ];
    }

    /**
     * @param Request $request
     * @param string  $countryIso2
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, $countryIso2)
    {
        $session = $request->getSession();
        $this->tokenInit($session);
        try {
            $country = $this->findCountry($countryIso2);

            return $this->render('OrtofitSingUpBundle:SingUp:index.html.twig', $this->formatData($country, $session));
        } catch (\Exception $e) {

        }

    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function postAction(Request $request)
    {


        return new Response('success');
    }
}