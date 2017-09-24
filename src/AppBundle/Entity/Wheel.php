<?php

namespace AppBundle\Entity;

use Doctrine\DBAL\Driver\Connection;

class Wheel
{

    private static $probability = [0, 500, 200, 50, 5]; //kan ook getrokken worden van de db

    public function turn_wheel()
    {
        $seed = mt_rand(1, 1000);
        $max = 0;
        $min = 0;
        $result = 0;

        for ($i = 1; $i < count(static::$probability); $i++) {

            $max += static::$probability[$i];
            $min += static::$probability[$i - 1];

            if ($seed > $min && $seed <= $max) {

                $result = $i;

            }

        }

        return $result;

    }

    public function check_availability($conn, $id)
    {

        //get remaining
        $stmt = $conn->prepare("SELECT remaining,description FROM reward WHERE id=:id");
        $stmt->bindValue("id", $id);
        $stmt->execute();
        $result = $stmt->fetch();

        //preset reply
        $response = 0;

        //check if enough remaining
        if ($result && $result['remaining'] > 0) {

            //subtrack 1 from remaining
            $stmt = $conn->prepare("UPDATE reward SET remaining = remaining - 1 WHERE id=:id");
            $stmt->bindValue("id", $id);
            $stmt->execute();

            //set reply
            $response = $result['description'];

        }

        //return
        return $response;

    }


}

