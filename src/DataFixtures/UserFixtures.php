<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const USER = 'user';

    /** @var UserPasswordEncoderInterface $userPasswordEncoder */
    private $userPasswordEncoder;

    /**
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @return array|void
     */
    public function getDependencies():array
    {
        return [
            CompanyFixtures::class
        ];
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $usersData = $this->getData();

        foreach ($usersData as $userData) {
            /** @var User $user */
            $user = new User();
            $user
                ->setCompany($this->getReference(CompanyFixtures::COMPANY))
                ->setPassword(
                    $this->userPasswordEncoder->encodePassword($user, $userData['password'])
                )
                ->setEmail($userData['email'])
                ->setRoles($userData['role'])
                ->setBudget(0); // todo add create_at

            $manager->persist($user);
        }

        $manager->flush();

        $this->addReference(self::USER, $user);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            [
                'email' => 'istanynaite@nfq.lt',
                'role' => ['ROLE_USER', 'ROLE_ADMIN'],
                'password' => 'sargis',
            ],
            [
                'email' => 'vkarcikovas@gmail.com',
                'role' => ['ROLE_USER'],
                'password' => 'manosargis'
            ],
            [
                'email' => 'mpetkevic@gmail.com',
                'role' => ['ROLE_USER'],
                'password' => 'mpetkevic'
            ],
            [
                'email' => 'a@a.com',
                'role' => ['ROLE_USER'],
                'password' => 'viktoras'
            ],
        ];
    }
}
