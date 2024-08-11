<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240811142917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add trainer_subscription table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE trainer_subscription_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE trainer_subscription (id INT NOT NULL, trainer_id INT NOT NULL, name VARCHAR(255) NOT NULL, duration INT NOT NULL, price DOUBLE PRECISION NOT NULL, description TEXT DEFAULT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DD8961DFB08EDF6 ON trainer_subscription (trainer_id)');
        $this->addSql('ALTER TABLE trainer_subscription ADD CONSTRAINT FK_DD8961DFB08EDF6 FOREIGN KEY (trainer_id) REFERENCES trainer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE trainer_subscription_id_seq CASCADE');
        $this->addSql('ALTER TABLE trainer_subscription DROP CONSTRAINT FK_DD8961DFB08EDF6');
        $this->addSql('DROP TABLE trainer_subscription');
    }
}
