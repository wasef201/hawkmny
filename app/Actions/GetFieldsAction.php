<?php

namespace App\Actions;

use App\Models\City;
use App\Models\Field;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class GetFieldsAction
{
    use AsAction;

    final public function rules(): array
    {
        return [
            'standard_id' => 'required|int'
        ];
    }

    final public function asController(ActionRequest $request): JsonResponse
    {

        return response()->json([
            'data' => Field::query()->where('standard_id', $request->get('standard_id'))->get()
        ]);
    }
}
