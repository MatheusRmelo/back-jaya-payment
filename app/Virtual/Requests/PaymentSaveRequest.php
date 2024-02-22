<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="PaymentSaveRequest",
 *      description="Requisição com body para salvar o pagamento",
 *      type="object",
 *      required={"transaction_amount","installments"}
 * )
 */

class PaymentSaveRequest
{
    /**
     * @OA\Property(
     *      title="transaction_amount",
     *      description="Valor da transação",
     *      example="15"
     * )
     *
     * @var float
     */
    public $transaction_amount;

    /**
     * @OA\Property(
     *      title="installments",
     *      description="Parcelas",
     *      example="1"
     * )
     *
     * @var integer
     */
    public $installments;

    /**
     * @OA\Property(
     *      title="token",
     *      description="Token",
     *      example="weqwewqewqeeewqeewqew"
     * )
     *
     * @var string
     */
    public $token;

    /**
     * @OA\Property(
     *      title="payment_method_id",
     *      description="Metodo de pagamento",
     *      example="42"
     * )
     *
     * @var string
     */
    public $payment_method_id;

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

    /**
     * @OA\Property(
     *      title="payer",
     *      description="Pagador"
     * )
     *
     * @var \App\Virtual\Requests\PayerRequest
     */
    public $payer;
}
