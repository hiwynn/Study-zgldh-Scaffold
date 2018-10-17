<?php namespace Modules\Phone\Requests;

use Modules\Phone\Models\Phone;
use Illuminate\Foundation\Http\FormRequest;
use App\Scaffold\Traits\HasWithParameter;

class UpdatePhoneRequest extends FormRequest
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
        $item = Phone::find($this->route()->parameters['phone']);
        $itemId = $item->id;
        $rules['title'] = "required|unique:phone_list,title,$itemId";
        $rules['phone_number'] = "required|unique:phone_list,phone_number,$itemId";
        return $rules;
    }

    public function attributes()
    {
        return __('phone.fields');
    }
}
