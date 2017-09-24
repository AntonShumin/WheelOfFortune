<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Wheel;
use AppBundle\Entity\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/form",name="form")
     */
    public function registratie(Request $request)
    {

        //build a form
        $form = $this->createFormBuilder()
            ->add('voornaam', TextType::class)
            ->add('naam', TextType::class)
            ->add('email', EmailType::class)
            ->add('straat', TextType::class)
            ->add('post', TextType::class)
            ->add('gsm', NumberType::class, array(
                'constraints' => new Length(array('min' => 8, 'max' => 10)),
            ))
            ->add('save', SubmitType::class, array('label' => 'Submit'))
            ->getForm();

        //handle request
        $form->handleRequest($request);

        //submit form
        if ($form->isSubmitted() && $form->isValid()) {

            $conn = $this->get('database_connection');
            Users::save($conn, $form->getData());

        }

        //return
        return $this->render('default/form.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/wheel/{id_deelnemer}",name="wheel")
     * @return JsonResponse
     */
    public function turnWheel(Request $request, $id_deelnemer)
    {

        //setup
        $conn = $this->get('database_connection');

        //check if user is valid
        $user = new Users();
        $user = $user->authorize_user($conn, (int)$id_deelnemer);
        $data = $user;

        //if user can play
        if ($user['result'] == 'valid') {

            //spin the wheel
            $wheel = new Wheel();
            $wheel_chance = $wheel->turn_wheel();

            //preset loss
            $data['reward'] = 'Helaas, u hebt niets gewonnen';

            //if won
            if ($wheel_chance > 0) {

                //check rewards remaining
                $availability = $wheel->check_availability($conn, $wheel_chance);
                if ($availability != 0) {

                    $data['reward'] = "Proficiat: uw prijs is $availability";

                }

            }

        }

        return $this->json($data);

    }


}
