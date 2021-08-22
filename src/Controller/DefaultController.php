<?php
    namespace App\Controller;

    use App\Entity\Property;
    use App\Repository\PropertyRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;


    class DefaultController extends abstractController
    {
        /**
         * @var Property
         */
        private $properties;

        public function __construct()
        {

        }

        /**
         * @Route(path="/index", name="accueil")
         * @param PropertyRepository $repository
         * @return Response
         */
        public function index(PropertyRepository $repository): Response
        {
            $this->properties = $repository->findLatest();
            return $this->render('pages/home.html.twig',[
                'properties'=>$this->properties
            ]);
        }
    }
