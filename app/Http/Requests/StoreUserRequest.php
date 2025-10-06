<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return $this->user()?->hasRole('admin') ?? false;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'name'        => 'required|string|max:100',
      'email'       => 'required|email:rfc,dns|unique:users,email',
      'password'    => 'required|string|min:8',
      'roles'       => 'sometimes|array',
      'roles.*'     => 'string|exists:roles,name',
      'permissions' => 'sometimes|array',
      'permissions.*' => 'string|exists:permissions,name',
    ];
  }
}
