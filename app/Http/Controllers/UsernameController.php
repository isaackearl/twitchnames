<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsernameValidationRequest;
use App\User;
use App\Username;
use Auth;
use Illuminate\Http\JsonResponse;

class UsernameController extends Controller
{

    /**
     * @param UsernameValidationRequest $usernameValidationRequest
     * @return JsonResponse
     */
    public function search(UsernameValidationRequest $usernameValidationRequest)
    {
        $response = \Curl::to('https://passport.twitch.tv/usernames/' . $usernameValidationRequest->get('search'))->returnResponseObject()->get();

        switch ($response->status) {
            case 200:
                return new JsonResponse(['message' => 'Username is not currently available'], 404);
                break;
            case 204:
                return new JsonResponse(['message' => 'Username is available'], 200);
                break;
            default:
                return new JsonResponse(['error' => 'An error has occurred please try again'], 500);
                break;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    public function index()
    {
        return Auth::user()->usernames->pluck('username');
    }

    /**
     * @param UsernameValidationRequest $usernameValidationRequest
     * @return JsonResponse
     */
    public function store(UsernameValidationRequest $usernameValidationRequest)
    {
        $userName = $usernameValidationRequest->get('search');
        /** @var User $user */
        $user = Auth::user();

        if (Username::whereUserId($user->id)->whereUsername($userName)->first()) {
            return new JsonResponse(['message' => 'You have already included this username'], 422);
        }

        if ($user->usernames->count() >= $user->username_limit) {
            return new JsonResponse([
                'message' => 'Sorry!  There is a ' . $user->username_limit . ' username limit per user'
            ], 422);
        }

        Username::withTrashed()->firstOrCreate([
            'user_id' => $user->id,
            'username' => $userName
        ])->restore();

        return new JsonResponse(['message' => 'Saved!'], 200);
    }

    /**
     * @param $userName
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function destroy($userName)
    {
        $userId = Auth::user()->id;

        $userNameModel = Username::whereUserId($userId)->whereUsername($userName)->first();

        $userNameModel->delete();

        return Auth::user()->usernames->pluck('username');
    }

}
