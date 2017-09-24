<?php

namespace AppBundle\Entity;

class Users
{

    /*
    protected $voornaam;
    protected $naam;
    protected $mail;
    protected $straat;
    protected $post;
    protected $gsm;
    */

    public function authorize_user($conn, $id)
    {
        $stmt = $conn->prepare("SELECT pogingen FROM users WHERE id=:id");
        $stmt->bindValue("id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $data = [];

        if( $result ) {

            if($result['pogingen'] == 0) {

                //set reply
                $data['result'] = 'valid';

                //mark user as played
                $stmt = $conn->prepare("UPDATE users SET pogingen = pogingen + 1 WHERE id=:id");
                $stmt->bindValue("id", $id);
                $stmt->execute();


            } else {

                $data["result"] = "error";
                $data['error'] = 'deze gebruiker heeft reeds gestemd';

            }


        } else {

            $data["result"] = "error";
            $data['error'] = 'gebruiker niet gevonden';

        }

        return $data;
    }


    public static function save($conn,$array) {

        $keys = implode(',',array_keys($array)) ;
        $values = "'" . implode("','",array_values($array)) . "'";

        //validate for the duplicates
        //exit ( var_dump("INSERT INTO users ($keys) VALUES ($values)"));

        $sql = "INSERT INTO users ($keys) VALUES ($values)";
        $stmt = $conn->prepare($sql);
        //$stmt->bindValue(":keys", $keys);
        //$stmt->bindValue(":val", $values);
        $stmt->execute();


    }


}