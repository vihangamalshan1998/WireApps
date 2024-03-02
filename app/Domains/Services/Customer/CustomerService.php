<?php

namespace Domains\Services\Customer;

use App\Models\Customer;
use App\Traits\Api\ApiHelper;
use Illuminate\Database\Eloquent\Collection;

/**
 * Customer Service
 * */
class CustomerService
{
    use ApiHelper;
    protected $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }

    /**
     * Get all customer
     *
     * @return Collection
     */
    public function all(): ?Collection
    {
        return $this->customer->all();
    }

    /**
     * Get customer By Id
     *
     * @param  int $customer_id
     * @return Customer
     */
    public function get(int $id): ?Customer
    {
        return $this->customer->find($id);
    }

    /**
     * Create Customer
     *
     * @param  array $data customer record based data array
     *
     * @return Customer
     */
    public function create(array $data): Customer
    {
        return $this->customer->create($data);
    }

    /**
     * update
     *
     * @param  Customer $customer
     * @param  array    $data
     *
     * @return void
     */
    public function update(Customer $customer, array $data): void
    {
        $customer->update($this->edit($customer, $data));
    }
/**
 * edit
 *
 * @param  Customer $customer
 * @param  array    $data
 *
 * @return array
 */
    protected function edit(Customer $customer, array $data): array
    {
        return array_merge($customer->toArray(), $data);
    }
    /**
     * delete
     *
     * @param  Customer $customer
     *
     * @return void
     */
    public function delete(Customer $customer): void
    {
        $customer->delete();
    }
    /**
     * full_delete
     *
     * @param  Customer $customer
     *
     * @return void
     */
    public function full_delete(Customer $customer): void
    {
        $customer->forceDelete();
    }
}
