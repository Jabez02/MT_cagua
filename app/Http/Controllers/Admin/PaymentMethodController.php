<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PaymentMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'adminMiddleware']);
    }

    /**
     * Display a listing of payment methods.
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::orderBy('priority')
            ->withCount('payments')
            ->get();

        return view('admin.payment-methods.index', compact('paymentMethods'));
    }

    /**
     * Show the form for creating a new payment method.
     */
    public function create()
    {
        return view('admin.payment-methods.create');
    }

    /**
     * Store a newly created payment method.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:payment_methods'],
            'description' => ['nullable', 'string'],
            'instructions' => ['nullable', 'string'],
            'processing_fee_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'processing_fee_fixed' => ['required', 'numeric', 'min:0'],
            'min_amount' => ['nullable', 'numeric', 'min:0'],
            'max_amount' => ['nullable', 'numeric', 'gt:min_amount'],
            'currencies' => ['required', 'array', 'min:1'],
            'currencies.*' => ['required', 'string', 'size:3'],
            'is_active' => ['boolean'],
            'priority' => ['required', 'integer', 'min:0'],
            'configuration' => ['nullable', 'array'],
        ]);

        try {
            PaymentMethod::create($validated);

            return redirect()
                ->route('admin.payment-methods.index')
                ->with('success', 'Payment method created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create payment method', [
                'error' => $e->getMessage(),
                'data' => $validated
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to create payment method. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified payment method.
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-methods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified payment method.
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', Rule::unique('payment_methods')->ignore($paymentMethod)],
            'description' => ['nullable', 'string'],
            'instructions' => ['nullable', 'string'],
            'processing_fee_percentage' => ['required', 'numeric', 'min:0', 'max:100'],
            'processing_fee_fixed' => ['required', 'numeric', 'min:0'],
            'min_amount' => ['nullable', 'numeric', 'min:0'],
            'max_amount' => ['nullable', 'numeric', 'gt:min_amount'],
            'currencies' => ['required', 'array', 'min:1'],
            'currencies.*' => ['required', 'string', 'size:3'],
            'is_active' => ['boolean'],
            'priority' => ['required', 'integer', 'min:0'],
            'configuration' => ['nullable', 'array'],
        ]);

        try {
            $paymentMethod->update($validated);

            return redirect()
                ->route('admin.payment-methods.index')
                ->with('success', 'Payment method updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update payment method', [
                'error' => $e->getMessage(),
                'data' => $validated,
                'payment_method_id' => $paymentMethod->id
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to update payment method. Please try again.');
        }
    }

    /**
     * Toggle the active status of the payment method.
     */
    public function toggleStatus(PaymentMethod $paymentMethod)
    {
        try {
            $paymentMethod->update([
                'is_active' => !$paymentMethod->is_active
            ]);

            return redirect()
                ->route('admin.payment-methods.index')
                ->with('success', 'Payment method status updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to toggle payment method status', [
                'error' => $e->getMessage(),
                'payment_method_id' => $paymentMethod->id
            ]);

            return back()->with('error', 'Failed to update payment method status.');
        }
    }

    /**
     * Update the priority order of payment methods.
     */
    public function updatePriority(Request $request)
    {
        $validated = $request->validate([
            'priorities' => ['required', 'array'],
            'priorities.*' => ['required', 'integer', 'distinct'],
        ]);

        try {
            foreach ($validated['priorities'] as $id => $priority) {
                PaymentMethod::where('id', $id)->update(['priority' => $priority]);
            }

            return response()->json(['message' => 'Priorities updated successfully']);
        } catch (\Exception $e) {
            Log::error('Failed to update payment method priorities', [
                'error' => $e->getMessage(),
                'data' => $validated
            ]);

            return response()->json(
                ['message' => 'Failed to update priorities'],
                500
            );
        }
    }
}