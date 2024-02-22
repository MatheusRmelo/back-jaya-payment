<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Http\Requests\PaymentSaveRequest;
use App\Http\Requests\PaymentStatusRequest;
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
     * @OA\Get(
     *      path="/payments/{id}",
     *      tags={"Payments"},
     *      security={{"bearer_token":{}}},
     *      summary="Mostra um pagamento",
     *      description="Retorna dados do pagamento",
     *      @OA\Parameter(
     *          name="id",
     *          description="UUID do pagamento",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Sucesso na pesquisar",
     *          @OA\JsonContent(ref="#/components/schemas/PaymentResource")
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Pagamento não encontrado",
     *      ),
     * )
     */
    public function show(Request $request)
    {
        $payment = Payment::with('payer.identification')->find($request->payment);
        if (!$payment) {
            return $this->notFound(false, 'Pagamento não encontrado');
        }
        return $this->success($payment, 'Sucesso ao buscar o pagamento');
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

    /**
     * @OA\Patch(
     *      path="/payments/{id}",
     *      tags={"Payments"},
     *      security={{"bearer_token":{}}},
     *      summary="Atualização do status de um pagamento",
     *      description="Atualiza o status de um pagamento",
     *      @OA\Parameter(
     *          name="id",
     *          description="UUID do pagamento",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/PaymentStatusRequest")
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="No Content",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Bankslip not found with the specified id",
     *      ),
     * )
     */
    public function updateStatus(PaymentStatusRequest $request)
    {
        $payment = Payment::find($request->payment);
        if (!$payment) {
            return $this->notFound(false, 'Bankslip not found with the specified id');
        }
        $payment->update([
            'status' => $request->status
        ]);

        return $this->noContent();
    }

    /**
     * @OA\Delete(
     *      path="/payments/{id}",
     *      tags={"Payments"},
     *      security={{"bearer_token":{}}},
     *      summary="Cancela um pagamento",
     *      description="Muda para CANCELED o status do pagamento",
     *      @OA\Parameter(
     *          name="id",
     *          description="UUID do pagamento",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="No Content",
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Payment not found with the specified id",
     *      ),
     * )
     */
    public function destroy(Request $request)
    {
        $payment = Payment::find($request->payment);
        if (!$payment) {
            return $this->notFound(false, 'Payment not found with the specified id');
        }

        $payment->update([
            'status' => PaymentStatus::CANCELED
        ]);

        return $this->noContent();
    }
}
