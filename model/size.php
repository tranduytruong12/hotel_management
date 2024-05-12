<?php
class Size
{
    private $id;
    private $size_name;
    private $size_state;

    public function __construct($id, $size_name, $size_state)
    {
        $this->id = $id;
        $this->size_name = $size_name;
        $this->size_state = $size_state;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSizeName()
    {
        return $this->size_name;
    }

    public function getSizeState()
    {
        return $this->size_state;
    }
}
