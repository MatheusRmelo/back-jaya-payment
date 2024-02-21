<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Payment",
 *     description="Payment model",
 *     @OA\Xml(
 *         name="Payment"
 *     )
 * )
 */
class Payment
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     example="9c253550-25ae-4574-8435-86f77ed2abf9"
     * )
     *
     * @var string
     */
    private $id;

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
     *      title="notification_url",
     *      description="URL de notificação do webhook",
     *      example="http://localhost/rest/webhook/payment"
     * )
     *
     * @var string
     */
    public $notification_url;

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
     * @var \App\Virtual\Models\Payer
     */
    public $payer;
}
