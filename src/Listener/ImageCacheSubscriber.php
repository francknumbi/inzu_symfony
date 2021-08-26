<?php

 namespace App\Listener;

 use App\Entity\Property;
 use Doctrine\Common\EventSubscriber;
 use Doctrine\ORM\Event\LifecycleEventArgs;
 use Liip\ImagineBundle\Imagine\Cache\CacheManager;
 use Symfony\Component\HttpFoundation\File\UploadedFile;
 use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

 class ImageCacheSubscriber implements EventSubscriber {
     private CacheManager $cacheManager;
     private UploaderHelper $uploaderHelper;

     public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
     {
         $this->cacheManager = $cacheManager;
         $this->uploaderHelper = $uploaderHelper;
     }

     /**
      * @return CacheManager
      */
     public function getCacheManager(): CacheManager
     {
         return $this->cacheManager;
     }

     /**
      * @param CacheManager $cacheManager
      */
     public function setCacheManager(CacheManager $cacheManager): void
     {
         $this->cacheManager = $cacheManager;
     }

     /**
      * @return UploaderHelper
      */
     public function getUploaderHelper(): UploaderHelper
     {
         return $this->uploaderHelper;
     }

     /**
      * @param UploaderHelper $uploaderHelper
      */
     public function setUploaderHelper(UploaderHelper $uploaderHelper): void
     {
         $this->uploaderHelper = $uploaderHelper;
     }


     public function preRemove(LifecycleEventArgs $args)
     {
         $entity = $args->getEntity();
         if(!$entity instanceof Property)
         {
             return;
         }
         $this->cacheManager->remove($this->uploaderHelper->asset($entity,'imageFile'));

     }
     public function preUpdate(\Doctrine\ORM\Event\PreUpdateEventArgs $args)
     {
         $entity = $args->getEntity();
         if(!$entity instanceof Property)
         {
             return;
         }
        if ($entity->getImageFile() instanceof UploadedFile)
        {
            $this->cacheManager->remove($this->uploaderHelper->asset($entity,'imageFile'));
        }
     }


     public function getSubscribedEvents()
     {
         return [
             'preRemove',
             'preUpdate'
         ];
     }
 }
