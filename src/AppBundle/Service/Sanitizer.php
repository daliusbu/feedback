<?php
/**
 * Created by PhpStorm.
 * User: dalius
 * Date: 20.1.27
 * Time: 23.42
 */

namespace AppBundle\Service;


class Sanitizer
{
    public function sanitize($feedback)
    {

        $feedback->setFirstName(trim(filter_var($feedback->getFirstName(), FILTER_SANITIZE_STRING)));
        $feedback->setLastName(trim(filter_var($feedback->getLastName(), FILTER_SANITIZE_STRING)));
        $feedback->setEmail(trim(filter_var($feedback->getEmail(), FILTER_SANITIZE_EMAIL)));
        $feedback->setMessage(trim(filter_var($feedback->getMessage(), FILTER_SANITIZE_STRING)));

        return $feedback;
    }
}