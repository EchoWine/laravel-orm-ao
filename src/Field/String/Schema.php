<?php

namespace CoreWine\ORM\Field\String;

use CoreWine\ORM\Field\String\Exceptions as Exceptions;

class Schema
{

    protected $min_length = null;
    protected $max_length = null;
    protected $match = null;

    /**
     * Set min length
     *
     * @param integer $min_length
     *
     * @return $this
     */
    public function minLength($min_length){
        $this -> min_length = $min_length;
        return $this;
    }

    /**
     * Get min length
     *
     * @return integer
     */
    public function getMinLength(){
        return $this->min_length;
    }

    /**
     * Set max length
     *
     * @param integer $max_length
     *
     * @return this
     */
    public function maxLength($max_length){
        $this -> max_length = $max_length;
        return $this;
    }

    /**
     * Get min length
     *
     * @return integer
     */
    public function getMaxLength(){
        return $this->max_length;
    }

    /**
     * Set match
     *
     * @param string $match
     *
     * @return void
     */
    public function match($match){
        $this -> match = $match;
        return $this;
    }

    /**
     * Get match
     *
     * @return integer
     */
    public function getMatch(){
        return $this->match;
    }

    /**
     * Validate the value
     *
     * @param string value
     *
     * @return void
     */
    public function validate($value){

        $value = Stringy::create($value);


        if($this->getMinLength() !== null && $value -> length() < $this->getMinLength())
            throw new Exceptions\TooShortException($value);

        if($this->getMaxLength() !== null && $value -> length() > $this->getMaxLength())
            throw new Exceptions\TooShortException($value);

        $match = $this->getMatch();
        if($match !== null){

            if(is_string($match) && !$value -> match($match)){
                throw new Exceptions\InvalidException($value);
            }else if($match instanceof \Closure && !$match($value)){
                throw new Exceptions\InvalidException($value);
            }
        }
    }
}