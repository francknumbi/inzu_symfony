<?php
namespace App\Entity;


    use Doctrine\Common\Collections\ArrayCollection;
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

        private ArrayCollection $options;


        /**
         * PropertySearch constructor.
         * @param int|null $maxPrice
         * @param int|null $minSurface
         */
        public function __construct()
        {
            $this->maxPrice = null;
            $this->minSurface = null;
            $this->options = new ArrayCollection();
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

        /**
         * @return ArrayCollection
         */
        public function getOptions(): ArrayCollection
        {
            return $this->options;
        }

        /**
         * @param ArrayCollection $options
         */
        public function setOptions(ArrayCollection $options): void
        {
            $this->options = $options;
        }


    }
