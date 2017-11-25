<?php
/**
 * Created by PhpStorm.
 * User: Tomek
 * Date: 01.11.2017
 * Time: 18:53
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class MovieCharacteristic
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="movie_characteristics")
 *
 */
class MovieCharacteristic
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="string")
     */
    protected $storyline;

    /**
     * @return mixed
     */


    /**
     * Many Movies has one Category
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MovieCategory")
     * @JoinColumn(name="category", referencedColumnName="category_name")
     */
    protected $category;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $isNew;

    /**
     * MovieCharacteristic constructor.
     * @param $title
     * @param $storyline
     * @param $category
     */

    /**
     * MovieCharacteristic constructor.
     * @param $id
     */

    /**
     * @return mixed
     */
    public function getisNew()
    {
        return $this->isNew;
    }

    /**
     * @param mixed $isNew
     */
    public function setIsNew($isNew)
    {
        $this->isNew = $isNew;
    }

    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getStoryline()
    {
        return $this->storyline;
    }

    /**
     * @param mixed $storyline
     */
    public function setStoryline($storyline)
    {
        $this->storyline = $storyline;
    }

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return MovieCharacteristic
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function __construct($title, $storyline, $category)
    {
        $this->title = $title;
        $this->storyline = $storyline;
        $this->category = $category;
    }

}