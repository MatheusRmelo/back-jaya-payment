<?php

namespace App\Virtual\Resources;

/**
 * @OA\Schema(
 *     title="BaseResource",
 *     description="Base resource",
 *     @OA\Xml(
 *         name="BaseResource"
 *     )
 * )
 */
class BaseResource
{
    /**
     * @OA\Property(
     *     title="Result",
     *     description="resultado",
     * )
     *
     * @var string
     */
    private $result;

    /**
     * @OA\Property(
     *     title="Status da requisição",
     *     description="Se requisição foi um sucesso ou não",
     *     example=true
     * )
     *
     * @var boolean
     */
    private $ok;

    /**
     * @OA\Property(
     *     title="Descrição da resposta",
     *     description="Detalhes da resposta",
     *     example="sucesso"
     * )
     *
     * @var string
     */
    private $description;
}
