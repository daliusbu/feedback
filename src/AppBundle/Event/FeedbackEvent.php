<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 20.1.27
 * Time: 17.21
 */

namespace AppBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class FeedbackEvent extends Event
{
    private $feedback;


    /**
     * FeedbackEvent constructor.
     */
    public function __construct($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * @return mixed
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

}