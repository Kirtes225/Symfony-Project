<?php
/**
 * Created by PhpStorm.
 * User: Tomek
 * Date: 25.11.2017
 * Time: 09:51
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
use Symfony\Component\Form\Form;

class CategoryController extends Controller
{
    /**
     * @Route("/admin/create-category", name="createCategory")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createCategoryAction(Request $request)
    {
        $movie = new MovieCategory();
        $form = $this->createFormBuilder($movie)
            ->add('category_name', TextType::class, [
                'label' => "Nazwa kategorii"
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

            $this->addFlash('success', 'Dodano nową kategorię do bazy danych');

            return $this->redirectToRoute('admin');
        }

        return $this->render('movie/createMovie.html.twig', [
            'createMovie_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/update-category-list", name="updateCategoryList")
     */
    public function updateCategoryListAction()
    {
        $movieList = $this->getDoctrine()->getRepository('AppBundle:MovieCategory')->findAll();

        //dump($posts);

        return $this->render('movie/editCategoryList.html.twig', [
            'movieList' => $movieList
        ]);
    }

    /**
     * @Route("/admin/update-category/{id}", name="updateCategory")
     * @param Request $request
     * @param MovieCategory $movie
     *  @return \Symfony\Component\HttpFoundation\Response
     * @internal param $id
     * @internal param $text
     */
    public function updateCategoryAction(Request $request, MovieCategory $movie)
    {
        $form = $this->createFormBuilder($movie)
            ->add('category_name', TextType::class, [
                'label' => "Nazwa kategorii",
            ])
            ->add('create', SubmitType::class, [
                'label' => "Edytuj nazwę kategorii [zapis do bazy]"
            ])
            ->getForm();

        // only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $movie = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();
            $this->addFlash('success', 'Nazwa kategorii zaktualizowana');
            return $this->redirectToRoute('admin');
        }
        return $this->render('movie/editMovie.html.twig', [
            'editMovie_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/delete-category-list", name="deleteCategoryList")
     */
    public function deleteCategoryListAction()
    {
        $movieList = $this->getDoctrine()->getRepository('AppBundle:MovieCategory')->findAll();

        return $this->render('movie/deleteCategoryList.html.twig', [
            'movieList' => $movieList
        ]);
    }

    /**
     * @Route("/admin/delete-category/{id}", name="deleteCategory")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteCategoryAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('AppBundle:MovieCategory')->find($id);

        if (!$post) {
            return $this->redirectToRoute('deleteCategoryList');
        }

        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('deleteCategoryList');
    }

}