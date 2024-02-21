<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="PayerRequest",
 *      description="Requisição com body para salvar o pagador",
 *      required={"email","identification"}
 * )
 */

class PayerRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="Email do pagador",
     *      example="teste@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="identification",
     *      description="Identificacao do pagador"
     * )
     *
     * @var \App\Virtual\Requests\IdentificationRequest
     */
    public $identification;
}
