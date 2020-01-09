<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Domain\Airplane\Enums\Land;
use App\Domain\Airplane\Models\AeropraktA24;
use App\Domain\Airplane\Models\Boeing747;
use App\Domain\Airplane\Models\CurtissNC4;
use App\Domain\Model\Airplane;
use App\Domain\Model\Hangar;
use App\Repository\AirplaneRepository;
use App\Repository\HangarRepository;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200109113045 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        // Yeah, I know that it's not good, need to create normal fixtures for that...
        $em = $this->container->get('doctrine.orm.entity_manager');
        /** @var HangarRepository $hangarRepository */
        $hangarRepository = $em->getRepository(Hangar::class);
        /** @var AirplaneRepository $airplaneRepository */
        $airplaneRepository = $em->getRepository(Airplane::class);

        $hangar = (new Hangar())
            ->setTitle('Aeroprakt')
            ->addLand(Land::get(Land::RUNWAY))
            ->addLand(Land::get(Land::WATER));
        $em->persist($hangar);

        $em->persist((new Airplane(new AeropraktA24()))->setTitle('AeropraktA24_1')->setHangar($hangar));
        $em->persist((new Airplane(new AeropraktA24()))->setTitle('AeropraktA24_2')->setHangar($hangar));
        $em->persist((new Airplane(new AeropraktA24()))->setTitle('AeropraktA24_3')->setHangar($hangar));
        $em->persist((new Airplane(new AeropraktA24()))->setTitle('AeropraktA24_4')->setHangar($hangar));
        $em->persist((new Airplane(new AeropraktA24()))->setTitle('AeropraktA24_5')->setHangar($hangar));

        $em->persist((new Airplane(new CurtissNC4()))->setTitle('CurtissNC4_1')->setHangar($hangar));
        $em->persist((new Airplane(new CurtissNC4()))->setTitle('CurtissNC4_2')->setHangar($hangar));
        $em->persist((new Airplane(new CurtissNC4()))->setTitle('CurtissNC4_3')->setHangar($hangar));

        $em->persist((new Airplane(new Boeing747()))->setTitle('Boeing747_1')->setHangar($hangar));
        $em->persist((new Airplane(new Boeing747()))->setTitle('Boeing747_2')->setHangar($hangar));

        $em->flush();
    }

    public function down(Schema $schema): void
    {
    }
}
