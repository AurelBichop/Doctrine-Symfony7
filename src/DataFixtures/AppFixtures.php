<?php

namespace App\DataFixtures;

use App\Entity\Starship;
use App\Entity\StarshipStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ship1 = new Starship();
        $ship1
            ->setName('USS LeafyCruiser (NCC-0001)')
            ->setClass('Garden')
            ->setCaptain('Jean-Luc Pickles')
            ->setStatus(StarshipStatusEnum::IN_PROGRESS)
            ->setArrivedAt(new \DateTimeImmutable('-1 day'))
        ;

        $ship2 = new Starship();
        $ship2
            ->setName('USS Espresso (NCC-1234-C)')
            ->setClass('Latte')
            ->setCaptain('James T. Quick!')
            ->setStatus(StarshipStatusEnum::COMPLETED)
            ->setArrivedAt(new \DateTimeImmutable('-1 week'))
        ;

        $ship3 = new Starship();
        $ship3
            ->setName('USS Wanderlust (NCC-2024-W)')
            ->setClass('Delta Tourist')
            ->setCaptain('Kathryn Journeyway')
            ->setStatus(StarshipStatusEnum::WAITING)
            ->setArrivedAt(new \DateTimeImmutable('-1 month'))
        ;

        $manager->persist($ship1);
        $manager->persist($ship2);
        $manager->persist($ship3);

        $manager->flush();
    }
}
