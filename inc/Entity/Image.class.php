<?php
class Image
{
    private $id;
    private $name;
    private $image_data;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getImageData()
    {
        return $this->image_data;
    }

}
?>