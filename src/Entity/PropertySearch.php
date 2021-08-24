<?php
namespace App\Entity;


    class PropertySearch
    {
        /**
         * @var null
         */
        private int $maxPrice;
        /**
         * @var null
         */
        private int $minSurface;

        /**
         * @return null
         */
        public function getMaxPrice(): ?int
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
