<?php
class Color
{
    private $id;
    private $color_name;
    private $color_img;
    private $color_state;

    public function __construct($id, $color_name, $color_img, $color_state)
    {
        $this->id = $id;
        $this->color_name = $color_name;
        $this->color_img = $color_img;
        $this->color_state = $color_state;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getColorName()
    {
        return $this->color_name;
    }
    public function getColorImg()
    {
        return $this->color_img;
    }

    public function getColorState()
    {
        return $this->color_state;
    }
}
