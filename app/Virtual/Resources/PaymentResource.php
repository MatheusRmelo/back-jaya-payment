<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="PaymentResource",
 *     description="Payment resource",
 *     @OA\Xml(
 *         name="PaymentResource"
 *     )
 * )
 */
class PaymentResource extends BaseResource
{
    /**
     * @OA\Property(
     *     title="Result",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Payment
     */
    private $result;
}
