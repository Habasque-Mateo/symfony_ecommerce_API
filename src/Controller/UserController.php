<?php 
namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class UserController
{
    private $userRepository;
    public function __construct(userRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/api/user", name="get_user", methods={"GET"})
     */
    public function get(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if(empty($data['userLogin']))
        {
            return new JsonResponse(["error" => "Missing required parameter."], 400);
        }

        $user = $this->userRepository->findOneByLogin($data['userLogin']);

        if(empty($user))
        {
            return new JsonResponse(["error" => "User not found."], 400);
        }

        $retUser = [
            "login"=> $user->getLogin(),
            "email"=> $user->getEmail(),
            "firstname"=> $user->getFirstname(),
            "lastname"=> $user->getLastname()
        ];

        return new JsonResponse($retUser, Response::HTTP_OK);
    }

    /**
     * @Route("/api/user", name="update_user", methods={"PUT"})
     */
    public function update(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if(empty($data['userLogin']))
        {
            return new JsonResponse(["error" => "Missing required parameter."], 400);
        }

        $user = $this->userRepository->findOneByLogin($data['userLogin']);

        if(empty($user))
        {
            return new JsonResponse(["error" => "User not found."], 400);
        }

        empty($data['login']) ? true : $user->setLogin($data['login']);
        empty($data['password']) ? true : $user->setPassword($data['password']);
        empty($data['email']) ? true : $user->setEmail($data['email']);
        empty($data['firstname']) ? true : $user->setFirstname($data['firstname']);
        empty($data['lastname']) ? true : $user->setLastname($data['lastname']);

        $updatedUser = $this->userRepository->updateUser($user);

        $retUser = [
            "login"=> $updatedUser->getLogin(),
            "email"=> $updatedUser->getEmail(),
            "firstname"=> $updatedUser->getFirstname(),
            "lastname"=> $updatedUser->getLastname()
        ];

        return new JsonResponse($retUser, Response::HTTP_OK);
    }
}

?>
