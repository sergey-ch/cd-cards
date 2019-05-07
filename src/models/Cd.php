<?php

namespace App\models;

class Cd
{
    const DATE_FORMAT = 'Y-m-d';
    
    protected $id;
    public $name;
    public $artist;
    public $year;
    public $duration;
    public $buy_date;
    public $price;
    public $code;
    public $img;

    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->load($data);
        }
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getFormattedBuyDate()
    {
        return date(self::DATE_FORMAT, $this->buy_date);
    }

    public function load($data)
    {
        foreach ($data as $property => $value) {
            if (property_exists($this, $property)) {
                
                if ($property == 'id' && !empty($this->{$property})) {
                    continue;
                }
                
                $this->{$property} = $value;
            }
        }
    }

    public static function getFormFields()
    {
        return [
            'name' => 'Name',
            'artist' => 'Artist',
            'year' => 'Year',
            'duration' => 'Duration',
            'buy_date' => 'Buy date',
            'price' => 'Price',
        ];
    }
}