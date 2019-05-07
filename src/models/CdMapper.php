<?php

namespace App\models;

/**
 * PDO mapper
 * Class CdMapper
 * @package App\models
 */
class CdMapper
{
    /**
     * @var \PDO
     */
    protected $db;
    
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function getAll($filterField = null, $filterValue = null, $sort = '', $direction = 'ASC')
    {
        $sql = '';

        // @todo validate filter
        if (!empty($filterField) && !empty($filterValue)) {
            $sql .= ' WHERE '. $filterField .'=:filterValue ';
        }
        
        // @todo validate sort and direction
        if (!empty($sort)) {
            $sql .= ' ORDER BY '. $sort .' '. $direction;
        }
        
        $stmt = $this->db->prepare('SELECT * FROM cd '. $sql .';');

        if (!empty($filterField) && !empty($filterValue)) {
            $stmt->bindValue(':filterValue', $filterValue);
        }
        
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $this->loadAll($data);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM cd WHERE id=:id;');
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        return (new Cd($data));
    }

    public function create(Cd $cd)
    {
        $stmt = $this->db->prepare('
            INSERT INTO cd (`name`, `artist`, `year`, `duration`, `buy_date`, `price`, `code`, `img`) VALUES 
            (:name, :artist, :year, :duration, :buy_date, :price, :code, :img);
        ');
        
        $stmt->execute([
            ':name' => $cd->name,
            ':artist' => $cd->artist,
            ':year' => $cd->year,
            ':duration' => $cd->duration,
            ':buy_date' => $cd->buy_date,
            ':price' => $cd->price,
            ':code' => $cd->code,
            ':img' => $cd->img,
        ]);
        
        return $this->db->lastInsertId(); 
    }

    public function update(Cd $cd)
    {
        $stmt = $this->db->prepare('
            UPDATE cd SET `name`=:name, `artist`=:artist, `year`=:year, `duration`=:duration,
             `buy_date`=:buy_date, `price`=:price, `code`=:code, `img`=:img
             WHERE `id`=:id;
        ');

        return $stmt->execute([
            ':id' => $cd->getId(),
            ':name' => $cd->name,
            ':artist' => $cd->artist,
            ':year' => $cd->year,
            ':duration' => $cd->duration,
            ':buy_date' => $cd->buy_date,
            ':price' => $cd->price,
            ':code' => $cd->code,
            ':img' => $cd->img,
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM cd WHERE id=:id;');
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    /**
     * @param $data
     * @return Cd[]
     */
    protected function loadAll($data)
    {
        $cds = [];
        
        foreach ($data as $cdData) {
            $cds[] = (new Cd($cdData));
        }
        
        return $cds;
    }
}