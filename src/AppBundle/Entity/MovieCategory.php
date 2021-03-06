<?php
/**
 * Created by PhpStorm.
 * User: Tomek
 * Date: 01.11.2017
 * Time: 21:35
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;


/**
 * Class MovieCategory
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="movie_categories")
 */
class MovieCategory
{
   /*
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
//    protected $id;

    /**
     * One Category has one Movie
     * @ORM\Id
     * @ORM\Column(type="string", unique=true)
     */
    protected $category_name;

    /**
     * MovieCategory constructor.
     * @param $category_name
     */

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param mixed $category
     */
    public function setCategoryName($category)
    {
        $this->category_name = $category;
    }

    /**
     * @return mixed
     */
    public function getcategory_name()
    {
        return $this->category_name;
    }

    /**
     * @param mixed $category
     */
    public function setcategory_name($category)
    {
        $this->category_name = $category;
    }

    public function __construct($category_name)
    {
        $this->category_name = $category_name;
    }

    public function __toString()
    {
        return (string) $this->getcategory_name();
    }


}