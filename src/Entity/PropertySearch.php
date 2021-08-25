<?php
namespace App\Entity;


    use Symfony\Component\Validator\Constraints as Assert;

    class PropertySearch
    {

        /**
         * @var int|null
         */
        private ?int $maxPrice;
        /**
         * @var int|null
         * @Assert\Range(min=10, max=400)
         */
        private ?int $minSurface;


        /**
         * PropertySearch constructor.
         * @param int|null $maxPrice
         * @param int|null $minSurface
         */
        public function __construct()
        {
            $this->maxPrice = null;
            $this->minSurface = null;
        }


        /**
         * @return null|null
         */
        public function getMaxPrice()
        {
            return $this->maxPrice;
        }

        /**
         * @param null $maxPrice
         */
        public function setMaxPrice(int $maxPrice): void
        {
            $this->maxPrice = $maxPrice;
        }

        /**
         * @return null
         */
        public function getMinSurface(): ?int
        {
            return $this->minSurface;
        }

        /**
         * @param null $minSurface
         */
        public function setMinSurface(int $minSurface): void
        {
            $this->minSurface = $minSurface;
        }


    }
