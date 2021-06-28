<?php


namespace App\Controller;


use App\Entity\Password;
use App\Repository\PasswordRepository;
use App\Service\Encrypt;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Resource_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PasswordController extends AbstractController
{

    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/api/password/{id}", name="api_password_get", methods={"GET"})
     * @param Password $password
     * @param Encrypt $encrypt
     * @param Request $request
     * @return JsonResponse
     */
    function getPassword(Password $password,Encrypt $encrypt, Request $request): JsonResponse
    {
        $passphrase = $request->query->get('passphrase');
        $decryptedPassword = $encrypt->decrypt($password->getPassword(), $passphrase, base64_decode($password->getInitializationVector()));
        $password->setPassword($decryptedPassword);
        return $this->json($password, 200, [], ['group' => 'password:read']);
    }

    /**
     * @Route("/api/password", name="api_password_create", methods={"POST"})
     */
    function createPassword(Request $request, SerializerInterface $serializer, ValidatorInterface  $validator, Encrypt $encrypt, PasswordRepository $passwordRepository): JsonResponse
    {
        $jsonReceived = $request->getContent();
        $passphrase = $request->query->get('passphrase');

        try {
            $password = $serializer->deserialize($jsonReceived, Password::class, 'json');

            $errors = $validator->validate($password);

            $plainPassword = $password->getPassword();

            $ivLen = openssl_cipher_iv_length($_ENV["ENCRYPT_ALGO"]);
            $iv = openssl_random_pseudo_bytes($ivLen);

            $password->setInitializationVector($iv);

            $password->setPassword($encrypt->encrypt($plainPassword, $passphrase, $iv));
            if (count($errors) > 0) {
                return $this->json($errors, 400);
            }
            $this->em->persist($password);
            $this->em->flush();
            return $this->json($password, 200, [], ['group' => 'password:read']);

        }catch (NotEncodableValueException $e){
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}