<?php

namespace App\Services;
use App\Interfaces\ServicesInterface;
use App\Models\User;
use App\Rules\UserRules;

class UserService implements ServicesInterface
{
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
            \Mail::to($user)->queue(new \App\Mail\RegisterVerificationMail($user));
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
     * User creation/update rules
     * @return \App\Rules\UserRules
     */
    static public function rules(): UserRules
    {
        return new UserRules;
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
}
