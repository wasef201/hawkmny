<?php

namespace App\Actions;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class GetCitiesAction
{
    use AsAction;

    final public function rules(): array
    {
        return [
            'area_id' => 'required|int'
        ];
    }

    final public function asController(ActionRequest $request): JsonResponse
    {

        return response()->json([
            'data' => City::query()->where('parent_id', $request->get('area_id'))->get()
        ]);
    }
}
