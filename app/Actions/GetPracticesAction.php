<?php

namespace App\Actions;

use App\Models\City;
use App\Models\Field;
use App\Models\Practice;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class GetPracticesAction
{
    use AsAction;

    final public function rules(): array
    {
        return [
            'field_id' => 'required|int'
        ];
    }

    final public function asController(ActionRequest $request): JsonResponse
    {

        return response()->json([
            'data' => Practice::query()->where('field_id', $request->get('field_id'))->get()
        ]);
    }
}
