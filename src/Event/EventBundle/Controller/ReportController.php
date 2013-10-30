<?php
/**
 * Created by PhpStorm.
 * User: shibly
 * Date: 10/29/13
 * Time: 3:31 PM
 */

namespace Event\EventBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Event\EventBundle\Reporting\EventReportManager;

class ReportController extends Controller
{
    public function updatedEventsAction()
    {
        $reportManager = $this->container->get('event.reporting.event_report_manager');
        $content = $reportManager->getRecentlyUpdatedReport();
        $response = new Response($content);
        $response->headers->set('Content-Type', 'text/csv');
        return $response;
    }

} 
