<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MovieCharacteristic;
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
        return $this->render('default/index.html.twig', [
        ]);
    }

    /**
     * @Route("/film/{nazwa}", name="film")
     * @param $nazwa
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function filmAction($nazwa)
    {
        $movie = $this->getDoctrine()->getRepository(MovieCharacteristic::class)->findOneBy([
            'title' => $nazwa
        ]);
        $title = $movie->getTitle();
        $genre = $movie->getCategory();
        $storyline = $movie->getStoryline();

        dump($title, $genre, $storyline);

        return $this->render('default/movie.html.twig', [
            'title' => $title,
            'genre' => $genre,
            'storyline' => $storyline
        ]);
    }

    /**
     * @Route("/akcja", name="categoryAkcja")
     */
    public function akcjaAction()
    {
        $filmGenre = "filmy akcji";
        $movieList = $this->getDoctrine()
            ->getRepository('AppBundle:MovieCharacteristic')
            ->findBy(['category' => 'akcja']
            );

        return $this->render('movie_categories/movieCategoryList.html.twig', [
            'movieList' => $movieList,
            'filmGenre' => $filmGenre
        ]);
    }

    /**
     * @Route("/animowany", name="categoryAnimowany")
     */
    public function animowanyAction()
    {
        $filmGenre = "filmy animowane";
        $movieList = $this->getDoctrine()
            ->getRepository('AppBundle:MovieCharacteristic')
            ->findBy(['category' => 'animowany']
            );

        return $this->render('movie_categories/movieCategoryList.html.twig', [
            'movieList' => $movieList,
            'filmGenre' => $filmGenre
        ]);
    }

    /**
     * @Route("/biograficzny", name="categoryBiograficzny")
     */
    public function biograficznyAction()
    {
        $filmGenre = "filmy biograficzne";
        $movieList = $this->getDoctrine()
            ->getRepository('AppBundle:MovieCharacteristic')
            ->findBy(['category' => 'biograficzny']
            );

        return $this->render('movie_categories/movieCategoryList.html.twig', [
            'movieList' => $movieList,
            'filmGenre' => $filmGenre
        ]);
    }

    /**
     * @Route("/katastroficzny", name="categoryKatastroficzny")
     */
    public function katastroficznyAction()
    {
        $filmGenre = "filmy katastroficzne";
        $movieList = $this->getDoctrine()
            ->getRepository('AppBundle:MovieCharacteristic')
            ->findBy(['category' => 'katastroficzny']
            );

        return $this->render('movie_categories/movieCategoryList.html.twig', [
            'movieList' => $movieList,
            'filmGenre' => $filmGenre
        ]);
    }

    /**
     * @Route("/sci-fi", name="categorySci-Fi")
     */
    public function scifiAction()
    {
        $filmGenre = "filmy science-fiction";
        $movieList = $this->getDoctrine()
            ->getRepository('AppBundle:MovieCharacteristic')
            ->findBy(['category' => 'sci-fi']
            );

        return $this->render('movie_categories/movieCategoryList.html.twig', [
            'movieList' => $movieList,
            'filmGenre' => $filmGenre
        ]);
    }

    /**
     * @Route("/thriller", name="categoryThriller")
     */
    public function thrillerAction()
    {
        $filmGenre = "thrillery";
        $movieList = $this->getDoctrine()
            ->getRepository('AppBundle:MovieCharacteristic')
            ->findBy(['category' => 'thriller']
            );

        return $this->render('movie_categories/movieCategoryList.html.twig', [
            'movieList' => $movieList,
            'filmGenre' => $filmGenre
        ]);
    }

    /**
     * @Route("/wojenny", name="categoryWojenny")
     */
    public function wojennyAction()
    {
        $filmGenre = "filmy wojenne";
        $movieList = $this->getDoctrine()
            ->getRepository('AppBundle:MovieCharacteristic')
            ->findBy(['category' => 'wojenny']
            );

        return $this->render('movie_categories/movieCategoryList.html.twig', [
            'movieList' => $movieList,
            'filmGenre' => $filmGenre
        ]);
    }

    /**
     * @Route("/nowe", name="categoryNowe")
     */
    public function noweAction()
    {
        $movieList = $this->getDoctrine()
            ->getRepository('AppBundle:MovieCharacteristic')
            ->findBy(['isNew' => '1']
            );

        return $this->render('movie_categories/newMovies.html.twig', [
            'movieList' => $movieList
        ]);
    }

}
