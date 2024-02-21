<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentSaveRequest;
use App\Models\Customer;
use App\Models\CustomerTag;
use App\Models\IdenficationPayer;
use App\Models\Identification;
use App\Models\Payer;
use App\Models\Payment;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class PaymentController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Get(
     *      path="/payments",
     *      tags={"Payments"},
     *      security={{"bearer_token":{}}},
     *      summary="Lista todos os pagamentos",
     *      description="Retorna todos os pagamentos",
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso",
     *          @OA\JsonContent(ref="#/components/schemas/PaymentListResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autenticado",
     *      ),
     *     )
     */
    public function index(Request $request)
    {
        $payments = Payment::with('payer.identification')->get();
        return $this->success($payments);
    }

    /**
     * @OA\Post(
     *      path="/payments",
     *      tags={"Payments"},
     *      security={{"bearer_token":{}}},
     *      summary="Criação do pagamento",
     *      description="Retorna dados do pagamento",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/PaymentSaveRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Sucesso na criação",
     *          @OA\JsonContent(ref="#/components/schemas/PaymentResource")
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Informações inválidas ou incompletas"
     *      )
     * )
     */
    public function store(PaymentSaveRequest $request)
    {
        try {
            $payment = Payment::create([
                'transaction_amount' => $request->transaction_amount,
                'installments' => $request->installments,
                'token' => $request->token,
                'payment_method_id' => $request->payment_method_id,
                'notification_url' => $request->notification_url,
                'status' => $request->status,
            ]);
            $payer = Payer::create([
                'payment_id' => $payment->id,
                'email' => $request->payer['email'],

            ]);
            $idenfication = Identification::create([
                'payer_id' => $payer->id,
                'type' => $request->payer['identification']['type'],
                'number' => $request->payer['identification']['number'],
            ]);
            $payment->payer;
            $payment->payer->identification;
            return $this->create($payment, 'Sucesso ao criar o pagamento');
        } catch (Exception $err) {
            return $this->serverError(null,  env('APP_DEBUG') ? $err->getMessage() : 'Falha ao criar pagamento');
        }
    }
}
