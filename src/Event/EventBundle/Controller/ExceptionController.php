<?php
/**
 * Created by PhpStorm.
 * User: shibly
 * Date: 10/29/13
 * Time: 2:18 PM
 */

namespace Event\EventBundle\Controller;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as BaseController;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class ExceptionController extends BaseController
{
    private $exceptionClass;

    public function showAction(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null, $format = 'html')
    {
        $this->exceptionClass = $exception->getClass();
        return parent::showAction($request, $exception, $logger, $format);
    }

    protected function findTemplate(Request $request, $format, $code, $debug)
    {
        if ($this->exceptionClass == 'Event\EventBundle\Exception\EventNotFoundException') {
            die('debuggin!');
        }
        if (!$debug && $this->exceptionClass == 'Event\EventBundle\Exception\EventNotFoundException') {
            return 'EventBundle:Exception:error404.html.twig';
        }

        return parent::findTemplate($request, $format, $code, $debug);
    }
} 