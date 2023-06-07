<?php

namespace Byte5\LaravelHarvest;

use Byte5\LaravelHarvest\Endpoints\BaseEndpoint;
use Byte5\LaravelHarvest\Endpoints\Client;
use Byte5\LaravelHarvest\Endpoints\Company;
use Byte5\LaravelHarvest\Endpoints\Contact;
use Byte5\LaravelHarvest\Endpoints\Estimate;
use Byte5\LaravelHarvest\Endpoints\EstimateItemCategory;
use Byte5\LaravelHarvest\Endpoints\EstimateMessage;
use Byte5\LaravelHarvest\Endpoints\Expense;
use Byte5\LaravelHarvest\Endpoints\ExpenseCategory;
use Byte5\LaravelHarvest\Endpoints\Invoice;
use Byte5\LaravelHarvest\Endpoints\InvoiceItemCategory;
use Byte5\LaravelHarvest\Endpoints\InvoiceMessage;
use Byte5\LaravelHarvest\Endpoints\InvoicePayment;
use Byte5\LaravelHarvest\Endpoints\Project;
use Byte5\LaravelHarvest\Endpoints\ProjectAssignment;
use Byte5\LaravelHarvest\Endpoints\ReportsUninvoiced;
use Byte5\LaravelHarvest\Endpoints\ReportsTimeClient;
use Byte5\LaravelHarvest\Endpoints\ReportsTimeProject;
use Byte5\LaravelHarvest\Endpoints\ReportsTimeTask;
use Byte5\LaravelHarvest\Endpoints\ReportsTimeTeam;
use Byte5\LaravelHarvest\Endpoints\Role;
use Byte5\LaravelHarvest\Endpoints\Task;
use Byte5\LaravelHarvest\Endpoints\TaskAssignment;
use Byte5\LaravelHarvest\Endpoints\TimeEntry;
use Byte5\LaravelHarvest\Endpoints\User;
use Byte5\LaravelHarvest\Endpoints\UserAssignment;
use Byte5\LaravelHarvest\Traits\CanResolveEndpoints;

/**
 * @method Client client()
 * @method Company company()
 * @method Contact contact()
 * @method Estimate estimate()
 * @method EstimateItemCategory estimateItemCategory()
 * @method EstimateMessage estimateMessage()
 * @method Expense expense()
 * @method ExpenseCategory expenseCategory()
 * @method Invoice invoice()
 * @method InvoiceItemCategory invoiceItemCategory()
 * @method InvoiceMessage invoiceMessage()
 * @method InvoicePayment invoicePayment()
 * @method Project project()
 * @method ProjectAssignment projectAssignment()
 * @method ReportsUninvoiced reportsUninvoiced()
 * @method ReportsTimeClient reportsTimeClients()
 * @method ReportsTimeProject reportsTimeProjects()
 * @method ReportsTimeTask reportsTimeTasks()
 * @method ReportsTimeTeam reportsTimeTeams()
 * @method Role role()
 * @method Task task()
 * @method TaskAssignment taskAssignment()
 * @method TimeEntry timeEntry()
 * @method User user()
 * @method UserAssignment userAssignment()
 *
 * @property Client clients
 * @property Company companies
 * @property Contact contacts
 * @property Estimate estimates
 * @property EstimateItemCategory estimateItemCategories
 * @property EstimateMessage estimateMessages
 * @property Expense expenses
 * @property ExpenseCategory expenseCategories
 * @property Invoice invoices
 * @property InvoiceItemCategory invoiceItemCategories
 * @property InvoiceMessage invoiceMessages
 * @property InvoicePayment invoicePayments
 * @property Project projects
 * @property ProjectAssignment projectAssignments
 * @property ReportsUninvoiced reportsUninvoiced
 * @property ReportsTimeClient ReportsTimeClients
 * @property ReportsTimeProject ReportsTimeProjects
 * @property ReportsTimeTask ReportsTimeTasks
 * @property ReportsTimeTeam ReportsTimeTeams
 * @property Role roles
 * @property Task tasks
 * @property TaskAssignment taskAssignments
 * @property TimeEntry timeEntries
 * @property User users
 * @property UserAssignment userAssignments
 */
class ApiManager
{
    use CanResolveEndpoints;

    protected ?BaseEndpoint $endpoint = null;

    public function __construct(
        protected ApiGateway $gateway
    ) {}

    protected function setEndpoint(string $name): void
    {
        $this->endpoint = $this->resolveEndpoint($name);
    }

    /**
     * @param $name
     * @return $this
     */
    public function __get($name)
    {
        $this->setEndpoint($name);

        return $this;
    }

    public function __call(string $name, array $arguments)
    {
        if ($this->isStaticCall() && ! $this->endpoint) {
            $this->setEndpoint($name);

            return $this;
        }

        if (! method_exists($this->endpoint, $name)) {
            throw new \RuntimeException("Endpoint method $name does not exist!");
        }

        $url = call_user_func_array([$this->endpoint, $name], $arguments);
        if (null === $url) {
            return $this;
        }

        return tap($this->craftResponse($url), $this->clearEndpoint(...));
    }

    protected function clearEndpoint(): void
    {
        $this->endpoint = null;
    }

    protected function craftResponse($url): ApiResponse
    {
        return new ApiResponse($this->gateway->execute($url), $this->endpoint->getModel());
    }

    /**
     * @return bool
     */
    protected function isStaticCall()
    {
        return ! $this->endpoint;
    }
}
