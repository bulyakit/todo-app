<?php

namespace ToDoApp\Route;

use Slim\App;

/**
 * Class Routing
 *
 * @package Livita\LivitApi
 */
class Routing
{
    /**
     * @var App
     */
    private App $application;

    /**
     * Routing constructor.
     *
     * @param App $application
     */
    public function __construct(App $application)
    {
        $this->application = $application;
    }

    /**
     * Initialize routes.
     */
    public function initialize()
    {
        $this->application->options('/{routes:.+}', function ($request, $response) {
            return $response;
        })->setName('cors');

//        (new UserRouting($this->application))->initialize();
//        (new HotelRouting($this->application))->initialize();
//        (new TravelExpenseRouting($this->application))->initialize();
//        (new PaymentAdvanceRouting($this->application))->initialize();
//        (new EmployeeRouting($this->application))->initialize();
//        (new CompanyRouting($this->application))->initialize();
//        (new LocationRouting($this->application))->initialize();
//        (new RemarkRouting($this->application))->initialize();
//        (new CateringRouting($this->application))->initialize();
//        (new ReportRouting($this->application))->initialize();
        (new ToDoRouting($this->application))->initialize();
    }
}
