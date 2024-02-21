<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Payer",
 *     description="Payer model",
 *     @OA\Xml(
 *         name="Payer"
 *     )
 * )
 */
class Payer
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
     * @var \App\Virtual\Models\Identification
     */
    public $identification;
}
