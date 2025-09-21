<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Sample users database
    private function getUsersData()
    {
        return [
            [
                'id' => 1,
                'name' => 'Super Admin',
                'email' => 'admin@booking.com',
                'password' => 'admin123',
                'role' => 'SuperAdmin',
                'created_at' => '2024-01-15 10:00:00'
            ],
            [
                'id' => 2,
                'name' => 'John Smith',
                'email' => 'john@example.com',
                'password' => 'user123',
                'role' => 'Creator',
                'created_at' => '2024-02-01 14:30:00'
            ],
            [
                'id' => 3,
                'name' => 'Sarah Johnson',
                'email' => 'sarah@example.com',
                'password' => 'user123',
                'role' => 'EndUser',
                'created_at' => '2024-02-05 09:15:00'
            ],
            [
                'id' => 4,
                'name' => 'Mike Davis',
                'email' => 'mike@example.com',
                'password' => 'creator123',
                'role' => 'Creator',
                'created_at' => '2024-02-10 16:45:00'
            ],
            [
                'id' => 5,
                'name' => 'Emma Wilson',
                'email' => 'emma@example.com',
                'password' => 'user123',
                'role' => 'EndUser',
                'created_at' => '2024-02-12 11:20:00'
            ]
        ];
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $users = $this->getUsersData();
        $email = $request->email;
        $password = $request->password;

        foreach ($users as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                session([
                    'user_logged_in' => true,
                    'user' => $user
                ]);

                // Role-based redirect
                switch ($user['role']) {
                    case 'SuperAdmin':
                        return redirect()->route('superadmin.dashboard');
                    case 'Creator':
                        return redirect()->route('creator.dashboard');
                    case 'EndUser':
                        return redirect()->route('enduser.dashboard');
                }
            }
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function register(Request $request)
    {
        // In real application, this would save to database
        $newUser = [
            'id' => rand(1000, 9999),
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'created_at' => now()
        ];

        session([
            'user_logged_in' => true,
            'user' => $newUser
        ]);

        // Role-based redirect
        switch ($newUser['role']) {
            case 'SuperAdmin':
                return redirect()->route('superadmin.dashboard');
            case 'Creator':
                return redirect()->route('creator.dashboard');
            case 'EndUser':
                return redirect()->route('enduser.dashboard');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('home');
    }
}