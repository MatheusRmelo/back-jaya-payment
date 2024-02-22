<?php

namespace App\Virtual\Requests;

/**
 * @OA\Schema(
 *      title="IdentificationRequest",
 *      description="Requisição com idenficação do pagador",
 *      type="object",
 *      required={"type", "number"}
 * )
 */

class IdentificationRequest
{
    /**
     * @OA\Property(
     *      title="type",
     *      description="Tipo do pagador",
     *      example="CPF"
     * )
     *
     * @var string
     */
    public $type;

    /**
     * @OA\Property(
     *      title="number",
     *      description="number",
     *      example="06406635086"
     * )
     *
     * @var string
     */
    public $number;
}
