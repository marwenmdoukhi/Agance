<?php

namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class ContactNotification
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $renderer;

    /**
     * ContactNotification constructor.
     * @param \Swift_Mailer $mailer
     * @param Environment $renderer
     */
    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    /**
     * @param Contact $contact
     */
    public function notify(Contact $contact)
    {
        try {
            $message = (new \Swift_Message('Agency :' . $contact->getProperty()->getTitle()))
                ->setFrom('noreply@agency.fr')
                ->setTo('contact@agency.fr')
                ->setReplyTo($contact->getEmail())
                ->setBody($this->renderer->render('emails/contact.html.twig'), [
                    'contact' => $contact
                ], 'text/html');
            $this->mailer->send($message);
        } catch (LoaderError $e) {
        } catch (RuntimeError $e) {
        } catch (SyntaxError $e) {
        }
    }
}