<?php

namespace App\Controller;

use App\Entity\Themes;

use App\Form\AddThemeFormType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

// include __DIR__ . '/../../assets/variable.php';

class ThemeController extends AbstractController
{
    /**
     * @Route("/addTheme", name="add_theme")
     */
    public function AddThemes(Request $request): Response
    {
        $theme = new Themes();
        $form = $this->createForm(AddThemeFormType::class, $theme);
        $form->handleRequest($request);

        $showTheme =  $this->getDoctrine()->getManager()->getRepository(Themes::class)->findBy([], ['name' => 'ASC']);
        
        if ($form->isSubmitted() && $form->isValid()){            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($theme);
            $entityManager->flush();
            // echo $theme;

            return $this->redirectToRoute('add_theme');
        }

        return $this->render('theme/addTheme.html.twig', [
            'addThemeForm' => $form->createView(),
            'showThemes' => $showTheme,
            // 'titreSite' => $_SESSION['titre'],
        ]);
    }

    /**
     * @Route("/updateTheme/{name}", name="update_theme")
     */
    public function UpdateTheme(Themes $themes, Request $request): Response
    {
        $theme = $this->getDoctrine()->getRepository(Themes::class);
        $theme = $theme->find($themes);

        $form = $this->createFormBuilder($theme)
            ->add('name', TextType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $theme = $form->getData();
            $em->flush();

            return $this->redirectToRoute('add_theme');
        }

        return $this->render('theme/updateTheme.html.twig', [
            'addThemeForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("deleteTheme/{name}", name="delete_theme")
     */
    public function DeleteTheme(Themes $theme, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $themeName = $theme->getName();

        $em->remove($theme);
        $em->flush();

        return $this->redirectToRoute('add_theme');
    }
}