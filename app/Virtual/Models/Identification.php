<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Identification",
 *     description="Identification model",
 *     @OA\Xml(
 *         name="Identification"
 *     )
 * )
 */
class Identification
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
     *      example="9999999999"
     * )
     *
     * @var string
     */
    public $number;
}
