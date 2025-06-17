<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvaliacaoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'origin' => 'required|string',
            'destiny' => 'required|string',
            'total_distancy_km' => 'required|integer',
            'cargo_type' => 'required|string',
            'total_cargo_value' => 'required|numeric',
            'traffic_accident_year_history' => 'required|integer',
            'route_weather_forecas' => 'required|string',
            'has_insurance' => 'required|boolean',
        ];
    }
}
