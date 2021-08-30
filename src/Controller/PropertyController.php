<?php

    namespace App\Controller;

    use App\Notification\ContactNotification;
    use App\Entity\Contact;
    use App\Entity\Property;
    use App\Entity\PropertySearch;
    use App\Form\ContactType;
    use App\Form\PropertySearchType;
    use App\Repository\PropertyRepository;
    use Doctrine\ORM\EntityManagerInterface;
    use Doctrine\Persistence\ObjectManager;
    use Knp\Component\Pager\PaginatorInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;



    class PropertyController extends abstractController
    {
        /**
         * @var PropertyRepository
         */
        private $repository;
        /**
         * @var EntityManagerInterface
         */
        private $entityManager;
        /**
         * @var Property
         */
        private $property;

        public function __construct(PropertyRepository $propertyRepository, EntityManagerInterface $em)
        {
            $this->repository = $propertyRepository;
            $this->entityManager = $em;
            $this->property=null;
        }

        /**
         * @Route(path="/biens", name="property.index")
         * @return Response
         */
        public function index(PaginatorInterface $paginator, Request $request ):Response
        {
            $search = new PropertySearch();
            $form= $this->createForm(PropertySearchType::class, $search);
            $form->handleRequest($request);

            $properties =$paginator->paginate(
                $this->repository->findAllVisibleQuery($search),
                $request->query->getInt('page',1),
                12
            );

            return $this->render('property/index.html.twig',[
                'current_menu'=>'properties',
                'properties'=> $properties,
                'form'=>$form->createView()
            ]);
        }

        /**
         * @Route(path="/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
         * @return Response
         */

        //public function show($slug, $id): Response
        public function show(Property $property, $slug, Request $request,ContactNotification $notification): Response
        {

            if ($property->getSlug() !== $slug){
                return $this->redirectToRoute('property.show', [
                   'id'=>$property->getId(),
                   'slug'=>$property->getSlug()

                ], 301);
            }
            $contact = new Contact();
            $contact->setProperty($property);
            $form = $this->createForm(ContactType::class,$contact);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid())
            {
                $notification->notify($contact);
                $this->addFlash('success', 'votre email a bien ete envoye');
                /*return $this->redirectToRoute('property.show',[
                   'id'=>$property->getId(),
                   'slug'=>$property->getSlug(),
                    301
                ]);*/
            }

            return $this->render('property/show.html.twig',[
                'property'=> $property,
                'current_menu'=>'properties',
                'form'=>$form->createView()
            ]);
        }

    }
