Wheel of fortune
================

Wheel of fortune is ene kleine symfony applicaite waarbij de spelers een kans maken op een reeks prachtige prijzen. 



Installatie 
-----------

* importeer mySQL bestand db_wheel.sql in uw database (te vinden in de root van het project)

* app/config/parameters.yml verwacht de volgenden db instellingen

        database_host: localhost
        database_port: null
        database_name: db_wheel
        database_user: user
        database_password: pass


* navigeren naar de directory 

        cd WheelOfFortune

* dependencies installeren

        composer install

* server deploy'en op localhost 

        php bin/console server:run


Inhoud
------

 * models 

        1. Entity/Users
        2. Entity/Wheel
    
 * controllers
 
        1. Controller/Default
        
 * views
 
        1. default/form
        
Database
--------

Er zijn 2 tabellen

        reward
        users
        
`reward` bevat alle mogelijke prijzen + voorraad

`users` bevast persoonsgegevens van geregistreerde gebruikers + een teller van aantal speelpogingen (max 1) 

Beschrijving
------------

**Endpoint 2 - Wheel of fortune**

        DefaultController
        type request: get
        @Route("/wheel/{id_deelnemer}
        functie turnWheel
        @return JsonResponse  

vb. json return

        {
        "result": "valid",
        "reward": "Proficiat: uw prijs is 10 euro voucher"
        }

De functie `turnWheel` krijgt de id van de gebruiker (mogelijk om uit te breiden naar de hashed id), controlleert of de gebruiker bestaat in de database en nog niet gestemd heeft. 

Vervolgens wordt de functie `Wheel/turn_wheel` aangeroepen met als resultaat een getal tussen 0 en 4. 0 = niets gewonnen, 1-3 komt overeen met de rewards in de database. 

De functie `Wheel/check_availability` controlleert de voorraad van de vouchers en genereert een gepaste bericht, indien men gewonnen heeft. Het verlaagt de teller in eens met 1 eenheid.



**Endpoint 1 - registratie** 

Ik ben er niet in geslaagd om tijdig 'request' validate te doorgroden. Vandaar deze tussentijdse oplossingen. 
Momenteel is er geen validatie tegen duplicaten

Men kan een simpele post formulier invullen op het adres:

        DefaultController
        @Route("/form")
        functie registratie
        @return form.html.twig

FormBuilder genereert een formulier. Indien het 'gesubmit' en gevalideerd is, opslaan in de database. 


