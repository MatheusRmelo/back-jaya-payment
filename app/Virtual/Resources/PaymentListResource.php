<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="PaymentListResource",
 *     description="Payment resource",
 *     @OA\Xml(
 *         name="PaymentListResource"
 *     )
 * )
 */
class PaymentListResource extends BaseResource
{
    /**
     * @OA\Property(
     *     title="Result",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Payment[]
     */
    private $result;
}
