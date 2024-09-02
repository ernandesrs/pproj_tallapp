<?php

namespace App\Services;
use App\Interfaces\ServicesInterface;
use App\Models\User;
use App\Models\VerificationToken;
use App\Rules\UserRules;

class UserService implements ServicesInterface
{
    /**
     * User creation/update rules
     * @return \App\Rules\UserRules
     */
    static public function rules(): UserRules
    {
        return new UserRules;
    }

    /**
     * Create a user
     * @param array $validated
     * @param array $options
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    static public function create(array $validated, array $options = []): \Illuminate\Database\Eloquent\Model|null
    {
        $user = User::create($validated);
        if (!$user) {
            return null;
        }

        if ($options['send_verification_link'] ?? false) {
            self::sendVerificationLink($user);
        }

        return $user;
    }

    /**
     * Update a user
     * @param array $validated
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $options
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    static public function update(array $validated, \Illuminate\Database\Eloquent\Model $model, array $options = []): \Illuminate\Database\Eloquent\Model|null
    {
        if (key_exists('password', $validated) && empty($validated['password'])) {
            unset($validated['password']);
        }

        if (!$model->update($validated)) {
            return null;
        }

        if ($options['notify_user'] ?? false) {
            // do something, like notify user about profile update
        }

        return $model->fresh();
    }

    /**
     * Delete user
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $options
     * @return bool
     */
    static public function delete(\Illuminate\Database\Eloquent\Model $model, array $options = []): bool
    {
        if ($model->avatar) {
            self::deleteAvatar($model);
        }

        if ($options['notify_user'] ?? false) {
            // do something, like notify user about profile update
        }

        return $model->delete();
    }

    /**
     * Update avatar
     * @param array $validated
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    static public function updateAvatar(array $validated, \Illuminate\Database\Eloquent\Model $model): bool
    {
        $avatar = $validated['avatar'];
        $path = $avatar->store('avatars', ['disk' => 'public']);

        if ($path) {
            // delete old avatar
            if ($model->avatar) {
                self::deleteAvatar($model);
            }

            $model->avatar = $path;
            $model->save();
        }

        return true;
    }

    /**
     * Delete user avatar
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return bool
     */
    static public function deleteAvatar(\Illuminate\Database\Eloquent\Model $model): bool
    {
        if (\Storage::disk('public')->fileExists($model->avatar)) {
            \Storage::disk('public')->delete($model->avatar);
        }

        $model->avatar = null;

        return $model->save();
    }

    /**
     * Send verification link
     * @param \App\Models\User $user
     * @return bool
     */
    static public function sendVerificationLink(User $user): bool
    {
        // delete old tokens
        $user->verificationTokens()
            ->where('to', VerificationToken::TO_REGISTER_VERIFICATION)
            ->delete();

        $token = \Str::random(64);
        $verificationToken = $user->verificationTokens()->create([
            'to' => VerificationToken::TO_REGISTER_VERIFICATION,
            'token' => md5($token)
        ]);

        \Mail::to($user)->queue(new \App\Mail\RegisterVerificationMail($user, $verificationToken));

        return true;
    }

    /**
     * Register verify using token
     * @param array $validated
     * @return bool
     */
    static public function registerVerifyByToken(array $validated): bool
    {
        $tokenArray = explode('|', $validated['token']);

        $user = User::where('email', \Str::fromBase64($tokenArray[0]))->first(['id']);
        if (!$user || !empty($user->email_verified_at)) {
            return false;
        }

        $verificationToken = $user->verificationTokens()
            ->where('to', VerificationToken::TO_REGISTER_VERIFICATION)
            ->where('token', \Str::fromBase64($tokenArray[1]))
            ->first();
        if (!$verificationToken) {
            return false;
        }

        $user->email_verified_at = now();
        $user->save();
        $verificationToken->delete();

        return true;
    }

    /**
     * Send recovery link
     * @param User $user
     * @return bool
     */
    static public function sendRecoveryLink(User $user): bool
    {
        // delete old tokens
        $user->verificationTokens()
            ->where('to', VerificationToken::TO_PASSWORD_RESET)
            ->delete();

        $verificationToken = $user->verificationTokens()->create([
            'token' => md5(\Str::random(64)),
            'to' => VerificationToken::TO_PASSWORD_RESET
        ]);

        if (!$verificationToken) {
            return false;
        }

        \Mail::to($user)->queue(
            new \App\Mail\PasswordResetMail("$user->first_name $user->last_name", $user->email, $verificationToken->token)
        );

        return true;
    }
}
