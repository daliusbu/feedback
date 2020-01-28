<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 20.1.27
 * Time: 17.29
 */

namespace AppBundle\Event\Listener;


use AppBundle\Event\FeedbackEvent;

class FeedbackEventListener
{

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $templating;

    /**
     * FeedbackEventListener constructor.
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * @param FeedbackEvent $event
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function onUserFeedback(FeedbackEvent $event)
    {
       $feedback = $event->getFeedback();
        $message = (new \Swift_Message('Gauta žinutė'))
            ->setFrom('noreply@example.com')
            ->setTo('subconit@mailforspam.com')
            ->setBody(
                $this->templating->render(
                    'Emails/confirmation.html.twig', [
                        'name' => ($feedback->getFirstName() . " " . $feedback->getLastName()),
                        'email' => $feedback->getEmail(),
                        'message' => $feedback->getmessage(),
                        'ip' => $feedback->getIp(),
                    ]
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

}