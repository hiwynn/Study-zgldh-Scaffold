<?php namespace Modules\Phone\Requests;

use Modules\Phone\Models\Phone;
use Illuminate\Foundation\Http\FormRequest;
use App\Scaffold\Traits\HasWithParameter;

class CreatePhoneRequest extends FormRequest
{
    use HasWithParameter;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        $rules = Phone::$rules;
        $rules['title'] = 'required|unique:phone_list';
        $rules['phone_number'] = 'required|unique:phone_list';
        return $rules;
    }

    public function attributes()
    {
        return __('phone.fields');
    }
}
