<?php

namespace App\Controller;

use App\DTO\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function __construct(
        private readonly DenormalizerInterface $denormalizer,
        private readonly ValidatorInterface $validator
    )
    {
        $data = [
            'name' => 'John Doe',
            'books' => [
                [
                    'title' => 'Book 1',
                ],
                [
                    'title' => '',
                ],
            ],
        ];

        $object = $this->denormalizer->denormalize($data, Author::class);
        $errors = $this->validator->validate($object);

        dd($errors->count() > 0 ? $errors : $object);
    }
}