<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Models\User;
use App\Models\Master\ServiceCustomer;

class SalesOrders extends Component
{
    use WithPagination;

    public $sales_order_id, $order_no, $reference_no, $customer_id, $salesman_id, $remarks;
    public $items = [];
    public $discount = 0, $tax = 0, $total_cost = 0;
    public $customers, $salesmen;
    public $showForm = false;

    protected $rules = [
        'order_no' => 'required|string|max:255',
        'reference_no' => 'nullable|string|max:255',
        'customer_id' => 'required|exists:service_customers,id',
        'salesman_id' => 'nullable|exists:users,id',
        'items.*.item_id' => 'required|exists:store_items,id',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.selling_price' => 'required|numeric|min:0',
        'items.*.tax' => 'nullable|numeric|min:0',
    ];

    public function mount()
    {
        $this->customers = ServiceCustomer::all();
        $this->salesmen = User::all();
    }

    public function create()
    {
        $this->resetFields();
        $this->showForm = true;
    }

    public function edit($id)
    {
        $order = SalesOrder::with('items')->findOrFail($id);

        $this->sales_order_id = $order->id;
        $this->order_no = $order->order_no;
        $this->reference_no = $order->reference_no;
        $this->customer_id = $order->customer_id;
        $this->salesman_id = $order->salesman_id;
        $this->remarks = $order->remarks;
        $this->discount = $order->discount;
        $this->tax = $order->tax;
        $this->items = $order->items->map(function ($item) {
            return [
                'id' => $item->id,
                'item_id' => $item->item_id,
                'quantity' => $item->quantity,
                'selling_price' => $item->selling_price,
                'tax' => $item->tax,
            ];
        })->toArray();

        $this->calculateTotal();
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        $order = SalesOrder::updateOrCreate(
            ['id' => $this->sales_order_id],
            [
                'order_no' => $this->order_no,
                'reference_no' => $this->reference_no,
                'customer_id' => $this->customer_id,
                'salesman_id' => $this->salesman_id,
                'remarks' => $this->remarks,
                'discount' => $this->discount,
                'tax' => $this->tax,
                'total_cost' => $this->total_cost,
            ]
        );

        foreach ($this->items as $item) {
            $order->items()->updateOrCreate(
                ['id' => $item['id'] ?? null],
                [
                    'item_id' => $item['item_id'],
                    'quantity' => $item['quantity'],
                    'selling_price' => $item['selling_price'],
                    'tax' => $item['tax'],
                ]
            );
        }

        session()->flash('message', 'Sales Order saved successfully!');
        $this->resetFields();
        $this->showForm = false;
    }

    public function calculateTotal()
    {
        $this->total_cost = collect($this->items)->sum(fn($item) => $item['quantity'] * $item['selling_price'] + ($item['tax'] ?? 0))
            - $this->discount + $this->tax;
    }

    public function resetFields()
    {
        $this->sales_order_id = null;
        $this->order_no = '';
        $this->reference_no = '';
        $this->customer_id = '';
        $this->salesman_id = '';
        $this->remarks = '';
        $this->discount = 0;
        $this->tax = 0;
        $this->total_cost = 0;
        $this->items = [];
    }

    public function render()
    {
        $salesOrders = SalesOrder::with('customer', 'salesman')->paginate(10);

        return view('livewire.sales-orders', [
            'salesOrders' => $salesOrders,
        ]);
    }
}
