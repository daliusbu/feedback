<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Feedback;
use AppBundle\Service\Recapture;
use AppBundle\Service\Sanitizer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Event\FeedbackEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use AppBundle\Event\Events;


class FeedbackController extends Controller
{

    /**
     * @Route("/feedback", name="feedback")
     */
    public function indexAction(
        Request $request,
        EventDispatcherInterface $eventDispatcher,
        Recapture $recapture,
        Sanitizer $sanitizer)
    {
        $feedback = new Feedback();

        $form = $this->createFormBuilder($feedback)
            ->add('firstName', TextType::class, ['label' => 'Vardas'])
            ->add('lastName', TextType::class, ['label' => 'Pavardė'])
            ->add('email', EmailType::class, ['label' => 'El. paštas'])
            ->add('message', TextareaType::class, ['label' => 'Jūsų žinutė'])
            ->add('save', SubmitType::class, ['label' => 'Siųsti'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $recapture->isVerified($request)) {

            $feedback = $form->getData();
            $feedback = $sanitizer->sanitize($feedback);
            $feedback->setIp($request->getClientIp());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feedback);
            $entityManager->flush();

            $eventDispatcher->dispatch(
                Events::USER_FEEDBACK,
                new FeedbackEvent($feedback)
            );

            return $this->redirectToRoute('feedback_success');
        }

        return $this->render('feedback/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/feedback-success", name="feedback_success")
     */
    public function successAction()
    {

        return $this->render('feedback/success.html.twig');
    }

}