<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200109113044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hangar (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, lands LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE airplane (id INT AUTO_INCREMENT NOT NULL, hangar_id INT DEFAULT NULL, model VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_2636002D2FEFB5A5 (hangar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE airplane ADD CONSTRAINT FK_2636002D2FEFB5A5 FOREIGN KEY (hangar_id) REFERENCES hangar (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE airplane DROP FOREIGN KEY FK_2636002D2FEFB5A5');
        $this->addSql('DROP TABLE hangar');
        $this->addSql('DROP TABLE airplane');
    }
}
