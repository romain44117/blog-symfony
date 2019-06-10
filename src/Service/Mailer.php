<?php


namespace App\Service;


use App\Entity\Article;
use Twig\Environment;

class Mailer
{
    private $mailer;

    private $environment;

    public function __construct(\Swift_Mailer $mailer, Environment $environment)
    {
        $this->mailer = $mailer;
        $this->environment = $environment;
    }

    public function sendMailNewArticle(Article $article)
    {
        $message = (new \Swift_Message('Un nouvel article vient d\'être publié !'))
            ->setFrom($_ENV['mail_from'])
            ->setTo('grangaillar@hotmail.fr')
            ->setBody($this->environment->render('email/notification.html.twig',[
                'article' =>$article
            ]),
                'text/html');
        $this->mailer->send($message);
    }
}
