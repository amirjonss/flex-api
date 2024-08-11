<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240811142220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add gym_subscription table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE gym_subscription_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE gym_subscription (id INT NOT NULL, gym_id INT NOT NULL, name VARCHAR(255) NOT NULL, duration INT NOT NULL, price DOUBLE PRECISION NOT NULL, description TEXT DEFAULT NULL, is_active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_95E34CEEBD2F03 ON gym_subscription (gym_id)');
        $this->addSql('ALTER TABLE gym_subscription ADD CONSTRAINT FK_95E34CEEBD2F03 FOREIGN KEY (gym_id) REFERENCES gym (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE gym_subscription_id_seq CASCADE');
        $this->addSql('ALTER TABLE gym_subscription DROP CONSTRAINT FK_95E34CEEBD2F03');
        $this->addSql('DROP TABLE gym_subscription');
    }
}
