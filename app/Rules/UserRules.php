<?php

namespace App\Rules;
use App\Interfaces\RulesInterface;
use App\Models\User;
use App\Models\VerificationToken;

class UserRules implements RulesInterface
{
    /**
     * User creation rules
     * @return array
     */
    static public function creationRules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:25'],
            'last_name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:25', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'gender' => ['required', 'string', \Illuminate\Validation\Rule::in(['n', 'f', 'm'])],
            ...self::passwordRules()
        ];
    }

    /**
     * User udpate rules
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return array
     */
    static public function updateRules(\Illuminate\Database\Eloquent\Model $model): array
    {
        $rules = self::creationRules();

        $rules['username'] = ['required', 'string', 'max:25', 'unique:users,username,' . $model->id];
        $rules['password'] = ['nullable', 'string', 'confirmed'];
        unset($rules['email']);

        return $rules;
    }

    /**
     * Password rules
     * @return array
     */
    static public function passwordRules(): array
    {
        return [
            'password' => ['required', 'string', 'confirmed'],
        ];
    }

    /**
     * Avatar update rules
     * @return array
     */
    static public function avatarUpdateRules(): array
    {
        return [
            'avatar' => ['required', 'mimes:png,jpg,jpeg', 'max:1024']
        ];
    }

    /**
     * Register verification token rules
     * @return array
     */
    static public function registerVerificationTokenRules(): array
    {
        return [
            'token' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $tokenToArray = explode('|', $value);
                    if (count($tokenToArray) != 2) {
                        $fail("Token is invalid");
                        return;
                    }

                    $emailFromToken = \Str::fromBase64($tokenToArray[0]);
                    $decryptedToken = \Str::fromBase64($tokenToArray[1]);

                    $user = User::where('email', $emailFromToken)->first(['id']);
                    if (!$user) {
                        $fail("Token is invalid");
                        return;
                    }

                    if (
                        $user->verificationTokens()
                            ->where('to', VerificationToken::TO_REGISTER_VERIFICATION)
                            ->where('token', $decryptedToken)
                            ->count() == 0
                    ) {
                        $fail("Token is invalid");
                        return;
                    }
                }
            ]
        ];
    }

    /**
     * Password reset token rules
     * @return array
     */
    static public function passwordResetTokenRules(): array
    {
        return [
            'token' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $tokenToArray = explode('|', $value);
                    if (count($tokenToArray) != 2) {
                        $fail("Token is invalid");
                        return;
                    }

                    $emailFromToken = \Str::fromBase64($tokenToArray[0]);
                    $decryptedToken = \Str::fromBase64($tokenToArray[1]);

                    $user = User::where('email', $emailFromToken)->first(['id']);
                    if (!$user) {
                        $fail("Token is invalid");
                        return;
                    }

                    if (
                        $user->verificationTokens()
                            ->where('to', VerificationToken::TO_PASSWORD_RESET)
                            ->where('token', $decryptedToken)
                            ->count() == 0
                    ) {
                        $fail("Token is invalid");
                        return;
                    }
                }
            ]
        ];
    }
}
