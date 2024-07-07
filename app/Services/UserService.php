<?php

namespace App\Services;

use App\Models\User;
use App\DTOs\UserDTO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Collection;

class UserService
{
    /**
     * Create a new user.
     *
     * @param array $data
     * @return UserDTO
     * @throws ValidationException
     */
    public function createUser(array $data): UserDTO
    {
        // Validate the data
        $validator = Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'birthday' => 'required|date',
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Create the user
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'birthday' => $data['birthday'],
            'phone' => $data['phone'],
        ]);

        // Return the UserDTO
        return new UserDTO(
            $user->id,
            $user->first_name,
            $user->last_name,
            $user->email,
            $user->birthday,
            $user->phone,
        );
    }

        /**
     * Update a user by ID.
     *
     * @param int $id
     * @param array $data
     * @return UserDTO
     * @throws ValidationException
     */
    public function updateUser(int $id, array $data): UserDTO
    {

        $validator = Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'birthday' => 'required|date',
            'phone' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $user = User::findOrFail($id);

        $originalEmail = $user->email;

        if ($originalEmail !== $user->email) {
            $user->email_verified_at = null;
        }

        $user->update($data);

        return new UserDTO(
            $user->id,
            $user->first_name,
            $user->last_name,
            $user->email,
            $user->birthday,
            $user->phone,
        );
    }

    public function updateUserRole(string $userRole, int $id)
    {
        $user = User::findOrFail($id);
        $user->role = $userRole;

        $user->update();

        return $user;
    }

    public function getUsersByRole(string $role)
    {
        return User::where('role', $role)->get();
    }

    public function getAllStudentsExcept(int $userId): Collection
    {
        return User::where('role', 'student')
                    ->where('id', '!=', $userId)
                    ->get()
                    ->map(function ($user) {
                        return new UserDTO($user->id, $user->first_name, $user->last_name, $user->email, $user->birthday, $user->phone, $user->role);
                    });
    }

    public function getAllTeachersExcept(int $userId): Collection
    {
        return User::where('role', 'teacher')
                    ->where('id', '!=', $userId)
                    ->get()
                    ->map(function ($user) {
                        return new UserDTO($user->id, $user->first_name, $user->last_name, $user->email, $user->birthday, $user->phone, $user->role);
                    });
    }

    public function deleteUser(int $userId): void
    {
        $user = User::findOrFail($userId);
        $user->delete();
    }

}