<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */

    public function indexAction()
    {
        /*$kategorie = [
            'katastroficzny',
            'przygodowy',
            'dokumentalny',
            'sci-fi',
            'akcji'

        ];*/

        return $this->render('default/index.html.twig', [
            //'kategorie' => $kategorie
        ]);
    }

    /**
     * @Route("/katastroficzny", name="katastroficzny")
     */
    public function katastroficznyAction(){
        $filmy = [
            '2012',
            'Pojutrze',
            'Armageddon',
            'Niemożliwe'
        ];
        return $this->render('default/kategorie.html.twig', [
            'filmy' => $filmy
        ]);
    }


    /**
     * @Route("/przygodowy", name="przygodowy")
     */
    public function przygodowyAction(){
        $filmy = [
            'Blade Runner 2049',
            'Zwierzogród',
            'Gwiezdne wojny: Część V - Imperium kontratakuje',
            'Gwiezdne wojny: Część VI - Powrót Jedi'
        ];
        return $this->render('default/kategorie.html.twig', [
            'filmy' => $filmy
        ]);
    }

    /**
     * @Route("/biograficzny", name="biograficzny")
     */
    public function biograficznyAction(){
        $filmy = [
            'Senna',
            'Pianista',
            'Upadek',
            'Bogowie'
        ];
        return $this->render('default/kategorie.html.twig', [
            'filmy' => $filmy
        ]);
    }

    /**
     * @Route("/sci-fi", name="sci-fi")
     */
    public function SciFiAction(){
        $filmy = [
            'Matrix',
            'Interstellar',
            'Incepcja',
            'Avatar'
        ];
        return $this->render('default/kategorie.html.twig', [
            'filmy' => $filmy
        ]);
    }

    /**
     * @Route("/akcji", name="akcji")
     */
    public function akcjiAction(){
        $filmy = [
            'Termintor',
            'Thor: Ragnarok',
            'Taxi',
            'Leon zawodowiec'
        ];
        return $this->render('default/kategorie.html.twig', [
            'filmy' => $filmy
        ]);
    }
}
