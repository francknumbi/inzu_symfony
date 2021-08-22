<?php

    namespace App\Controller\Admin;
    
    use App\Entity\Property;
    use App\Form\PropertType;
    use App\Repository\PropertyRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class AdminPropertyController extends AbstractController
    {

        private PropertyRepository $repository;
        private EntityManagerInterface $em;

        public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
        {
            $this->repository = $repository;
            $this->em = $em;
        }

        /**
         * @Route( path="/admin", name="admin.property.index")
         * @return Response
         */

        public function index(): Response
        {
            $repositories = $this->repository->findAll();
            return $this->render('admin/property/index.html.twig',[
                'properties'=>$repositories
            ]);
        }

        /**
         * @Route("/admin/property/create", name="admin.property.new")
         * @param Request $request
         * @return Response
         */
        public function new(Request $request): Response
        {
            $property = new Property();
            $form = $this->createForm(PropertType::class,$property);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->em->persist($property);
                $this->em->flush();

                $this->addFlash('succes', 'Créer avec succès');
                return $this->redirectToRoute('admin.property.index');
            }
            return $this->render('admin/property/new.html.twig',[
                'property'=>$property,
                'form'=> $form->createView()
            ]);
        }

        /**
         * @param Property $property
         * @param Request $request
         * @return Response
         */
        #[Route(path: '/admin/property/{id}', name:"admin.property.edit"  , methods: ['GET','POST'])]
        public function edit(Property $property, Request $request):Response
        {
            $form = $this->createForm(PropertType::class,$property);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->em->flush();
                $this->addFlash('succes', 'Modifié avec succès');
                return $this->redirectToRoute('admin.property.index');
            }

            return $this->render('admin/property/edit.html.twig',[
                'property'=>$property,
                'form'=> $form->createView()
            ]);
        }

        /**
         * @param Property $property
         * @param Request $request
         * @return Response
         */
        #[Route(path: '/admin/property/{id}', name:"admin.property.delete"  , methods: ['DELETE'])]
        public function delete(Property $property, Request $request): Response
        {
            if ($this->isCsrfTokenValid('delete'.$property->getId(),$request->get('_token')))
            {

                $this->addFlash('succes', 'Supprimé avec succès');
                $this->em->remove($property);
                $this->em->flush();

            }
            return $this->redirectToRoute('admin.property.index');

        }

    }
