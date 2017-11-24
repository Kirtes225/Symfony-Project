<?php
/**
 * Created by PhpStorm.
 * User: Tomek
 * Date: 01.11.2017
 * Time: 19:10
 */

namespace AppBundle\Controller;

use AppBundle\Entity\MovieCategory;
use AppBundle\Entity\MovieCharacteristic;
use AppBundle\Form\MovieCharacteristicType;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MovieController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function adminAction()
    {
        return $this->render('movie/admin.html.twig');
    }

    /**
     * @Route("/list", name="movieList")
     */
    public function listAction()
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:MovieCharacteristic')->findAll();

        //dump($posts);

        return $this->render('default/kategorie.html.twig', [
            'posts' => $posts
        ]);
    }


    /**
     * @Route("/admin/create", name="createMovie")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $movie = new MovieCharacteristic();
        $form = $this->createFormBuilder($movie)
            ->add('title', TextType::class, [
                'label' => "Tytuł filmu",
            ])
            ->add('isNew', ChoiceType::class, [
                'label' => 'Czy jest to nowy film?',
                'choices'  => array(
                    'Tak' => true,
                    'Nie' => false
                )
            ])
            ->add('category', EntityType::class, [
                'label' => "Gatunek filmu",
                'class' => MovieCategory::class,
                'choice_label' => 'category_name',
            ])
            ->add('storyline', TextareaType::class, [
                'label' => "Krótki opis filmu"
            ])
            ->add('create', SubmitType::class, [
                'label' => "Dodaj do bazy"
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();

            $this->addFlash('success', 'Dodano film do bazy danych');

            return $this->redirectToRoute('admin');
        }

        return $this->render('movie/createMovie.html.twig', [
            'createMovie_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/update", name="updateMovieList")
     */
    public function updateListAction()
    {
        $movieList = $this->getDoctrine()->getRepository('AppBundle:MovieCharacteristic')->findAll();

        //dump($posts);

        return $this->render('movie/editMovieList.html.twig', [
            'movieList' => $movieList
        ]);
    }

    /**
     * @Route("/admin/update/{id}", name="updateMovie")
     * @param Request $request
     * @param MovieCharacteristic $movie
     *  @return \Symfony\Component\HttpFoundation\Response
     * @internal param $id
     * @internal param $text
     */
    public function updateAction(Request $request, MovieCharacteristic $movie)
    {
        $form = $this->createFormBuilder($movie)
            ->add('title', TextType::class, [
                'label' => "Tytuł filmu",
            ])
            ->add('isNew', ChoiceType::class, [
                'label' => 'Czy jest to nowy film?',
                'choices'  => array(
                    'Tak' => true,
                    'Nie' => false
                )
            ])
            ->add('category', EntityType::class, [
                'label' => "Gatunek filmu",
                'class' => MovieCategory::class,
                'choice_label' => 'category_name',
            ])
            ->add('storyline', TextareaType::class, [
                'label' => "Krótki opis filmu"
            ])
            ->add('create', SubmitType::class, [
                'label' => "Edytuj film [zapis do bazy]"
            ])
            ->getForm();

        // only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $movie = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();
            $this->addFlash('success', 'Dane filmu zaktualizowane');
            return $this->redirectToRoute('admin');
        }
        return $this->render('movie/editMovie.html.twig', [
            'editMovie_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/delete", name="deleteMovieList")
     */
    public function deleteListAction()
    {
        $movieList = $this->getDoctrine()->getRepository('AppBundle:MovieCharacteristic')->findAll();

        return $this->render('movie/deleteMovieList.html.twig', [
            'movieList' => $movieList
        ]);
    }

    /**
     * @Route("/admin/delete/{id}", name="deleteMovie")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteMovieAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('AppBundle:MovieCharacteristic')->find($id);

        if (!$post) {
            return $this->redirectToRoute('deleteMovieList');
        }

        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('deleteMovieList');
    }

}