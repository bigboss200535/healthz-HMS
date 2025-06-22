<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{

    public function index(Request $request)
    {
        return response()->json(
            $request->user()->tokens()->get()->map(function ($token) {
                return [
                    'id' => $token->id,
                    'name' => $token->name,
                    'abilities' => $token->abilities,
                    'last_used_at' => $token->last_used_at,
                    'expires_at' => $token->expires_at,
                    'created_at' => $token->created_at,
                ];
            })
        );
    }
    /**
     * Create a new API token
     */
    public function create(Request $request)
    {
        $request->validate([
            'token_name' => 'required|string|max:255',
            'abilities' => 'nullable|array',
            'abilities.*' => 'string',
            'expires_at' => 'nullable|date'
        ]);

        $token = $request->user()->createToken(
            $request->token_name,
            $request->abilities ?? ['*'],
            $request->expires_at ? now()->parse($request->expires_at) : null
        );

        return response()->json([
            'token' => $token->plainTextToken,
            'token_id' => $token->accessToken->id,
            'name' => $token->accessToken->name,
            'abilities' => $token->accessToken->abilities,
            'expires_at' => $token->accessToken->expires_at,
            'created_at' => now(),
            'updated_at' => now()
        ], 201);
    }

    

    public function update(Request $request, $tokenId)
    {   
        $request->validate([
            'abilities' => 'required|array',
            'abilities.*' => 'string'
        ]);

        $token = $request->user()->tokens()->findOrFail($tokenId);
        
        $token->forceFill([
            'abilities' => $request->abilities,
        ])->save();

        return response()->json([
            'message' => 'Token updated successfully',
            'token' => [
                'id' => $token->id,
                'name' => $token->name,
                'abilities' => $token->abilities,
                'updated_at' => now()
            ]
        ]);
    }

    /**
 * Delete a specific token
 */
public function deleteToken(Request $request, $tokenId)
{
    $request->user()->tokens()->where('id', $tokenId)->delete();

    return response()->json(['message' => 'Token deleted successfully']);
}

/**
 * Delete all tokens for the user
 */
public function deleteAllTokens(Request $request)
{
    $request->user()->tokens()->delete();

    return response()->json(['message' => 'All tokens deleted successfully']);
}
}
