<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="PaymentStatusRequest",
 *      description="Requisição com body para atualizar status do pagamento",
 *      type="object",
 *      required={"status"}
 * )
 */

class PaymentStatusRequest
{
    /**
     * @OA\Property(
     *      title="status",
     *      description="Status do pagamento",
     *      example="PAID"
     * )
     *
     * @var string
     */
    public $status;
}
